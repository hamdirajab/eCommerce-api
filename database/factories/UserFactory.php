<?php

use App\Category;
use App\Prodect;
use App\Seller;
use App\Transaction;
use App\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,

        'email' => $faker->unique()->safeEmail,

        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret

        'remember_token' => str_random(10),

        'verified' => $verified = $faker->randomElement([User::VERIFIED_USER,User::UNVERIFIED_USER]),

        'verification_token'=> $verified == User::VERIFIED_USER ? null : User::generateVerificationCode(),

        'admin' => $faker->randomElement([User::ADMIN_USER,User::REGULAR_USER]),
    ];
});

$factory->define(Category::class, function (Faker $faker) {
    return [

        'name' => $faker->word(),

        'description' => $faker->paragraph(1),
    ];
});

$factory->define(Prodect::class, function (Faker $faker) {
    return [

        'name' => $faker->word(),
        
        'description' => $faker->paragraph(1),

        'quantity' => $faker->numberBetween(1 , 10),

        'status' => $faker->randomElement([Prodect::AVAILABLE_PRODECT,Prodect::UNAVAILABLE_PRODECT]),

        'image' =>  $faker->randomElement(['1.png','2.png','3.png']),

        'seller_id'=> User::all()->random()->id,
    ];
});

$factory->define(Transaction::class, function (Faker $faker) {

	$seller = Seller::has('prodects')->get()->random();

	$buyer = User::all()->except($seller->id)->random();

    return [

		'quantity'   => $faker->numberBetween(1 , 3),

        'buyer_id'   => $buyer->id,

        'prodect_id' => $seller->prodects->random()->id,

    ];
});
