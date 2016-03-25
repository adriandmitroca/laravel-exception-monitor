<?php

namespace Adriandmitroca\LaravelExceptionMonitor\Tests;

use Adriandmitroca\LaravelExceptionMonitor\Drivers\MailDriver;

class MailDriverTest extends TestCase
{

    /** @var \Adriandmitroca\LaravelExceptionMonitor\Tests\InMemoryMailer */
    protected $mailer;

    /** @var \Adriandmitroca\LaravelExceptionMonitor\Drivers\MailDriver */
    protected $driver;


    /** @test */
    public function setUp()
    {
        parent::setUp();

        $this->mailer = new InMemoryMailer();
        $this->driver = new MailDriver($this->mailer);
    }


    /** @test */
    public function it_can_send_a_mail_to_the_configured_mail_address()
    {
        $this->driver->send(new \Exception('This is an example exception'));

        $this->assertTrue($this->mailer->hasMessageFor('recipient@example.com'));
    }


    /** @test */
    public function it_can_send_a_mail_with_a_subject()
    {
        $this->driver->send(new \Exception('This is an example exception'));

        $this->assertTrue($this->mailer->hasMessageWithSubject('A exception has been thrown on http://localhost'));
    }


    /** @test */
    public function it_can_send_message_with_content()
    {
        $this->driver->send(new \Exception('This is an example exception'));

        $contains = false;

        foreach ($this->mailer->getMessages() as $message) {
            if ($this->mailer->hasContent('This is an example exception', $message)) {
                $contains = true;
            }
        }

        $this->assertTrue($contains);
    }
}