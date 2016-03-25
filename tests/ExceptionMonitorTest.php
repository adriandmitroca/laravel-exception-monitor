<?php

namespace Adriandmitroca\LaravelExceptionMonitor\Tests;

use Adriandmitroca\LaravelExceptionMonitor\ExceptionMonitor;

class ExceptionMonitorTest extends TestCase
{

    /** @var \Adriandmitroca\LaravelExceptionMonitor\Tests\InMemoryMailer */
    protected $mailer;

    /** @var \Adriandmitroca\LaravelExceptionMonitor\ExceptionMonitor */
    protected $monitor;


    /**
     *
     */
    public function setUp()
    {
        parent::setUp();

        $this->monitor = new ExceptionMonitor();
    }


    public function test_it_sends_exceptions()
    {
        // @TODO Check if sendException() was called.
    }

}