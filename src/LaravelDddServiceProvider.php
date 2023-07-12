<?php

namespace CodeviceCompany\LaravelDdd;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use CodeviceCompany\LaravelDdd\Commands\LaravelDddCommand;

class LaravelDddServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-ddd')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-ddd_table')
            ->hasCommand(LaravelDddCommand::class);
    }
}
