<?php

namespace App\Http\Controllers;

use App\Ask;
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

    public function index(Request $request)
    {
        $builder = Auth::user()->asks()->withOrder();
        $status = $request->status ?? 'all';
        if ($status != 'all') {
            $builder->where('status', $status);
        }
        $asks = $builder->paginate(15);
        return view('asks.index', ['asks'=>$asks, 'filters'=>['status'=>$status]]);
    }

    public function show(Ask $ask)
    {
        return view('asks.show', compact('ask'));
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
