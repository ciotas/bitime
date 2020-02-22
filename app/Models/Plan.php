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
        return round(($this->total * $this->lever)/4);
    }

    public function getAvailableSharesAttribute()
    {
        return round($this->availableMoney/$this->keyPrice, 2);
    }

    public function getMaxStopLossDisAttribute()
    {
        $len = _getFloatLength($this->ticker);
        return round($this->keyPrice * 0.015, $len);
    }

    public function getStopLossPriceAttribute()
    {
        $len = _getFloatLength($this->ticker);
        if ($this->side == 'buy')
        {
            return round($this->lowestPrice - 2 * $this->ticker, $len);
        } else {
            return round($this->lowestPrice + 2 * $this->ticker, $len);
        }
    }

    public function getShouldBuyPriceAttribute()
    {
        $len = _getFloatLength($this->ticker);
        if ($this->side == 'buy')
        {
            return round($this->stopLossPrice + $this->maxStopLossDis, $len);
        } else {
            return round($this->stopLossPrice - $this->maxStopLossDis, $len);
        }
    }

    public function getWorthToBuyAttribute()
    {
        return $this->maxStopLossDis > 0 ? abs($this->targetPrice - $this->ShouldBuyPrice) / $this->maxStopLossDis <=> $this->expectRate : '-1';
    }

    public function getBreakevenPriceAttribute($breakevenPrice)
    {
        $len = _getFloatLength($this->ticker);
        return $breakevenPrice ? number_format($breakevenPrice, $len) : '';
    }

    public function getTargetPriceAttribute($targetPrice)
    {
        $len = _getFloatLength($this->ticker);
        return $targetPrice ? number_format($targetPrice, $len) : '';
    }

    public function getTotalAttribute($total)
    {
        return $total ? number_format($total) : '';
    }

    public function getTickerAttribute($ticker)
    {
        $len = _getFloatLength($ticker);
        return $ticker ? number_format($ticker, $len) : '';
    }

    public function getKeyPriceAttribute($keyPrice)
    {
        $len = _getFloatLength($this->ticker);
        return $keyPrice ? number_format($keyPrice, $len) : '';
    }

    public function getLowestPriceAttribute($lowestPrice)
    {
        $len = _getFloatLength($this->ticker);
        return $lowestPrice ? number_format($lowestPrice, $len) : '';
    }
}
