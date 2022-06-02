<?php

namespace Marshmallow\FolderCleaner;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Marshmallow\FolderCleaner\Commands\FolderCleanerCommand;

class FolderCleanerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-folder-cleaner')
            ->hasConfigFile()
            ->hasCommand(FolderCleanerCommand::class);
    }
}
