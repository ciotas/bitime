<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlansRequest;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlansController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, Plan $plan)
    {
        if($request->market)
        {
            $plans = Plan::where(['user_id' => Auth::id(), 'market' => $request->market])->withOrder()->paginate();
        } else {
            $plans = Plan::where('user_id', Auth::id())->withOrder()->paginate();
        }
        return view('plans.index', compact('plans', 'plan'));
    }

    public function search(Plan $plan)
    {
        $words = trim(request('q'));
        if ($words) {
            $plans = $plan->search($words)->paginate(20);
            return view('plans.search', compact('plans', 'plan'))->with('q', $words);
        } else {
            $plans = Plan::where('user_id', Auth::id())->withOrder()->paginate();
            return view('plans.index', compact('plans', 'plan'));
        }
    }

    public function create(Plan $plan)
    {
        return view('plans.edit', compact('plan'));
    }

    public function update(PlansRequest $request, Plan $plan)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['market'] = $request->market ?? 'crypto';
        $plan->update($data);
        return redirect()->route('plans.index', ['market', $request->market])->with('success', '修改'.$plan->symbol.'的交易计划成功！！');
    }

    public function store(PlansRequest $request, Plan $plan)
    {
        $plan = $plan->fill($request->all());
        $plan->user_id = Auth::id();
        $plan->save();

        return redirect()->route('plans.index')->with('success', '交易计划创建成功！');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('plans.index')->with('message', '交易计划删除成功！');
    }
}
