<?php

declare(strict_types=1);

use App\Uber\Application\SendEmailController;

$app->post('/', SendEmailController::class . ':execute');
