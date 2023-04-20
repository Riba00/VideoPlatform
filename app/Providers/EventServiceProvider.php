<?php

namespace App\Providers;

use App\Events\SeriesImageUpdated;
use App\Events\VideoCreated;
use App\Listeners\ScheduleSeriesImageProcessing;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendVideoCreatedNotification;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        VideoCreated::class => [
            SendVideoCreatedNotification::class
        ],
        SeriesImageUpdated::class => [
            ScheduleSeriesImageProcessing::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
