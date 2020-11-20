<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Categories extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('idParent')->nullable();
            $table->string('files')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        //
    }
}
