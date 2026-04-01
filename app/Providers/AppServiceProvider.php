<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $view->with([
                    'data_nama' => Auth::user()->nama_pengguna,
                    'data_level' => Auth::user()->level,
                ]);
            }
        });
    }

    public function register()
    {
        //
    }
}