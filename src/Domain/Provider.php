<?php

declare(strict_types=1);

namespace App\Uber\Domain;

interface Provider
{
    public function send(array $data): void;
}