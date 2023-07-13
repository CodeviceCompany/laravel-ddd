<?php

namespace CodeviceCompany\LaravelDdd\Commands;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

trait UsesDomainNamespace
{
    protected function rootNamespace(): string
    {
        if ($this->isCommandRegistered() && $this->option('domain')) {
            return str($this->option('domain'))->finish('\\')->toString();
        }

        return parent::rootNamespace();
    }

    protected function getPath($name): string
    {
        if (!$this->isCommandRegistered()) {
            return parent::getPath($name);
        }

        $name = str_replace('\\', '/', Str::replaceFirst($this->rootNamespace(), '', $name)) . '.php';
        $namespace = str_replace('\\', '/', $this->rootNamespace());
        return 'src/' . $namespace . $name;
    }

    protected function getOptions(): array
    {
        if (!$this->isCommandRegistered()) {
            return parent::getOptions();
        }

        return collect(parent::getOptions())
            ->push(['domain', 'D', InputOption::VALUE_REQUIRED, 'Create the model under given domain'])
            ->all();
    }

    public function call($command, array $arguments = [])
    {
        if (!$this->isCommandRegistered()) {
            return parent::call($command, $arguments);
        }

        return $this->runCommand($command, $this->appendArgumentsWithDomain($arguments), $this->output);
    }

    //******************************************
    // Helpers
    //******************************************
    protected function isCommandRegistered(?string $command = null): bool
    {
        $commandClasses = config('ddd.commands');
        $class = get_class($this);
        return in_array($class, $commandClasses);
    }

    protected function appendArgumentsWithDomain(array $array): array
    {
        if (!$this->isCommandRegistered()) {
            return $array;
        }

        $domain = $this->option('domain');
        if ($domain) {
            $array['--domain'] = $domain;
        }

        return $array;
    }
}
