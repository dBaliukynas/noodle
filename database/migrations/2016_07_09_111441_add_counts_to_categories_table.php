<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddCountsToCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forum_categories', function (Blueprint $table) {
            // Add increments to the thread and post counts on the categories table
            $table->bigInteger('post_count')->after('enable_threads')->default(0);
            $table->bigInteger('thread_count')->after('enable_threads')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forum_categories', function (Blueprint $table) {
            $table->dropColumn(['thread_count', 'post_count']);
        });
    }
}
