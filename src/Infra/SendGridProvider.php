<?php

declare(strict_types=1);

namespace App\Uber\Infra;

use App\Uber\Domain\Provider;

class SendGridProvider implements Provider
{
    public function send(array $data): void
    {
        error_log("enviando...\n");
        
        throw new \RuntimeException("ops");
    }
}