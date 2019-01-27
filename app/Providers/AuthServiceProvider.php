<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // register a route for OAuth 2.0
        Passport::routes();

        Passport::tokensExpireIn(Carbon::now()->addMinutes(30));
//        Passport::tokensExpireIn(Carbon::now()->addSeconds(30));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));

        // don't use for code by this but it's less security
        Passport::enableImplicitGrant();

        Passport::tokensCan([

            'purchase-product' => 'Create a new transaction for specific user',
            'manage-products' => 'Create, read, update, delete products (CRUD)',

            'manage-account' => 'Read your account data id, name, email, if verified, 
             and if admin (Cannot read password). Modify your account data (email, and password).
             Cannot delete your account',

            'read-general' => 'Read general information like purchasing categories, 
            purchased product , selling products , selling categories, your transactions 
            (purchases and sales)',

        ]);

    }
}
