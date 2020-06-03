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
        $this->mergeConfigFrom(__DIR__.'/config/changemail.php','changeMail');
        $this->publishes([__DIR__ . '/config/changemail.php' => config_path('changemail.php')]);
        parent::boot();
    }

    public function register()
    {
        $this->app->register(EventServiceProvider::class);
    }
}