<?php

namespace App\Providers;

use App\Notifications\VideoCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendVideoCreateNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Notifications\VideoCreated  $event
     * @return void
     */
    public function handle(VideoCreated $event)
    {
        //
    }
}
