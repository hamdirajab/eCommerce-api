<?php

use App\Category;
use App\Prodect;
use App\Transaction;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

    	DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Category::truncate();
        Prodect::truncate();
        Transaction::truncate();
        DB::table('category_prodect')->truncate();

        User::flushEventListeners();
        Category::flushEventListeners();
        Prodect::flushEventListeners();
        Transaction::flushEventListeners();

        $usersQuentity = 1000;
        $categoriesQuentity = 30;
        $prodectrsQuentity = 1000;
        $transactionsQuentity = 1000;

        factory(User::class , $usersQuentity)->create();

        factory(Category::class , $categoriesQuentity)->create();

        factory(Prodect::class , $prodectrsQuentity)->create()->each(function($prodect){
            
            $categories = Category::all()->random(mt_rand(1,5))->pluck('id');

            $prodect->categories()->attach($categories);
        });

        factory(Transaction::class , $transactionsQuentity)->create();
        
    }
}
