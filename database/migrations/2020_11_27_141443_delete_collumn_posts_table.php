<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteCollumnPostsTable extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('description');
        });
    }
}
