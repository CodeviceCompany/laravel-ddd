<?php

namespace CodeviceCompany\LaravelDdd;

use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;
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
            ])->hasInstallCommand(function (InstallCommand $installCommand) {
                $installCommand
                    ->publishConfigFile()
                    ->copyAndRegisterServiceProviderInApp()
                    ->endWith(function (InstallCommand $installCommand) {
                        $this->installSpatieLaravelData($installCommand);
                        $this->installLorisleivaLaravelActions($installCommand);
                        $this->installSpatieLaravelViewModel($installCommand);
                        $this->moveAppDirectoryToSrcFolder($installCommand);
                    });
            });
    }

    //*********************************************
    // Helpers
    //*********************************************
    function moveAppDirectoryToSrcFolder(InstallCommand $installCommand): void
    {
        $basePath = $installCommand->getLaravel()->basePath();
        $disk = Storage::build(['driver' => 'local', 'root' => $basePath]);

        if ($disk->exists('app')) {
            $installCommand->info('Moving ./app Directory to ./src/App');
            collect($disk->allFiles('app'))->each(function ($path) use ($disk, $installCommand) {
                $newPath = str($path)->replaceFirst('app', 'src/App');
                $disk->move($path, $newPath);
            });
        }

        $stubs = [
            __DIR__ . '/Commands/stubs/Application.stub' => '/src/App/Application.php',
            __DIR__ . '/Commands/stubs/app.stub' => '/bootstrap/app.php',
        ];

        foreach ($stubs as $from => $to) {
            $to = $basePath . DIRECTORY_SEPARATOR . ltrim($to, DIRECTORY_SEPARATOR);
            file_put_contents($to, file_get_contents($from));
        }
    }

    private function installSpatieLaravelData(InstallCommand $installCommand): void
    {
        $installCommand->info('Installing spatie/laravel-data');
        Process::run('composer require spatie/laravel-data', function (string $type, string $output) {
            echo $output;
        });
    }

    private function installLorisleivaLaravelActions(InstallCommand $installCommand): void
    {
        $installCommand->info('Installing lorisleiva/laravel-actions');
        Process::run('composer require lorisleiva/laravel-actions', function (string $type, string $output) {
            echo $output;
        });
    }

    private function installSpatieLaravelViewModel(InstallCommand $installCommand): void
    {
        $installCommand->info('Installing spatie/laravel-view-models');
        Process::run('composer require spatie/laravel-view-models', function (string $type, string $output) {
            echo $output;
        });
    }
}
