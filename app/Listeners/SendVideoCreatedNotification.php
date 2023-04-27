<?php

namespace App\Listeners;

use App\Events\VideoCreated;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendVideoCreatedNotification implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(VideoCreated $event)
    {
        Notification::route('mail', config('casteaching.admins'))
            ->route('broadcast', config('casteaching.admins'))
            ->notify(new \App\Notifications\VideoCreated($event->video));    }
}
