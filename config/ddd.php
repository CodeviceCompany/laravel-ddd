<?php

use CodeviceCompany\LaravelDdd\Commands;

return [
    'commands' => [
        'ddd:make:cast' => Commands\CastMakeCommand::class,
        'ddd:make:channel' => Commands\ChannelMakeCommand::class,
        'ddd:make:console' => Commands\ConsoleMakeCommand::class,
        'ddd:make:event' => Commands\EventMakeCommand::class,
        'ddd:make:exception' => Commands\ExceptionMakeCommand::class,
        'ddd:make:job' => Commands\JobMakeCommand::class,
        'ddd:make:listener' => Commands\ListenerMakeCommand::class,
        'ddd:make:mail' => Commands\MailMakeCommand::class,
        'ddd:make:model' => Commands\ModelMakeCommand::class,
        'ddd:make:notification' => Commands\NotificationMakeCommand::class,
        'ddd:make:observer' => Commands\ObserverMakeCommand::class,
        'ddd:make:policy' => Commands\PolicyMakeCommand::class,
        'ddd:make:provider' => Commands\ProviderMakeCommand::class,
        'ddd:make:request' => Commands\RequestMakeCommand::class,
        'ddd:make:resource' => Commands\ResourceMakeCommand::class,
        'ddd:make:rule' => Commands\RuleMakeCommand::class,
        'ddd:make:scope' => Commands\ScopeMakeCommand::class,
        'ddd:make:middleware' => Commands\MiddlewareMakeCommand::class,
        'ddd:make:controller' => Commands\ControllerMakeCommand::class,
        'ddd:make:factory' => Commands\FactoryMakeCommand::class,
        'ddd:make:stub' => Commands\StubPublishCommand::class,
        'ddd:make:action' => Commands\MakeActionCommand::class,
        'ddd:make:data' => Commands\DataMakeCommand::class,
        'ddd:make:view-model' => Commands\ViewModelMakeCommand::class,
    ],
];
