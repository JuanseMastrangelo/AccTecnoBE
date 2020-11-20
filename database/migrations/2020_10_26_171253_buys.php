<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Buys extends Migration
{
    public function up()
    {
        Schema::create('buys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('idProduct');
            $table->string('status');
            $table->string('descripcion');
            $table->timestamps();
        });
    }

    public function down()
    {
    }
}
