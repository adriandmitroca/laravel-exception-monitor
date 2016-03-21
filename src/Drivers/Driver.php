<?php

namespace Adriandmitroca\LaravelExceptionMonitor\Drivers;

interface Driver
{
    public function send(\Exception $exception);
}