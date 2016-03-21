<?php

namespace Adriandmitroca\LaravelExceptionMonitor;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;

class MonitorExceptionHandler extends ExceptionHandler
{
    
    /**
     * Report or log an exception.
     *
     * @param  \Exception $e
     *
     */
    public function report(Exception $e)
    {
        foreach ($this->dontReport as $type) {
            if ($e instanceof $type) {
                return parent::report($e);
            }
        }

        if (app()->bound('exception-monitor')) {
            app('exception-monitor')->notifyException($e);
            dd('Lifecycle of Exception Monitor has handed');
        }

        return parent::report($e);
    }
}