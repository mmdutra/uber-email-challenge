<?php

declare(strict_types=1);

namespace App\Uber\Domain\UseCases;

use App\Uber\Domain\Provider;

class SendEmail
{
    /**
     * @param Provider[]
    */
    private array $providers;

    public function __construct(array $providers)
    {
        $this->providers = $providers;
    }

    public function execute(array $data): void
    {
        if (empty($this->providers)) {
            throw new \InvalidArgumentException("Nenhum serviço de e-mail informado");
        }
    
        $sent = false;
        
        /** @var Provider $provider*/
        foreach ($this->providers as $provider) {
            try {
                $provider->send($data);
                $sent = true;
                break;
            } catch (\Exception $exception) {
                continue;
            }
        }
        
        if (!$sent) {
            throw new AllProvidersDown();        
        }
    }
}