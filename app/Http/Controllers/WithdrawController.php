<?php

namespace App\Http\Controllers;

use App\Models\Holder;
use App\Models\Withdraw;
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
        $request->validate([
            'number' => 'required|integer',
            're_number' => 'required|same:number',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required'
        ]);
        // return $request;
        $holder = Holder::where('id', $id)->firstOrFail();
        $withdraw = new Withdraw();

        $withdraw->holder_id = $holder->id;
        $withdraw->day = $request->day;
        $withdraw->month = $request->month;
        $withdraw->year = $request->year;
        $withdraw->amount = $request->number;

        if($holder->balance >= $request->number) {
            $withdraw->save();
        } else {
            return redirect()->back()->withErrors('you are not eligible for loan');
        }


        $holder->balance = ($holder->balance) - $request->number;
        $holder->save();

        return redirect()->route('withdraw.check.ability', $id);
        
    }
}
