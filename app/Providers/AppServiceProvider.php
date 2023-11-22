<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
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
        View::composer('layout.layout', function ($view) {
            $userData = auth()->user();
            if($userData)
            {
                if ($userData->role == 'superadmin')
                {
                    $profileData = DB::table('v_SuperAdmin')->where('user_id', $userData->user_id)->first();

                    $view->with('profile', $profileData);
                }
                
                elseif ($userData->role == 'admin')
                {
                    $profileData = DB::table('v_admin')->where('user_id', $userData->user_id)->first();

                    $view->with('profile', $profileData);
                }

                elseif ($userData->role == 'bendaharasekolah')
                {
                    $profileData = DB::table('v_bendahara')->where('user_id', $userData->user_id)->first();

                    $view->with('profile', $profileData);
                }

                elseif ($userData->role == 'pemohon')
                {
                    $profileData = DB::table('v_pemohon')->where('user_id', $userData->user_id)->first();

                    $view->with('profile', $profileData);
                }

            }
        });
    }
}
