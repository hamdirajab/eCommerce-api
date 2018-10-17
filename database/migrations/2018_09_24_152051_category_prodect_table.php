<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoryProdectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_prodect', function (Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->integer('prodect_id')->unsigned();


            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('prodect_id')->references('id')->on('prodects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_prodect');
    }
}
