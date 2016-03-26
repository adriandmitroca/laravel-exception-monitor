Laravel Exception Monitor
================

[![Latest Version on Packagist](https://img.shields.io/packagist/v/adriandmitroca/laravel-exception-monitor.svg?style=flat-square)](https://packagist.org/packages/adriandmitroca/laravel-exception-monitor)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/adriandmitroca/laravel-exception-monitor/master.svg?style=flat-square)](https://travis-ci.org/adriandmitroca/laravel-exception-monitor)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/c681f616-ea2c-4932-81ea-138bcfdf9d14.svg?style=flat-square)](https://insight.sensiolabs.com/projects/c681f616-ea2c-4932-81ea-138bcfdf9d14)
[![Quality Score](https://img.shields.io/scrutinizer/g/adriandmitroca/laravel-exception-monitor.svg?style=flat-square)](https://scrutinizer-ci.com/g/adriandmitroca/laravel-exception-monitor)
[![Total Downloads](https://img.shields.io/packagist/dt/adriandmitroca/laravel-exception-monitor.svg?style=flat-square)](https://packagist.org/packages/adriandmitroca/laravel-exception-monitor)

This package notifies you when exceptions are thrown on some of your production application. It's like lite and free version of Bugsnag for small projects for which the use of this amazing SaaS tool would be simply overkill.

![Slack Preview](http://i.imgur.com/CtNRr6U.png)

#### Installation
``` bash
composer require adriandmitroca/laravel-exception-monitor
```

Next, you need to register Service Provider in `config/app.php`
```php
$providers = [
    ...
    Adriandmitroca\LaravelExceptionMonitor\ExceptionMonitorServiceProvider::class
    ...
]
```

and then publish configuration files
```
php artisan vendor:publish --provider="Adriandmitroca\LaravelExceptionMonitor\ExceptionMonitorServiceProvider"
```

You also have to make sure if you have [makzn/slack](https://github.com/maknz/slack) package installed and configured properly for Slack notifications.

#### Configuration
Config File is pretty self-explanatory.
```php
return [
    /*
     |--------------------------------------------------------------------------
     | Enabled sender drivers
     |--------------------------------------------------------------------------
     |
     | Send a notification about exception in your application to supported channels.
     |
     | Supported: "mail", "slack". You can use multiple drivers.
     |
     */
    'drivers'               => [ 'mail', 'slack' ],

    /*
     |--------------------------------------------------------------------------
     | Enabled application environments
     |--------------------------------------------------------------------------
     |
     | Set environments that should generate notifications.
     |
     */
    'notified_environments' => [ 'production' ],

    /*
      |--------------------------------------------------------------------------
      | Mail Configuration
      |--------------------------------------------------------------------------
      |
      | It uses your app default Mail driver. You shouldn't probably touch the view
      | property unless you know what you're doing.
      |
      */
    'mail'                  => [
        'from' => 'sender@example.com',
        'to'   => 'recipient@example.com',
        'view' => 'mails/exception-monitor'
    ],

    /*
     * Uses maknz\slack package.
     */
    'slack'                 => [
        'channel'  => '#bugtracker',
        'username' => 'Exception Monitor',
        'icon'     => ':robot_face:',
    ],
];
```

#### Usage
To start catching exceptions you have 2 options out there.

**First option**: Extend from Exception Handler provided by package (`app/Exceptions/Handler.php`):
```php
use Adriandmitroca\LaravelExceptionMonitor\MonitorExceptionHandler;
...
class Handler extends MonitorExceptionHandler
```

**Second option**: Make your `report` method in `app/Exceptions/Handler.php` to look like this:
```php
public function report(Exception $e)
{
    foreach ($this->dontReport as $type) {
        if ($e instanceof $type) {
            return parent::report($e);
        }
    }

    if (app()->bound('exception-monitor')) {
        app('exception-monitor')->notifyException($e);
    }

    parent::report($e);
}
```

#### Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information.

#### Tests
``` bash
composer test
```

#### Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for more details.

#### License
This library is licensed under the MIT license. Please see [License file](LICENSE.md) for more information.
