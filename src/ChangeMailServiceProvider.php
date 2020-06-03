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
            $this->publishes([__DIR__ . '/config/config.php' => config_path('changemail.php')]);
        }
    }

    public function register()
    {
        $this->app->register(EventServiceProvider::class);
        $this->mergeConfigFrom(__DIR__.'/config/config.php','changemail');
    }
}