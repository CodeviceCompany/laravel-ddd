<?php

namespace CodeviceCompany\LaravelDdd\Commands;

use Illuminate\Routing\Console\MiddlewareMakeCommand as BaseCommand;

class MiddlewareMakeCommand extends BaseCommand
{
    use UsesDomainNamespace;
}
