<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'tag_count'];

    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }
}
