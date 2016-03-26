<?php

namespace Adriandmitroca\LaravelExceptionMonitor\Drivers;

interface DriverInterface
{
    public function send(\Exception $exception);
}