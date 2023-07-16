<?php

namespace CodeviceCompany\LaravelDdd\Commands;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\StubPublishCommand as BaseCommand;
use Illuminate\Foundation\Events\PublishingStubs;

class StubPublishCommand extends BaseCommand
{
    public function handle()
    {
        if (! is_dir($stubsPath = $this->laravel->basePath('stubs'))) {
            (new Filesystem)->makeDirectory($stubsPath);
        }

        $stubs = [
            __DIR__.'/stubs/action.data.php' => 'action.data.php',
            __DIR__.'/stubs/action.stub' => 'action.stub',
            __DIR__.'/stubs/data.stub' => 'data.stub',
            __DIR__.'/stubs/view-model.stub' => 'view-model.stub',
            __DIR__.'/stubs/model.stub' => 'model.stub',
        ];

        $this->laravel['events']->dispatch($event = new PublishingStubs($stubs));

        foreach ($event->stubs as $from => $to) {
            $to = $stubsPath.DIRECTORY_SEPARATOR.ltrim($to, DIRECTORY_SEPARATOR);

            if ((! $this->option('existing') && (! file_exists($to) || $this->option('force')))
                || ($this->option('existing') && file_exists($to))) {
                file_put_contents($to, file_get_contents($from));
            }
        }

        $this->components->info('Stubs published successfully.');
    }
}
