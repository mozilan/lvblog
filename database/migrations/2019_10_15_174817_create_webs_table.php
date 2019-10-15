<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable()->comment('站点标题');
            $table->string('notice')->nullable()->comment('站点公告');
            $table->string('message')->nullable()->comment('站点通知');
            $table->string('copyright')->nullable()->comment('版权信息');
            $table->string('author')->nullable()->comment('网站作者');
            $table->string('record')->nullable()->comment('备案信息');
            $table->timestamp('time')->nullable()->comment('网站创时间');
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
        Schema::dropIfExists('webs');
    }
}
