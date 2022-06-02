<?php

namespace Marshmallow\FolderCleaner;

use Marshmallow\FolderCleaner\Commands\FolderCleanerCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
