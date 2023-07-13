<?php

namespace CodeviceCompany\LaravelDdd\Commands;

use Illuminate\Routing\Console\ControllerMakeCommand as BaseCommand;

class ControllerMakeCommand extends BaseCommand
{
    use UsesDomainNamespace;
}
