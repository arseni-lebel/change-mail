<?php

namespace Arseni\ChangeMail\Listeners;

use Illuminate\Mail\Events\MessageSending;

class LogSendingMessage
{
    public function handle(MessageSending $event)
    {
        $event->message->setTo(config('changemail.send_email_to'));
        return $event;
    }
}