<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //文章的外键约束
        Schema::table('articles', function (Blueprint $table) {
            // 当 user_id 对应的 users 表数据被删除时，删除词条
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        //归档的外键约束
        Schema::table('archives', function (Blueprint $table) {
            // 当 user_id 对应的 users 表数据被删除时，删除词条
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // 当 article_id 对应的 articles 表数据被删除时，删除词条
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
        //文章标签地图的外键约束
        Schema::table('article_map_tags', function (Blueprint $table) {
            // 当 article_id 对应的 articles 表数据被删除时，删除词条
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
        //标签的外键约束
        Schema::table('tags', function (Blueprint $table) {
            // 当 user_id 对应的 users 表数据被删除时，删除词条
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        //评论的外键约束
        Schema::table('comments', function (Blueprint $table) {
            // 当 fromId 对应的 users 表数据被删除时，删除此条数据
            $table->foreign('fromId')->references('id')->on('users')->onDelete('cascade');

            // 当 article_id 对应的 articles 表数据被删除时，删除此条数据
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
        //评论回复的外键约束
        Schema::table('replies', function (Blueprint $table) {
            // 当 fromId 对应的 users 表数据被删除时，删除词条
            $table->foreign('fromId')->references('id')->on('users')->onDelete('cascade');
            // 当 comment_id 对应的 comments 表数据被删除时，删除词条
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
        });
        //今日推荐的外键约束
        Schema::table('recommends', function (Blueprint $table) {
            // 当 article_id 对应的 articles 表数据被删除时，删除词条
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });

        /**
         * 我写代码从来不写注释，所以你知道下面这段代码意味着什么了吧！
         * 2019.10.19
         * Wu Nian
        /*
            //文章分类的外键约束
            Schema::table('categories', function (Blueprint $table) {
                // 当 user_id 对应的 users 表数据被删除时，删除词条
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        */
    }

    public function down()
    {
        //文章
        Schema::table('articles', function (Blueprint $table) {
            // 移除外键约束
            $table->dropForeign(['user_id']);
        });
        //归档
        Schema::table('archives', function (Blueprint $table) {
            // 移除外键约束
            $table->dropForeign(['user_id']);
            $table->dropForeign(['article_id']);
        });
        //文章标签地图的外键约束
        Schema::table('article_map_tags', function (Blueprint $table) {
            $table->dropForeign(['article_id']);
        });
        Schema::table('replies', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        //评论
        Schema::table('comments', function (Blueprint $table) {
            // 移除外键约束
            $table->dropForeign(['fromId']);
            $table->dropForeign(['article_id']);
        });
        //回复的外键约束
        Schema::table('replies', function (Blueprint $table) {
            // 移除外键约束
            $table->dropForeign(['fromId']);
            $table->dropForeign(['comment_id']);
        });
        //今日推荐的外键约束
        Schema::table('recommends', function (Blueprint $table) {
            $table->dropForeign(['article_id']);
        });
        /**
         * 下面的注释打开就炸了！
         */
//        //文章分类
//        Schema::table('categories', function (Blueprint $table) {
//            $table->dropForeign(['user_id']);
//        });

    }
}
