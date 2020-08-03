<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191); 

         View::composer('*', function ($view) {
        if(Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
        }
        elseif(Auth::check()) {
            $user = Auth::user();
        }else{
            $user = null;
        }
        
    

        $view->with('user', $user);
    });
    }
}
