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
}
