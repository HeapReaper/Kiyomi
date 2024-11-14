<?php

namespace Modules\Users\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Users\Events\UsersContactWasSubmitted;
use Modules\Users\Listeners\SendEmailToUsers;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @author AutiCodes
     *
     * @var array<string, array<int, string>>
     */
    protected $listen = [
        UsersContactWasSubmitted::class => [
            SendEmailToUsers::class,
        ],
    ];

    /**
     * Indicates if events should be discovered.
     *
     * @var bool
     */
    protected static $shouldDiscoverEvents = true;

    /**
     * Configure the proper event listeners for email verification.
     */
    protected function configureEmailVerification(): void
    {
        //
    }
}
