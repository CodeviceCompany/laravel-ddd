<?php

namespace CodeviceCompany\LaravelDdd;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasCommands([
                Commands\CastMakeCommand::class,
                Commands\ChannelMakeCommand::class,
                Commands\ConsoleMakeCommand::class,
                Commands\EventMakeCommand::class,
                Commands\ExceptionMakeCommand::class,
                Commands\JobMakeCommand::class,
                Commands\ListenerMakeCommand::class,
                Commands\MailMakeCommand::class,
                Commands\ModelMakeCommand::class,
                Commands\NotificationMakeCommand::class,
                Commands\ObserverMakeCommand::class,
                Commands\PolicyMakeCommand::class,
                Commands\ProviderMakeCommand::class,
                Commands\RequestMakeCommand::class,
                Commands\ResourceMakeCommand::class,
                Commands\RuleMakeCommand::class,
                Commands\ScopeMakeCommand::class,

                Commands\MiddlewareMakeCommand::class,
                Commands\ControllerMakeCommand::class,
            ]);
    }
}
