<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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
        'market', 'symbol', 'name', 'side', 'total',
        'lever', 'period', 'type', 'keyPrice',
        'lowestPrice', 'targetPrice', 'breakevenPrice', 'status','tag'
    ];

    protected $appends = ['availableMoney', 'availableShares', 'maxStopLossDis',
        'stopLossPrice', 'shouldBuyPrice', 'worthToBuy', 'ticker',
        'userSubscribed', 'maxLoss', 'maxProfit', 'realRate'];

    const EXPECT_STATUS_STRONG_NO_SUGGEST = 'strong_no_suggest'; // <=1
    const EXPECT_STATUS_NO_SUGGEST = 'no_suggest'; // 1<x<3
    const EXPECT_STATUS_CAN_IN = 'can_in'; // >3 && <=4
    const EXPECT_STATUS_SUGGEST_IN = 'suggest_in'; // >5 && < 8
    const EXPECT_STATUS_STRONG_IN = 'strong_in'; // >= 8

    // 让状态的中英文对应起来
    public static $expectStatusMap = [
        self::EXPECT_STATUS_STRONG_NO_SUGGEST    => '不可入场',
        self::EXPECT_STATUS_NO_SUGGEST    => '不建议入场',
        self::EXPECT_STATUS_CAN_IN    => '可入场',
        self::EXPECT_STATUS_SUGGEST_IN    => '建议入',
        self::EXPECT_STATUS_STRONG_IN => '强烈建议入'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'subscribes');
    }

    public function scopeWithOrder($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeWithTag($query, $tag)
    {
        return $query->where('tag', $tag);
    }
    public function getAvailableMoneyAttribute()
    {
        return round(($this->total * $this->lever) / 4);
    }

    public function getAvailableSharesAttribute()
    {
        return round($this->availableMoney / $this->keyPrice, 2);
    }

    public function getMaxStopLossDisAttribute()
    {
        $len = numberOfDecimals($this->ticker);
        return round($this->keyPrice * env('STOP_LOSS_PA', 0.015), $len);
    }

    public function getStopLossPriceAttribute()
    {
        $len = numberOfDecimals($this->ticker);
        if ($this->side == 'buy') {
            return round($this->lowestPrice - 2 * $this->ticker, $len);
        } else {
            return round($this->lowestPrice + 2 * $this->ticker, $len);
        }
    }

    public function getShouldBuyPriceAttribute()
    {
        $len = numberOfDecimals($this->ticker);
        if ($this->side == 'buy') {
            return round($this->stopLossPrice + $this->maxStopLossDis, $len);
        } else {
            return round($this->stopLossPrice - $this->maxStopLossDis, $len);
        }
    }

    public function getWorthToBuyAttribute()
    {
        if ($this->realRate < 1) {
            return static::$expectStatusMap[static::EXPECT_STATUS_STRONG_NO_SUGGEST];
        } elseif ($this->realRate >= 1 && $this->realRate < 3) {
            return static::$expectStatusMap[static::EXPECT_STATUS_NO_SUGGEST];
        } elseif ($this->realRate >= 3 && $this->realRate < 5) {
            return static::$expectStatusMap[static::EXPECT_STATUS_CAN_IN];
        } elseif ($this->realRate >= 5 && $this->realRate < 8) {
            return static::$expectStatusMap[static::EXPECT_STATUS_SUGGEST_IN];
        } else {
            return static::$expectStatusMap[static::EXPECT_STATUS_STRONG_IN];
        }
    }

    public function getRealRateAttribute()
    {
        return  round(abs($this->targetPrice - $this->ShouldBuyPrice) / $this->maxStopLossDis, 2) ;
    }

    public function getBreakevenPriceAttribute($breakevenPrice)
    {
        $len = numberOfDecimals($breakevenPrice);
        return $breakevenPrice ? round($breakevenPrice, $len) : '';
    }

    public function getTargetPriceAttribute($targetPrice)
    {
        $len = numberOfDecimals($targetPrice);
        return $targetPrice ? round($targetPrice, $len) : '';
    }

    public function getTotalAttribute($total)
    {
        return $total ? round($total) : '';
    }

    public function getKeyPriceAttribute($keyPrice)
    {
        $len = numberOfDecimals($keyPrice);
        return $keyPrice ? round($keyPrice, $len) : '';
    }

    public function getLowestPriceAttribute($lowestPrice)
    {
        $len = numberOfDecimals($lowestPrice);
        return $lowestPrice ? round($lowestPrice, $len) : '';
    }

    public function getMaxLossAttribute()
    {
        return round($this->maxStopLossDis * $this->AvailableShares);
    }

    public function getMaxProfitAttribute()
    {
        return round(abs($this->targetPrice - $this->ShouldBuyPrice) * $this->AvailableShares);
    }

    public function getUserSubscribedAttribute()
    {
        return in_array(Auth::id(), $this->users->pluck('id')->toArray()) ? true : false;
    }

    public function analyzer()
    {
        return $this->hasOne(Analyzer::class);
    }

    protected function getTickerAttribute()
    {
        $ticker = 0.01;
        switch ($this->market)
        {
            case 'crypto':
                $ticker = config('classification.crypto_tickers')[$this->symbol] ?? 0.01;
                break;
            case 'hongkong':
                $ticker = $this->hongkongMinTicker($this->keyPrice);
                break;
            default:
                $ticker = 0.01;
        }
        return $ticker;
    }

    protected function hongkongMinTicker($val)
    {
        if ($val >= 0.01 && $val < 0.25)
        {
            return 0.001;
        } elseif ($val >= 0.25 && $val < 0.5)
        {
            return 0.005;
        } elseif ($val >= 0.5 && $val < 10)
        {
            return 0.01;
        } elseif ($val >= 10 && $val < 20)
        {
            return 0.02;
        } elseif ($val >= 20 && $val < 100)
        {
            return 0.05;
        } elseif ($val >= 100 && $val < 200)
        {
            return 0.1;
        } elseif ($val >= 200 && $val < 500)
        {
            return 0.2;
        } elseif ($val >= 500 && $val < 1000)
        {
            return 0.5;
        } elseif ($val >= 1000 && $val < 2000)
        {
            return 1;
        } elseif ($val >= 2000 && $val < 5000)
        {
            return 2;
        } elseif ($val >= 5000 && $val < 9995)
        {
            return 5;
        }
    }
}
