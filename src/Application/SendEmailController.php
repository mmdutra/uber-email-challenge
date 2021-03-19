<?php

declare(strict_types=1);

namespace App\Uber\Application;

use App\Uber\Domain\UseCases\SendEmail;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SendEmailController
{
    private SendEmail $sendEmail;

    public function __construct(SendEmail $sendEmail)
    {
        $this->sendEmail = $sendEmail;
    }

    public function execute(Request $request, Response $response): Response
    {
        $data = $request->getBody()->getContents();
    
        try {
            $this->sendEmail->execute((array) json_decode($data));
        
            $responseBody = ['status' => 200, 'body' => 'E-mail enviado com sucesso!'];
        
            $response->getBody()->write(json_encode($responseBody));
            return $response->withStatus(200)->withHeader('Content-Type', 'application/json; charset=utf-8');
        } catch (\Exception $exception) {
            $responseBody = ['status' => 500, 'error' => $exception->getMessage()];
            $response->getBody()->write(json_encode($responseBody));
            return $response->withStatus(500)->withHeader('Content-Type', 'application/json; charset=utf-8');
        }
    }
}