<?php

namespace App\Http\Controllers;

use App\Models\Holder;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function select_policy()
    {
        $policies = Holder::orderBy('policy')->get('policy');
        return view('front.withdraw.policy', compact('policies'));
    }

    public function select_policy_add(Request $request)
    {
        $holder = Holder::where('policy', $request->policy)->firstOrFail();
        return redirect()->route('withdraw.check.ability', $holder->id);
    }

    public function check_ability($id)
    {
        $holder = Holder::where('id', $id)->firstOrFail();
        return view('front.withdraw.ability', compact('holder'));
    }

    public function create($id)
    {
        $holder = Holder::where('id', $id)->firstOrFail();
        return view('front.withdraw.create', compact('holder'));
    }

    public function store(Request $request, $id)
    {
        # code...
    }
}
