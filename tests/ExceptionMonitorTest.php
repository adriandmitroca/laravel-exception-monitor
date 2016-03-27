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
    }


    public function test_it_sends_exceptions()
    {
        // @TODO Check if sendException() was called.
    }


    public function test_it_sends_notification_on_enabled_environments()
    {
        $monitor = new ExceptionMonitor();
        $this->app['config']->set('exception-monitor.environments', 'production');
        $this->assertTrue($monitor->enabledEnvironment('production'));
        $this->assertFalse($monitor->enabledEnvironment('local'));

        $this->app['config']->set('exception-monitor.environments', [ 'production', 'staging' ]);
        $this->assertTrue($monitor->enabledEnvironment('production'));
        $this->assertTrue($monitor->enabledEnvironment('staging'));
        $this->assertFalse($monitor->enabledEnvironment('local'));
    }

}