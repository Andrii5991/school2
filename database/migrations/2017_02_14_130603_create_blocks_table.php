<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bundle')->default('blocks');
            $table->longText('title');
            $table->integer('form_id')->unsigned()->index()->nullable();
            $table->longText('sub_title')->nullable()->default(null);
            $table->text('body')->nullable()->default(null);
            $table->integer('image')->nullable()->default(null);
            $table->integer('background')->nullable()->default(null);
            $table->string('color')->nullable()->default(null);
            //$table->integer('block_id')->nullable()->default(null);
            $table->string('location_image')->nullable()->default(null);
            if ((DB::connection()->getPdo()->getAttribute(PDO::ATTR_DRIVER_NAME) == 'mysql') && version_compare(DB::connection()->getPdo()->getAttribute(PDO::ATTR_SERVER_VERSION), '5.7.8', 'ge')) {
                $table->json('settings')->nullable()->default(null);
            } else {
                $table->text('settings')->nullable()->default(null);
            }
            $table->string('class')->nullable()->default(null);
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
        Schema::dropIfExists('blocks');
    }
}
