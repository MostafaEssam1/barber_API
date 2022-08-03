<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarbersTable extends Migration
{

    public function up()
    {
        Schema::create('barbers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 33);
            $table->string('phone',22);
            $table->string('address',66);
            $table->string('password',50);
            $table->string('image',122);
            $table->string('image2',255);

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('barbers');
    }
}
