<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_vendor');
            $table->string('name', 30);
            $table->integer('price');
            $table->text('descr');
            $table->unsignedInteger('id_category');
            $table->unsignedInteger('quant');
            $table->integer('IBU');
            $table->integer('ABV');
            $table->unsignedInteger('id_nationality');
            $table->string('img');
            $table->timestamps();

            $table->foreign('id_vendor', 'vendor')
            ->references('id')->on('vendors')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('id_category', 'category')
               ->references('id')->on('categories')
               ->onDelete('cascade')
               ->onUpdate('cascade');
            $table->foreign('id_nationality', 'nationality')
                ->references('id')->on('nationalities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });



        Schema::table('products', function ($table) {
            $table->foreign('id_category')->references('id')->on('categories');
            $table->foreign('id_nationality')->references('id')->on('nationalities');
            $table->foreign('id_vendor')->references('id')->on('vendors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
