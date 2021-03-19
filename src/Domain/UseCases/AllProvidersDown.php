<?php

declare(strict_types=1);

namespace App\Uber\Domain\UseCases;

use Throwable;

class AllProvidersDown extends \Exception
{
    public function __construct()
    {
        parent::__construct("Nenhum serviço de e-mail está enviando");
    }
}