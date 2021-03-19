<?php

declare(strict_types=1);

namespace App\Uber\Infra;

use App\Uber\Domain\Provider;

class MailGunProvider implements Provider
{
    public function send(array $data): void
    {
        error_log("erro ao tentar enviar...");
        
        throw new \RuntimeException("ops");
    }
}