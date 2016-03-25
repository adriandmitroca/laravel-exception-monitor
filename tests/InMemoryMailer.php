<?php

namespace Adriandmitroca\LaravelExceptionMonitor\Tests;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Collection;

class InMemoryMailer implements Mailer
{

    private $messages;


    public function __construct()
    {
        $this->messages = collect();
    }


    public function send($template, array $data, $callback)
    {
        $message = new Message($template, $data);
        $callback($message);

        $this->messages[] = $message;
    }


    public function raw($text, $callback)
    {
    }


    public function failures()
    {
    }


    public function hasMessageFor($email)
    {
        return $this->messages->contains(function ($i, $message) use ($email) {
            return $message->to === $email;
        });
    }


    public function hasMessageWithSubject($subject)
    {
        return $this->messages->contains(function ($i, $message) use ($subject) {
            return $message->subject === $subject;
        });
    }


    public function hasContent($content, Message $message)
    {
        return str_contains($this->renderMessage($message), $content);
    }


    public function getMessages()
    {
        return $this->messages;
    }


    protected function renderMessage(Message $message)
    {
        return view($message->template, $message->data)->render();
    }
}