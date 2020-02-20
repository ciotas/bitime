<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Plan extends Model
{
    use Searchable;

    public function searchableAs()
    {
        return 'plans_index';
    }

    public function toSearchableArray()
    {
        return [
            'symbol' => $this->symbol,
            'name' => $this->name,
        ];
    }

    protected $fillable = [
        'user_id', 'crypto', 'symbol', 'name', 'side', 'total',
        'lever', 'period', 'type', 'keyPrice',
        'lowestPrice', 'targetPrice', 'breakevenPrice', 'ticker', 'expectRate'
    ];

    protected $appends = ['availableMoney', 'availableShares', 'maxStopLossDis',
        'stopLossPrice', 'shouldBuyPrice', 'worthToBuy'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWithOrder($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }

    public function getAvailableMoneyAttribute()
    {
        return sprintf('%.0f', ($this->total * $this->lever)/4);
    }

    public function getAvailableSharesAttribute()
    {
        return sprintf('%.2f', $this->availableMoney/$this->keyPrice);
    }

    public function getMaxStopLossDisAttribute()
    {
        $len = _getFloatLength($this->ticker);
        return sprintf('%.'.$len.'f', $this->keyPrice * 0.015);
    }

    public function getStopLossPriceAttribute()
    {
        if ($this->side == 'buy')
        {
            return $this->lowestPrice - 2 * $this->ticker;
        } else {
            return $this->lowestPrice + 2 * $this->ticker;
        }
    }

    public function getShouldBuyPriceAttribute()
    {
        if ($this->side == 'buy')
        {
            return $this->stopLossPrice + $this->maxStopLossDis;
        } else {
            return $this->stopLossPrice - $this->maxStopLossDis;
        }

    }

    public function getWorthToBuyAttribute()
    {
        return $this->maxStopLossDis > 0 ? abs($this->targetPrice - $this->ShouldBuyPrice) / $this->maxStopLossDis <=> $this->expectRate : '-1';
    }
}
