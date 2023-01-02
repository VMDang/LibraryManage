<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view){
            $userFlash = DB::table('users')
                ->where('id', '=', Auth::id())
                ->get(['id', 'image', 'name', 'email']);

            $view->with(['userFlash' => $userFlash]);
        });
    }
}
