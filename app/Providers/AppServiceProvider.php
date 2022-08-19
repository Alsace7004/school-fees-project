<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        //
        /*if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){ 
            $protocol = "https://".$_SERVER['HTTP_HOST']; 
        } else{ 
            $protocol='http://'.$_SERVER['HTTP_HOST']; 
        }*/

        if(env('APP_ENV') !== 'local'){
            URL::forceSchema('https');
        }
    }
}
