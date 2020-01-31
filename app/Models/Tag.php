<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'topics_count'];

    public $timestamps = false;

    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }

    public function updateTopicscount($tags)
    {
        foreach ($tags as $tag_id)
        {
            $topics_count = Taggable::where('tag_id', $tag_id)->count();
            $this->where('id', $tag_id)->update(['topics_count' => $topics_count]);
        }
    }
}
