<?php

declare(strict_types=1);

namespace App\Uber\Domain;

class SendGridProvider implements Provider
{
    public function send(array $data): void
    {
        error_log("enviando...\n");
    }
}