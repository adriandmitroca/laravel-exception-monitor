<?php

namespace Adriandmitroca\LaravelExceptionMonitor;

class ExceptionMonitor
{

    public function notifyException(\Exception $e)
    {
        foreach (config('exception-monitor.drivers') as $driver) {
            $channel = $this->getDriverInstance($driver);
            $channel->send($e);
        }
    }


    protected function getDriverInstance($driver)
    {
        $class = '\Adriandmitroca\LaravelExceptionMonitor\Drivers\\' . ucfirst($driver) . 'Driver';

        return app($class);
    }
}
