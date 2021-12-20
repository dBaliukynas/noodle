<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateForumTableCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('parent_category')->unsigned();
            $table->string('title');
            $table->string('subtitle');
            $table->bigInteger('weight');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('forum_categories');
    }
}
