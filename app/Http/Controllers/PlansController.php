<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlansRequest;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlansController extends Controller
{
    protected $binance;

    public function __construct()
    {
//        $this->binance = app('binance');
    }

    public function index(Request $request, Plan $plan)
    {
        if(! $request->market)
        {
            return redirect()->route('plans.index', ['market'=>'crypto']);
        }

        if (Auth::check() && Auth::user()->can('manage_trades')) {
            $plans = Plan::where('market', $request->market)->withOrder()->paginate(12);
        } else {
            $plans = Plan::where('market', $request->market)->withStatus('public')->withOrder()->paginate(12);
        }
        return view('plans.index', compact('plans', 'plan'));
    }

    public function search(Plan $plan)
    {
        $words = trim(request('q'));
        if ($words) {
            $plans = $plan->search($words)->paginate(12);
            return view('plans.search', compact('plans'))->with('q', $words);
        } else {
            $plans = Plan::withOrder()->paginate(12);
            return view('plans.index', compact('plans', 'plan'));
        }
    }

    public function create(Plan $plan)
    {
        return view('plans.edit', compact('plan'));
    }

    public function edit(Plan $plan)
    {
        return view('plans.edit', compact('plan'));
    }

    public function update(PlansRequest $request, Plan $plan)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['market'] = $request->market ?? 'crypto';
        $plan->update($data);
        return redirect()->route('plans.index', ['market' => $request->market])->with('success', '修改'.$plan->symbol.'的交易计划成功！！');
    }

    public function store(PlansRequest $request, Plan $plan)
    {
        $plan = $plan->fill($request->all());
        $plan->user_id = Auth::id();
        $plan->save();
        return redirect()->route('plans.index', [ 'market' => $plan->market ])->with('success', $plan->name.'的交易计划发布成功！');
    }

    public function destroy(Plan $plan)
    {
        $this->authorize('own', $plan);
        $plan->delete();
        return redirect()->route('plans.index')->with('message', '交易计划删除成功！');
    }
}
