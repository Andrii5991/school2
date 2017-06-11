<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titles', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->string('sub_title')->nullable()->default(null);
            $table->integer('logotype');
            $table->integer('image')->nullable()->default(null);
            $table->string('utm');
            $table->longText('text')->nullable();
            $table->integer('form')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->string('video')->nullable()->default(null);
            $table->tinyInteger('default')->default(0);
            $table->string('templates');
            $table->integer('views')->default(0);
            $table->integer('lead')->default(0);
            $table->float('conversion')->default(0);
            $table->tinyInteger('sort')->default(0);
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('titles');
    }
}
