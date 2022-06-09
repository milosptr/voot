<?php

namespace App\Providers;

use App\Events\OrderCreated;
use App\Events\UserPasswordReset;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendOrderCreatedEmail;
use App\Listeners\SendCustomerOrderCreatedEmail;
use App\Listeners\SendCustomerPasswordResetEmail;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderCreated::class => [
          SendOrderCreatedEmail::class,
          SendCustomerOrderCreatedEmail::class,
          CreateOrderInAX::class,
        ],
        UserPasswordReset::class => [
          SendCustomerPasswordResetEmail::class,
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
}
