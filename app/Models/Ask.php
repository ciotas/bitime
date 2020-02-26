<?php

namespace App\Models;

use App\Models\Analyzer;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Ask extends Model
{
    protected $fillable = ['user_id', 'market', 'name', 'symbol', 'period', 'total', 'unit', 'lever', 'remark', 'status'];

    protected $appends = ['statusName'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWithOrder($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }

    public function getStatusNameAttribute()
    {
        switch ($this->status)
        {
            case 'todo':
                return '<span class="text-danger">待处理</span>'; break;
            case 'doing':
                return '<span class="text-warning">分析中</span>'; break;
            case 'done':
                return '<span class="text-success">已完成</span>'; break;
        }
    }

    public function getTotalAttribute($total)
    {
        $len = numberOfDecimals($total);
        return round($total, $len);
    }

    public function analyzer()
    {
        return $this->hasOne(Analyzer::class);
    }
}
