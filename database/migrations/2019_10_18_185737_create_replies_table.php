<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('comment_id')->index()->unsigned()->comment('评论id');
            $table->bigInteger('fromId')->index()->unsigned()->comment('评论者id');
            $table->string('fromName')->comment('评论者昵称');
            $table->string('fromAvatar')->comment('评论者头像');
            $table->bigInteger('toId')->comment('被评论者id');
            $table->string('toName')->comment('评论者昵称');
            $table->string('toAvatar')->comment('评论者昵称');
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
        Schema::dropIfExists('replies');
    }
}
