<?php

namespace App\Providers;

use App\Assistant;
use App\Business;
use Carbon\Carbon;
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
            $saludo = 'Buenos días,';
        } elseif ($now->hour >= 12 && $now->hour < 19) {
            $saludo = 'Buenas tardes,';
        } else {
            $saludo = 'Buenas noches,';
        }
        $assistant = Assistant::get();
        $assistant = Assistant::where('id', 1)->firstOrFail();
        $business = Business::get();
        $business = Business::where('id', 1)->firstOrFail();
        if ($business->name) {
            Config::set('app.name', $business->name);
        }
        view()->share('assistant', $assistant);
        view()->share('business', $business);
        view()->share('saludo', $saludo);
    }
}
