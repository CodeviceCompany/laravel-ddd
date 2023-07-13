<?php

use CodeviceCompany\LaravelDdd\Commands;

return [
    'commands' => [
        Commands\CastMakeCommand::class,
        Commands\ChannelMakeCommand::class,
        Commands\ConsoleMakeCommand::class,
        Commands\EventMakeCommand::class,
        Commands\ExceptionMakeCommand::class,
        Commands\JobMakeCommand::class,
        Commands\ListenerMakeCommand::class,
        Commands\MailMakeCommand::class,
        Commands\ModelMakeCommand::class,
        Commands\NotificationMakeCommand::class,
        Commands\ObserverMakeCommand::class,
        Commands\PolicyMakeCommand::class,
        Commands\ProviderMakeCommand::class,
        Commands\RequestMakeCommand::class,
        Commands\ResourceMakeCommand::class,
        Commands\RuleMakeCommand::class,
        Commands\ScopeMakeCommand::class,
        Commands\MiddlewareMakeCommand::class,
        Commands\ControllerMakeCommand::class,
    ]
];
