<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Analyzer extends Model
{
    protected $fillable = ['ask_id', 'plan_id', 'body', 'use_plan'];

    protected $casts = [
        'use_plan' => 'boolean'
    ];

    public function ask()
    {
        return $this->belongsTo(Ask::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
