<?php

namespace Adriandmitroca\LaravelExceptionMonitor\Tests;

use Adriandmitroca\LaravelExceptionMonitor\ExceptionMonitorServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{

    protected function getPackageProviders($app)
    {
        return [ ExceptionMonitorServiceProvider::class ];
    }


    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('exception-monitor.drivers', 'mail');
    }
}