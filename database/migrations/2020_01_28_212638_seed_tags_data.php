<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SeedTagsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tags = [
            [
                'name' => 'PHP&Laravel',
                'topics_count' => 0,
            ],
            [
                'name' => 'Vue.js',
                'topics_count' => 0,
            ],
            [
                'name' => 'Python',
                'topics_count' => 0,
            ],
            [
                'name' => 'Golang',
                'topics_count' => 0,
            ],
            [
                'name' => '前端',
                'topics_count' => 0,
            ],
            [
                'name' => '管理',
                'topics_count' => 0,
            ],
            [
                'name' => '金融',
                'topics_count' => 0,
            ],
            [
                'name' => '历史',
                'topics_count' => 0,
            ],
            [
                'name' => '经济',
                'topics_count' => 0,
            ],
            [
                'name' => '商业',
                'topics_count' => 0,
            ],
            [
                'name' => '儒家',
                'topics_count' => 0,
            ],
            [
                'name' => '易经',
                'topics_count' => 0,
            ],
            [
                'name' => '佛学',
                'topics_count' => 0,
            ],

        ];

        DB::table('tags')->insert($tags);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('tags')->truncate();
    }
}
