<?php

namespace CodeviceCompany\LaravelDdd\Commands;

use Illuminate\Database\Console\Factories\FactoryMakeCommand as BaseCommand;
use Illuminate\Support\Str;

class FactoryMakeCommand extends BaseCommand
{
    use UsesDomainNamespace;

    protected function getNamespace($name): string
    {
        $namespace = trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');

        // if equal to Database\Factories replace with Domain\Factories
        if ($this->isCommandRegistered() && $namespace === 'Database\Factories') {
            $domainNamespace = str_replace('/', '\\', $this->rootNamespace());

            $namespace = $domainNamespace.'Factories';
        }

        return $namespace;
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     */
    protected function getPath($name): string
    {
        $name = (string) Str::of($name)->replaceFirst($this->rootNamespace(), '')->finish('Factory');
        $namespace = str_replace('\\', '/', $this->rootNamespace());

        return 'src/'.$namespace.'Factories/'.str_replace('\\', '/', $name).'.php';
    }
}
