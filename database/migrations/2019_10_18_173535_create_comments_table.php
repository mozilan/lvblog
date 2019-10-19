<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('article_id')->unsigned()->index()->comment('文章id');
            $table->bigInteger('fromId')->unsigned()->index()->comment('评论者id');
            $table->integer('type')->comment('评论类型');
            $table->string('fromName')->comment('评论者昵称');
            $table->string('fromAvatar')->comment('评论者头像');
            $table->bigInteger('likeNum')->comment('点赞次数');
            $table->string('contents')->comment('评论内容');
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
        Schema::dropIfExists('comments');
    }
}
