<?php

use App\Prodect;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prodects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description' , 1000);
            $table->integer('quantity')->unsigned();
            $table->string('status')->default(Prodect::UNAVAILABLE_PRODECT);
            $table->string('image');
            $table->integer('seller_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('seller_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prodects');
    }
}
