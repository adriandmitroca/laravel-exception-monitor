<?php

namespace Adriandmitroca\LaravelExceptionMonitor\Drivers;

use Illuminate\Contracts\Mail\Mailer;

class MailDriver implements Driver
{

    protected $mailer;


    /**
     * MailDriver constructor.
     *
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }


    /**
     * It sends e-mail notification for a given exception.
     *
     * @param \Exception $exception
     */
    public function send(\Exception $exception)
    {
        $config = config('exception-monitor.mail');

        $this->mailer->send('laravel-exception-monitor::email', [ 'e' => $exception ], function ($m) use ($config) {
            $m->from($config['from']);
            $m->to($config['to']);
            $m->subject('A exception has been thrown on ' . config('app.url'));
        });
    }
}