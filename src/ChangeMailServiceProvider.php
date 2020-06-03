<?php

namespace Arseni\ChangeMail;

use App\Providers\EventServiceProvider;
use Arseni\ChangeMail\Listeners\LogSendingMessage;
use Illuminate\Mail\Events\MessageSending;
use App\Providers\EventServiceProvider as ServiceProvider;

class ChangeMailServiceProvider extends ServiceProvider
{
    protected $listen = [
        MessageSending::class => [
            LogSendingMessage::class,
        ]
    ];

    public function boot()
    {
        parent::boot();

        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/config/config.php' => config_path('config.php')]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/config.php','changeMail');
        $this->app->register(EventServiceProvider::class);
    }
}