<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $categories = [
            [
                'user_id'     => '1',
                'name'        => 'PHP',
                'description' => 'Laravel',
            ],
            [
                'user_id'     => '1',
                'name'        => 'Linux',
                'description' => 'Linux系统运维',
            ],
            [
                'user_id'     => '1',
                'name'        => 'Tools',
                'description' => '开发工具',
            ],
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::table('categories')->truncate();
    }
}
