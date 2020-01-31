<?php

namespace App\Console\Commands;

use App\Models\Tag;
use App\Models\Taggable;
use Illuminate\Console\Command;

class CalcTopicscount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calc:topicscount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '计算标签下topics的数量';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tags = Tag::all();
        foreach ($tags as $tag)
        {
            $topics_count = Taggable::where('tag_id', $tag->id)->count();
            Tag::where('id', $tag->id)->update(['topics_count', $topics_count]);
        }
    }
}
