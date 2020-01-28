<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            [
                'name'        => '首页',
                'description' => '首页总揽',
            ],
            [
                'name'        => '技术',
                'description' => '我的技术随笔',
            ],
            [
                'name'        => '随笔',
                'description' => '其他知识的摘抄或感悟',
            ],
            [
                'name'        => '人生',
                'description' => '儒释道',
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
        DB::table('categories')->truncate();
    }
}
