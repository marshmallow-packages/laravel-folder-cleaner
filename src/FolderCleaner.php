<?php

namespace Marshmallow\FolderCleaner;

use Carbon\Carbon;
use ErrorException;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Console\OutputStyle;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Finder\SplFileInfo;

class FolderCleaner
{
    public function cleanFolders(array $folders, bool $dry_run = false, OutputStyle $output = null): void
    {
        $folders = $this->formatFolderStructureArray($folders);
        $filesystem = new Filesystem();
        collect($folders)->filter(function ($settings, $folder) use ($filesystem, $output) {
            /** Check if the folders exists. Otherwise we filter them from the collection */
            $folder_path = Str::of(base_path($folder))->replace('//', '/');
            $exists = $filesystem->exists($folder_path);
            if (! $exists) {
                $output->error('Folder doesnt exist: ' . $folder);
            }

            return $exists;
        })->each(function ($settings, $folder) use ($filesystem, $output, $dry_run) {
            $folder_path = Str::of(base_path($folder))->replace('//', '/');
            $output->info('Cleaning folder: ' . $folder);
            $all_files_in_folder = $filesystem->files($folder_path);

            collect($all_files_in_folder)->filter(function (SplFileInfo $file) use ($settings) {
                /** Filter the files by checking if they are old enough to delete */
                $c_time = Carbon::createFromTimestamp($file->getCTime());
                $older_then = Arr::get($settings, 'older_than');

                return $c_time < $older_then;
            })->reject(function (SplFileInfo $file) use ($settings) {

                /** Reject files based on the except setting */
                return in_array($file->getBasename(), Arr::get($settings, 'except', []));
            })->reject(function (SplFileInfo $file) use ($settings) {

                /** Reject files based on a reqular expression provided in the settings */
                $match = Arr::get($settings, 'match');
                if (! $match) {
                    return false;
                }

                if (preg_match($match, $file->getBasename())) {
                    return false;
                }

                return true;
            })->each(function (SplFileInfo $file) use ($filesystem, $output, $dry_run) {

                /** Delete the file or output the path if we're in dry-run mode */
                if ($dry_run) {
                    $output->info('Delete: ' . $file->getPathname());
                } else {
                    $filesystem->delete(
                        $file->getPathname()
                    );
                }
            });

            if (Arr::get($settings, 'delete_folders') === true) {
                $directories = $filesystem->directories($folder_path);
                collect($directories)->filter(function ($directory) use ($filesystem, $settings) {
                    $all_files_in_folder = $filesystem->files($directory);
                    if (count($all_files_in_folder) == 0) {
                        return true;
                    }
                    $file = $all_files_in_folder[0];
                    $c_time = Carbon::createFromTimestamp($file->getCTime());
                    $older_then = Arr::get($settings, 'older_than');

                    return $c_time < $older_then;
                })->each(function ($directory) use ($output, $filesystem) {
                    try {
                        $filesystem->deleteDirectory($directory);
                    } catch (ErrorException $e) {
                        $output->error($e->getMessage());
                    }
                });
            }
        });
    }

    protected function formatFolderStructureArray(array $folders): array
    {
        $folder_structure = [];
        collect($folders)->each(function ($value, $key) use (&$folder_structure) {
            if (is_array($value)) {
                $value['older_than'] = $date = now()->sub($value['older_than']);
                $folder_structure[$key] = $value;
            } else {
                $folder_structure[$value] = [
                    'older_than' => now(),
                    'except' => [],
                ];
            }
        });

        return $folder_structure;
    }
}
