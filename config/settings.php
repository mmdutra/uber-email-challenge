<?php

return [
    \App\Uber\Domain\UseCases\SendEmail::class => function ($c) {
        return new \App\Uber\Domain\UseCases\SendEmail([
                new \App\Uber\Infra\MailGunProvider(),
                new \App\Uber\Infra\SendGridProvider()
            ]
        );
    },
    \App\Uber\Application\SendEmailController::class => function ($c) {
        return new \App\Uber\Application\SendEmailController($c->get(\App\Uber\Domain\UseCases\SendEmail::class));
    }
];