<?php

namespace Adriandmitroca\LaravelExceptionMonitor\Drivers;

use Illuminate\Mail\Mailer;

class MailDriver implements Driver
{

    protected $mailer;


    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }


    public function send(\Exception $exception)
    {
        $config = config('exception-monitor.mail');

        $this->mailer->send('laravel-exception-monitor::email', [ 'e' => $exception ],
            function ($message) use ($config) {
                $message->from($config['from'])->to($config['to'])->subject('A exception has been thrown on ' . config('app.url'));
            });
    }
}