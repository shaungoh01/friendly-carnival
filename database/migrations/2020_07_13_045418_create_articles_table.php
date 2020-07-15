<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->longText("body");
            $table->unsignedBigInteger('creator_id')->nullable(); // For creator
            $table->foreign('creator_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('article_user',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('article_id')->nullable(); // For article
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable(); // For user
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'approved']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['creator_id']);
        });
        Schema::table('article_user', function (Blueprint $table){
            $table->dropForeign(['article_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('articles');
        Schema::dropIfExists('article_user');
    }
}
