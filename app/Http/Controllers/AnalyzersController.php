<?php

namespace App\Http\Controllers;

use App\Models\Analyzer;
use App\Http\Requests\AnalyzerRequest;
use App\Models\Ask;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnalyzersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(AnalyzerRequest $request, Analyzer $analyzer, Plan $plan)
    {
        $this->authorize('manage', $analyzer);
        $user_id = Auth::id();
        $ask_id = $request->ask_id;
        $body = $request->body;
        $use_plan = isset($request->use_plan)?($request->use_plan == 'on'?1:0):0;

        $plan_id = null;

        if($use_plan)
        {
            $plan_id = $plan->create([
                'market' => $request->market,
                'symbol' => $request->symbol,
                'name' => $request->name,
                'period' => $request->period,
                'total' => $request->total,
                'lever' => $request->lever,
                'ticker' => $request->ticker,
                'side' => $request->side,
                'type' => $request->type,
                'keyPrice' => $request->keyPrice,
                'lowestPrice' => $request->lowestPrice,
                'breakevenPrice' => $request->breakevenPrice,
                'targetPrice' => $request->targetPrice
            ])->id;
        }

        // 保存回复
        $analyzer->fill([
            'ask_id'=>$ask_id,
            'body' => $body,
            'use_plan'=>$use_plan,
            'plan_id' => $plan_id
        ]);
        $analyzer->save();

        // 更改诊股状态
        $ask = Ask::find($ask_id);
        $ask->status = 'doing';
        $ask->save();
        return back();
    }

    public function update(AnalyzerRequest $request, Analyzer $analyzer)
    {
        $this->authorize('manage', $analyzer);
    }
}
