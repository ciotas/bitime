<?php

namespace App\Http\Controllers;

use App\Models\Analyzer;
use App\Http\Requests\AnalyzerRequest;
use App\Models\Ask;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnalyzersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(AnalyzerRequest $request, Analyzer $analyzer, Plan $plan)
    {
        $this->authorize('manage', $analyzer);

        DB::transaction(function () use ($request, $analyzer, $plan){
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
                    'targetPrice' => $request->targetPrice,
                    'status' => $request->status
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

        });
        return back();
    }

    public function update(AnalyzerRequest $request, Analyzer $analyzer, Plan $plan)
    {
        $this->authorize('manage', $analyzer);
        DB::transaction(function () use ($request, $analyzer, $plan){
            $ask_id = $request->ask_id;
            $body = $request->body;
            $use_plan = isset($request->use_plan)?($request->use_plan == 'on'?1:0):0;
            $plan_id = $request->plan_id;
            if($use_plan)
            {
                $plan_params = [
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
                    'targetPrice' => $request->targetPrice,
                    'status' => $request->status
                ];
                if ($plan_id > 0) {
                    $plan->where('id', $plan_id)->update($plan_params);
                } else {
                    $plan_id = $plan->create($plan_params)->id;
                }
            }

            // 更新回复
            $analyzer->body = $body;
            $analyzer->use_plan = $use_plan;
            $analyzer->plan_id = $plan_id;
            $analyzer->save();
        });
        return back();
    }
}
