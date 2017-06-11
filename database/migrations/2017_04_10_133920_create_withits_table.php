<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_ip')->nullable();
            $table->integer('title')->nullable();
            $table->boolean('check')->default(0);
            $table->integer('numeric')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withits');
    }
}
