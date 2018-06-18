<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCollections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_collections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('saved_app_id')->nullable()->unsigned();
            $table->integer('saved_page_id')->nullable()->unsigned();
            $table->integer('collection_id')->nullable()->unsigned();

            $table->foreign('saved_app_id')->references('id')->on('saved_apps');
            $table->foreign('saved_page_id')->references('id')->on('saved_pages');
            $table->foreign('collection_id')->references('id')->on('collections');
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
        Schema::dropIfExists('content_collections');
    }
}
