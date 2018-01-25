<?php

namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class PrismicServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        View::composer('*', 'App\Http\ViewComposers\PrismicComposer');
    }
}
