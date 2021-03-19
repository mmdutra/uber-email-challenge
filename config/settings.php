<?php

return [
    \App\Uber\Domain\UseCases\SendEmail::class => function ($c) {
        return new \App\Uber\Domain\UseCases\SendEmail([
                new \App\Uber\Domain\MailGunProvider(),
                new \App\Uber\Domain\SendGridProvider()
            ]
        );
    },
    \App\Uber\Application\SendEmailController::class => function ($c) {
        return new \App\Uber\Application\SendEmailController($c->get(\App\Uber\Domain\UseCases\SendEmail::class));
    }
];