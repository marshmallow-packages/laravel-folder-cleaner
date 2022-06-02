<?php

namespace Marshmallow\FolderCleaner\Commands;

use Illuminate\Console\Command;
use Marshmallow\FolderCleaner\Facades\FolderCleaner;

class FolderCleanerCommand extends Command
{
    public $signature = 'folder-cleaner:clean';

    public $description = 'Delete all the files in the folders specified in the folder-cleaner config.';

    public function handle(): int
    {
        FolderCleaner::cleanFolders([
            config('folder-cleaner.folders')
        ]);

        return self::SUCCESS;
    }
}
