<?php

namespace CodeviceCompany\LaravelDdd\Commands;

use Spatie\LaravelData\Commands\DataMakeCommand as BaseCommand;

class DataMakeCommand extends BaseCommand
{
    use UsesDomainNamespace;
}
