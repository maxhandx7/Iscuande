<?php

namespace App\Providers;


use App\Business;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $now = Carbon::now('America/Bogota');
        $saludo = '';

        if ($now->hour >= 5 && $now->hour < 12) {
            $saludo = 'Buenos días ';
        } elseif ($now->hour >= 12 && $now->hour < 19) {
            $saludo = 'Buenas tardes ';
        } else {
            $saludo = 'Buenas noches ';
        }

        if (Schema::hasTable('businesses')) {
            $business = Business::get();
            if ($business->isNotEmpty()) {
                $business = Business::where('id', 1)->firstOrFail();
                view()->share('business', $business);
            }
        } else {
            view()->share('business', null);
        }

        view()->share('saludo', $saludo);
    }
}
