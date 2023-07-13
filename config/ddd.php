<?php

use CodeviceCompany\LaravelDdd\Commands;

return [
    'commands' => [
        'make:cast' => Commands\CastMakeCommand::class,
        'make:channel' => Commands\ChannelMakeCommand::class,
        'make:console' => Commands\ConsoleMakeCommand::class,
        'make:event' => Commands\EventMakeCommand::class,
        'make:exception' => Commands\ExceptionMakeCommand::class,
        'make:job' => Commands\JobMakeCommand::class,
        'make:listener' => Commands\ListenerMakeCommand::class,
        'make:mail' => Commands\MailMakeCommand::class,
        'make:model' => Commands\ModelMakeCommand::class,
        'make:notification' => Commands\NotificationMakeCommand::class,
        'make:observer' => Commands\ObserverMakeCommand::class,
        'make:policy' => Commands\PolicyMakeCommand::class,
        'make:provider' => Commands\ProviderMakeCommand::class,
        'make:request' => Commands\RequestMakeCommand::class,
        'make:resource' => Commands\ResourceMakeCommand::class,
        'make:rule' => Commands\RuleMakeCommand::class,
        'make:scope' => Commands\ScopeMakeCommand::class,
        'make:middleware' => Commands\MiddlewareMakeCommand::class,
        'make:controller' => Commands\ControllerMakeCommand::class,
        'make:factory' => Commands\FactoryMakeCommand::class,
    ]
];
