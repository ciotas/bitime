<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $table = 'subscribes';

    protected $fillable = ['plan_id', 'user_id'];
}
