<?php

namespace CodeviceCompany\LaravelDdd\Commands;

use Illuminate\Console\Concerns\CreatesMatchingTest;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ViewModelMakeCommand extends GeneratorCommand
{
    use UsesDomainNamespace;
    use CreatesMatchingTest;

    protected $name = 'ddd:make:view-model';
    protected $description = 'Create a new ViewModel class';

    protected $type = 'ViewModel';

    public function handle()
    {
        if (parent::handle() === false) {
            if (! $this->option('force')) {
                return;
            }
        }
    }

    protected function getStub(): string
    {
        return $this->resolveStubPath('/stubs/view-model.stub');
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\ViewModels';
    }

    protected function getOptions(): array
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the view-model already exists'],
            ['domain', 'D', InputOption::VALUE_REQUIRED, 'Create the model under given domain']
        ];
    }
}
