<?php

namespace App\Http\Controllers;

use App\Models\Ask;
use App\Http\Requests\AskRequest;
use App\Repositories\AskRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsksController extends Controller
{
    protected $ask;

    public function __construct(AskRepo $ask)
    {
        $this->middleware('auth');
        $this->ask = $ask;
    }

    public function index(Request $request, Ask $ask)
    {
        $builder = Auth::user()->asks()->withOrder();
        $status = $request->status ?? 'all';
        if ($status != 'all') {
            $builder->where('status', $status);
        }
        $asks = $builder->paginate(15);
        return view('asks.index', ['asks'=>$asks, 'filters'=>['status'=>$status]]);
    }

    public function listAsks(Request $request, Ask $ask)
    {
        $this->authorize('manage', $ask);
        $status = $request->tab;
        if (!in_array($status, array_keys(config('classification.plan_statuses'))))
        {
            $status = 'todo';
        }
        $asks = Ask::with('user', 'analyzer', 'analyzer.plan')->where('status', $status)->take(365)->paginate(15);
//        dd($asks->toArray());

        return view('asks.lists', compact('asks'));

    }

    public function replies()
    {
        $asks = Ask::where('user_id', Auth::id())->where('status', 'done')->paginate(15);
        return view('asks.reply', compact('asks'));
    }

    public function show(Ask $ask)
    {
        $this->authorize('own', $ask);
        $analyzer = $ask->analyzer()->with('plan')->get();
        return view('asks.show', compact('ask', 'analyzer'));
    }

    public function create(Ask $ask)
    {
        return view('asks.edit', compact('ask'));
    }

    public function edit(Ask $ask)
    {
        $this->authorize('own', $ask);
        return view('asks.edit', compact('ask'));
    }

    public function done(Ask $ask)
    {
        $this->authorize('manage', $ask);
        $ask->status = 'done';
        $ask->save();
        return back();
    }

    public function store(AskRequest $request)
    {
        $data = $request->all();
        $user_id = Auth::id();
        $data['user_id'] = $user_id;
        $this->ask->store($data);
        return redirect()->route('asks.index');
    }

    public function update(AskRequest $request, Ask $ask)
    {
        $this->authorize('own', $ask);
        $ask->update($request->all());
        return redirect()->route('asks.index');
    }

    public function destroy(Ask $ask)
    {
        $this->authorize('own', $ask);
        $ask->delete();
        return back();
    }
}
