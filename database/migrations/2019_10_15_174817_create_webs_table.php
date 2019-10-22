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
            $table->string('urgent_message')->nullable()->comment('站点通知');
            $table->string('copyright')->nullable()->comment('版权信息');
            $table->string('author')->nullable()->comment('网站作者');
            $table->string('record')->nullable()->comment('备案信息');
            $table->string('contact')->nullable()->comment('联系方式1');
            $table->string('contact_bak')->nullable()->comment('联系方式2');
            $table->timestamp('time')->nullable()->comment('网站创时间');
            $table->string('img_api')->default('https://s0.xinger.ink/acgimg/acgurl.php?')->comment('随机图片API');
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
