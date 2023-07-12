<?php

namespace CodeviceCompany\LaravelDdd\Commands;

use Illuminate\Console\Command;

class LaravelDddCommand extends Command
{
    public $signature = 'laravel-ddd';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
