<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\SubscribeRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
    protected $subscribe;

    public function __construct(SubscribeRepo $subscribe)
    {
        $this->middleware('auth');
        $this->subscribe = $subscribe;
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();
        $plan_id = $request->plan_id;
        $this->subscribe->store([
            'user_id'=> $user_id,
            'plan_id' => $plan_id
        ]);
        return back()->with('success', '订阅成功！');
    }

    public function destroy(Request $request)
    {
        $user_id = Auth::id();
        $plan_id = $request->plan_id;
        $this->subscribe->del($user_id, $plan_id);
        return back();
    }
}
