<?php

namespace App\Providers;

use App\Mail\UserCreated;
use App\Mail\UserMailChanged;
use App\Prodect;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // because utf8mb4 -> 4 * 255 = 1020 and Mysql 7677/4 = 191
        Schema::defaultStringLength(191);  

        User::created(function($user){
            
            retry(5 , function() use($user) {
                Mail::to($user /*or $user->email*/)->send(new UserCreated($user));
            },100/*ms*/);

        });

        User::updated(function($user){
            if($user->isDirty('email')){
                retry(5 , function() use($user) {
                    Mail::to($user)->send(new UserMailChanged($user));
                },100);
            }
        });

        Prodect::updated(function($prodect){
            if ($prodect->quantity == 0 && $prodect->isAvailable()) {
                $prodect->status = Prodect::UNAVAILABLE_PRODECT;

                $prodect->save();
            }
        }); 
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
