<?php

namespace App\Providers;

use App\Hashing\PepperedHasher;
use Illuminate\Support\Facades\Hash;
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
        // Override bcrypt driver dengan versi peppered
        Hash::extend('bcrypt', function ($app) {
            return new PepperedHasher(
                $app['config']->get('hashing.bcrypt') ?? []
            );
        });
    }
}
