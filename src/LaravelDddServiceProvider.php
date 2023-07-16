<?php

namespace CodeviceCompany\LaravelDdd;

use Illuminate\Support\Facades\Process;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
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
                Commands\FactoryMakeCommand::class,
                Commands\StubPublishCommand::class,
                Commands\MakeActionCommand::class,
                Commands\DataMakeCommand::class,
                Commands\ViewModelMakeCommand::class,
            ])->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->copyAndRegisterServiceProviderInApp()
                    ->askToStarRepoOnGitHub('codevicecompany/laravel-ddd')
                    ->endWith(function (InstallCommand $installCommand) {
                        $installCommand->info('Installing spatie/laravel-data');
                        Process::run('composer require spatie/laravel-data', function (string $type, string $output) {
                            echo $output;
                        });

                        $installCommand->info('Installing lorisleiva/laravel-actions');
                        Process::run('composer require lorisleiva/laravel-actions', function (string $type, string $output) {
                            echo $output;
                        });

                        $installCommand->info('Installing spatie/laravel-view-models');
                        Process::run('composer require spatie/laravel-view-models', function (string $type, string $output) {
                            echo $output;
                        });
                    });
            });
    }
}
