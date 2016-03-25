<?php

namespace Adriandmitroca\LaravelExceptionMonitor;

class ExceptionMonitor
{

    /**
     * It calls all enabled drivers and triggers requests to send notifications.
     *
     * @param \Exception $e
     */
    public function notifyException(\Exception $e)
    {
        $driver = config('exception-monitor.drivers');;

        if (is_array($driver)) {
            foreach ($driver as $instance) {
                $this->sendException($e, $instance);
            }
        } else {
            $this->sendException($e, $driver);
        }
    }


    /**
     * It sends notification to given driver.
     *
     * @param \Exception $e
     * @param            $driver
     */
    protected function sendException(\Exception $e, $driver)
    {
        $channel = $this->getDriverInstance($driver);
        $channel->send($e);
    }


    /**
     * It injects driver's class to Laravel application.
     *
     * @param $driver
     *
     * @return mixed
     */
    protected function getDriverInstance($driver)
    {
        $class = '\Adriandmitroca\LaravelExceptionMonitor\Drivers\\' . ucfirst($driver) . 'Driver';

        return app($class);
    }

}
