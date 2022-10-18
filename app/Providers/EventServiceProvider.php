<?php

namespace App\Providers;

use App\Events\OrderCreated;
use App\Events\OrderUpdated;
use App\Events\UserVerified;
use App\Events\UserPasswordReset;
use App\Listeners\CreateOrderInAX;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendOrderCreatedEmail;
use App\Listeners\SendOrderUpdatedEmail;
use App\Listeners\SendNewUserRegistrationEmail;
use App\Listeners\SendCustomerOrderCreatedEmail;
use App\Listeners\SendCustomerVerificationEmail;
use App\Listeners\SendCustomerPasswordResetEmail;
use App\Listeners\SendCustomerRegistrationEmail;
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
          SendCustomerRegistrationEmail::class,
          SendNewUserRegistrationEmail::class,
        ],
        OrderCreated::class => [
          SendOrderCreatedEmail::class,
          SendCustomerOrderCreatedEmail::class,
          CreateOrderInAX::class,
        ],
        OrderUpdated::class => [
          SendOrderUpdatedEmail::class,
        ],
        UserPasswordReset::class => [
          SendCustomerPasswordResetEmail::class,
        ],
        UserVerified::class => [
          SendCustomerVerificationEmail::class,
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
