<?php

namespace CodeviceCompany\LaravelDdd\Commands;

use Illuminate\Console\Concerns\CreatesMatchingTest;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class MakeActionCommand extends GeneratorCommand
{
    use UsesDomainNamespace;
    use CreatesMatchingTest;

    protected $name = 'ddd:make:action';

    protected $description = 'Create a new action class';

    protected $type = 'Action';

    public function handle()
    {
        parent::handle();

        if ($this->option('data')) {
            $this->call('ddd:make:data', $this->appendArgumentsWithDomain([
                'name' => $this->getDataClassName($this->argument('name')),
            ]));
        }
    }

    protected function buildClass($name): array|string
    {
        $replace = [];

        if ($this->option('data')) {
            $replace = $this->buildDataReplacements();
        }

        return str_replace(
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name)
        );
    }

    protected function buildDataReplacements(): array
    {
        $data = str($this->qualifyDATA($this->argument('name')))->replace('App\\', 'App\\Data\\')->toString();

        return [
            '{{ namespacedDATA }}' => $data,
            '{{namespacedDATA}}' => $data,
            '{{ data }}' => class_basename($data),
            '{{data}}' => class_basename($data),
        ];
    }

    protected function qualifyDATA(string $name)
    {
        $name = ltrim($name, '\\/');

        $name = str_replace('/', '\\', $name);

        $name = $this->getDataClassName($name);

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        return is_dir(app_path('DATAs'))
            ? $rootNamespace.'DATAs\\'.$name
            : $rootNamespace.$name;
    }

    private function getDataClassName(string $name)
    {
        $name = str($name)->replaceLast('Action', 'Data')->start('Actions\\');
        if (! $name->endsWith('Data')) {
            $name = $name->append('Data');
        }

        return $name;
    }

    protected function getStub(): string
    {
        if ($this->option('data')) {
            return $this->resolveStubPath('/stubs/action.data.stub');
        }

        return $this->resolveStubPath('/stubs/action.stub');
    }

    protected function resolveStubPath($stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim((string) $stub, '/')))
            ? $customPath
            : __DIR__.$stub;
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Actions';
    }

    protected function getOptions(): array
    {
        return [
            ['data', 'd', InputOption::VALUE_NONE, 'Create a new data object for action.'],
            ['domain', 'D', InputOption::VALUE_REQUIRED, 'Create the model under given domain'],
        ];
    }

    protected function handleTestCreation($path): bool
    {
        if (! $this->option('test') && ! $this->option('pest')) {
            return false;
        }

        return $this->call('make:test', [
            'name' => Str::of($path)->after($this->laravel['path'])->beforeLast('.php')->append('Test')->replace('\\', '/'),
            '--pest' => $this->option('pest'),
        ]) == 0;
    }
}
