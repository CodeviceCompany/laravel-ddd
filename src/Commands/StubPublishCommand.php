<?php

namespace CodeviceCompany\LaravelDdd\Commands;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\StubPublishCommand as BaseCommand;
use Illuminate\Foundation\Events\PublishingStubs;

class StubPublishCommand extends BaseCommand
{
    public function handle()
    {
        parent::handle();

        if (!is_dir($stubsPath = $this->laravel->basePath('stubs'))) {
            (new Filesystem)->makeDirectory($stubsPath);
        }

        $stubs = [
            __DIR__ . '/stubs/model.stub' => 'model.stub',
        ];

        $this->laravel['events']->dispatch($event = new PublishingStubs($stubs));

        foreach ($event->stubs as $from => $to) {
            $to = $stubsPath . DIRECTORY_SEPARATOR . ltrim($to, DIRECTORY_SEPARATOR);
            file_put_contents($to, file_get_contents($from));
        }
    }
}
