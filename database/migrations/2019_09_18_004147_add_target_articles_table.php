<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTargetArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('articles', function (Blueprint $table) {
            $table->integer('target')->unsigned()->after('slug')->comment('0:发布且公开;1:保存草稿;2:发布且私有');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('target');
        });
    }
}
