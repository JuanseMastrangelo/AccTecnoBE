<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('description');
            $table->string('purchaseValue');
            $table->string('saleValue');
            $table->string('count');
            $table->foreign('categorieId')->references('id')->on('categories');
            $table->foreign('subCategorieId')->references('id')->on('categories');
            $table->string('high')->nullable();
            $table->string('width')->nullable();
            $table->string('colour')->nullable();
            $table->string('warranty')->nullable();
            $table->string('model')->nullable();
            $table->string('weight')->nullable();
            $table->string('RAM')->nullable();
            $table->longText('files')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        //
    }
}
