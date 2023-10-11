<?php

namespace Marshmallow\FolderCleaner;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Marshmallow\FolderCleaner\Commands\FolderCleanerCommand;

class FolderCleanerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-folder-cleaner')
            ->hasConfigFile()
            ->hasCommand(FolderCleanerCommand::class)
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->askToStarRepoOnGitHub('https://github.com/marshmallow-packages/laravel-folder-cleaner');
            });
    }
}
