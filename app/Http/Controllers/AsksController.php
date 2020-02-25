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

    public function store(AskRequest $request)
    {
        $data = $request->all();
        $user_id = Auth::id();
        $data['user_id'] = $user_id;
        $this->ask->store($data);
        return redirect()->route('users.show', ['user' => $user_id, 'tab'=>'ask']);
    }

    public function destroy(Ask $ask)
    {
        $this->authorize('own', $ask);
        $ask->delete();
        return back();
    }
}
