<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateForumTableThreads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_threads', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('parent_category')->unsigned();
            $table->bigInteger('author_id')->unsigned();
            $table->string('title');
            $table->boolean('pinned');
            $table->boolean('locked');
            $table->bigInteger('likes')->default(0);

            $table->timestamps();
            $table->softDeletes();
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('forum_threads');
    }
}
