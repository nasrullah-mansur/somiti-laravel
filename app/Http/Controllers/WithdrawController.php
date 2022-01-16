<?php

namespace App\Http\Controllers;

use App\Models\Holder;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class WithdrawController extends Controller
{
    public function select_policy()
    {
        $policies = Holder::orderBy('policy')->where('status', STATUS_ON)->get('policy');
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
        $day = Session::get('today_day');
        $month = Session::get('today_month');
        $year = Session::get('today_year');

        $exist = Withdraw::where('holder_id', $holder->id)->where('day', $day)->where('month', $month)->where('year', $year)->first();
        return view('front.withdraw.create', compact('holder', 'exist'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'number' => 'required|integer',
            're_number' => 'required|same:number',
        ]);
        // return $request;
        $holder = Holder::where('id', $id)->firstOrFail();

        $day = Session::get('today_day');
        $month = Session::get('today_month');
        $year = Session::get('today_year');

        if($request->has('old_value')) {
            $withdraw = Withdraw::where('holder_id', $holder->id)->where('day', $day)->where('month', $month)->where('year', $year)->firstOrFail();
        } else {
            $withdraw = new Withdraw();
        }


        $withdraw->holder_id = $holder->id;
        $withdraw->day = $day;
        $withdraw->month = $month;
        $withdraw->year = $year;
        $withdraw->amount = $request->number;

        if($holder->balance >= $request->number) {
            $withdraw->save();
        } else {
            return redirect()->back()->withErrors('you are not eligible for loan');
        }

        if($request->has('old_value')) {
            $prev = $request->old_value;
            $current = ($request->number) - $prev;

            if($current < 0) {
                $holder->balance = ($holder->balance) + abs($current);
            } else {
                $holder->balance = ($holder->balance) - abs($current);
            }
        } else {
            $holder->balance = ($holder->balance) - $request->number;
        }

        $holder->save();
        
        Toastr::success($holder->name . ' ' . $request->number . ' টাকা নগদ তুলেছেন !!', 'অভিনন্দন', ["positionClass" => "toast-bottom-left"]);


        return redirect()->route('withdraw.check.ability', $id);
        
    }
}
