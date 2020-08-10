<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->string('title');
            $table->text('video')->nullable();
            $table->text('text')->nullable();
            $table->string('status')->index();
            $table->string('slug')->unique();
            $table->string('description');
            $table->longText('body');
            $table->string('type');
            $table->integer('view')->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
         Schema::dropIfExists('posts');
    }
}
