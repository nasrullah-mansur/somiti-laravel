<?php

namespace App\Http\Controllers;

use App\Models\Holder;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class DepositController extends Controller
{
   

    public function policy_select()
    {
        if(Session::has('today_day') && Session::has('today_month') && Session::has('today_year')) {
            $policies = Holder::orderBy('policy')->where('status', STATUS_ON)->get('policy');
            return view('front.deposit.policy', compact('policies'));
        } else {
            return view('front.deposit.date');
        }
    }

    public function policy_select_get(Request $request)
    {
        $holder = Holder::where('policy', $request->policy)->firstOrFail();
        return redirect()->route('deposit.money.create', $holder->id);
    }

    public function add_money_create($id)
    {
        $holder = Holder::where('id', $id)->firstOrFail();
        $deposit = Deposit::where('holder_id', $id)
                        ->where('day', Session::get('today_day'))
                        ->where('month', Session::get('today_month'))
                        ->where('year', Session::get('today_year'))
                        ->first();
        if($deposit) {
            return view('front.deposit.create', compact('holder', 'deposit'));
        } else {
            $deposit = null;
            return view('front.deposit.create', compact('holder', 'deposit'));
        }
    } 

    public function add_money_store(Request $request, $id)
    {
        $request->validate([
            'number' => 'required|integer|min:0',
            'con_number' => 'required|same:number'
        ]);

        $holder = Holder::where('id', $id)->firstOrFail();

        if($request->exist == 'yes') {
            $deposit = new Deposit();
            $deposit = Deposit::where('holder_id', $holder->id)
                        ->where('day', Session::get('today_day'))
                        ->where('month', Session::get('today_month'))
                        ->where('year', Session::get('today_year'))
                        ->first();
            
        } else {
            $deposit = new Deposit();
        }
        

        $deposit->holder_id = $id;
        $deposit->day = Session::get('today_day');
        $deposit->month = Session::get('today_month');
        $deposit->year = Session::get('today_year');
        $deposit->amount = $request->number;
        $deposit->save();

        $balance = Holder::where('id', $id)->firstOrFail();

        if($request->exist == 'yes') {
            $prev = $request->prev;
            $current = ($request->number) - $prev;
            if($current < 0) {
                $balance->balance =  $balance->balance - abs($current);
            } else {
                $balance->balance =  $balance->balance + abs($current);
            }
        } else {
            $balance->balance = $balance->balance + $request->number;
        }

        $balance->save();

        Toastr::success($holder->name . ' ' . $request->number . ' টাকা নগদ জমা দিয়েছেন !!', 'অভিনন্দন', ["positionClass" => "toast-bottom-left"]);


        return redirect()->route('deposit.policy.select');
    }
}
