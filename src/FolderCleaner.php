<?php

namespace Marshmallow\FolderCleaner;

use Illuminate\Filesystem\Filesystem;

class FolderCleaner
{
    public function cleanFolders(array $folders): void
    {
        $filesystem = new Filesystem();
        collect($folders)->each(function ($folder) use ($filesystem) {
            $filesystem->cleanDirectory($folder);
        });
    }
}
