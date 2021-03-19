<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Provider\UseCases;

use App\Uber\Domain\Provider;
use App\Uber\Domain\AllProvidersDown;
use App\Uber\Domain\UseCases\SendEmail;
use PHPUnit\Framework\TestCase;

class SendEmailTest extends TestCase
{
    private $mailGunMock;
    private $sendGridMock;
    private array $emailData;

    protected function setUp(): void
    {
        $this->mailGunMock = $this->createMock(Provider::class);
        $this->sendGridMock = $this->createMock(Provider::class);
        
        $this->emailData = [
            'from' => 'test@example.com',
            'to' => 'test2@example.com',
            'subject' => 'test',
            'body' => '<h1> opa, amigao, salve!</h1>'
        ];
    }

    public function testShouldUseOnlyOneProvider(): void
    {
        $providers = [
            $this->mailGunMock,
            $this->sendGridMock
        ];
        
        $this->mailGunMock->expects($this->once())->method('send')->with($this->emailData);
        
        $sendEmail = new SendEmail($providers);
        
        $sendEmail->execute($this->emailData);
    }

    public function testShouldUseAllProviders(): void
    {
        $providers = [
            $this->mailGunMock,
            $this->sendGridMock
        ];
        
        $this->mailGunMock->expects($this->once())->method('send')->with($this->emailData)->willThrowException(new \RuntimeException);
        $this->sendGridMock->expects($this->once())->method('send')->with($this->emailData);
        
        $sendEmail = new SendEmail($providers);
        $sendEmail->execute($this->emailData);
    }

    public function testShouldNotSendToAnyProvider(): void
    {
        $providers = [
            $this->mailGunMock,
            $this->sendGridMock
        ];
        
        $this->mailGunMock->expects($this->once())->method('send')->with($this->emailData)->willThrowException(new \RuntimeException);
        $this->sendGridMock->expects($this->once())->method('send')->with($this->emailData)->willThrowException(new \RuntimeException);
        
        static::expectException(AllProvidersDown::class);
        
        $sendEmail = new SendEmail($providers);
        $sendEmail->execute($this->emailData);        
    }

    public function testShouldInformThatHasntProvidersAvailables(): void
    {
        static::expectException(\InvalidArgumentException::class);

        $sendEmail = new SendEmail([]);
        $sendEmail->execute($this->emailData);
    }
}