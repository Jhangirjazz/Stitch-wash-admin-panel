<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        Relation::morphMap([
            'laundry_order' => \App\Models\LaundryOrder::class,
            'tailor_booking' => \App\Models\TailorBooking::class,
        ]);
    }
}
