<?php

namespace CodeviceCompany\LaravelDdd\Commands;

use Illuminate\Routing\Console\ControllerMakeCommand as BaseCommand;

class ControllerMakeCommand extends BaseCommand
{
    use UsesDomainNamespace;

    protected function buildClass($name): array|string
    {
        $controllerNamespace = $this->getNamespace($name);

        $replace = [];

        if ($this->option('parent')) {
            $replace = $this->buildParentReplacements();
        }

        if ($this->option('model')) {
            $replace = $this->buildModelReplacements($replace);
        }

        if ($this->option('creatable')) {
            $replace['abort(404);'] = '//';
        }

        $replace["use {$controllerNamespace}\Controller;\n"] = "use App\Http\Controllers\Controller;\n";

        return str_replace(
            array_keys($replace), array_values($replace), $this->parentBuildClass($name)
        );
    }

    protected function parentBuildClass($name): string
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }
}
