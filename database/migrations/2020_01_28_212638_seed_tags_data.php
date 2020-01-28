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
                'tagName' => 'PHP&Laravel',
                'category_id' => 2,
                'tag_count' => 0,
            ],
            [
                'tagName' => 'Vue.js',
                'category_id' => 2,
                'tag_count' => 0,
            ],
            [
                'tagName' => 'Python',
                'category_id' => 2,
                'tag_count' => 0,
            ],
            [
                'tagName' => 'Golang',
                'category_id' => 2,
                'tag_count' => 0,
            ],
            [
                'tagName' => '前端',
                'category_id' => 2,
                'tag_count' => 0,
            ],
            [
                'tagName' => '管理',
                'category_id' => 3,
                'tag_count' => 0,
            ],
            [
                'tagName' => '金融',
                'category_id' => 3,
                'tag_count' => 0,
            ],
            [
                'tagName' => '历史',
                'category_id' => 3,
                'tag_count' => 0,
            ],
            [
                'tagName' => '经济',
                'category_id' => 3,
                'tag_count' => 0,
            ],
            [
                'tagName' => '商业',
                'category_id' => 3,
                'tag_count' => 0,
            ],
            [
                'tagName' => '儒家',
                'category_id' => 4,
                'tag_count' => 0,
            ],
            [
                'tagName' => '易经',
                'category_id' => 4,
                'tag_count' => 0,
            ],
            [
                'tagName' => '佛学',
                'category_id' => 4,
                'tag_count' => 0,
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
