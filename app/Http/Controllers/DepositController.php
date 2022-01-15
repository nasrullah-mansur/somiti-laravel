<?php

namespace App\Http\Controllers;

use App\Models\Money;
use App\Models\Holder;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DepositController extends Controller
{
    public function deposit_date()
    {
        return view('front.deposit.date');
    }

    public function deposit_date_check(Request $request)
    {
        $request->validate([
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);

        session([
            'today_day' => $request->day,
            'today_month' => ($request->month) - 1,
            'today_year' => $request->year,
        ]);

        return redirect()->route('deposit.policy.select');
    }

    public function policy_select()
    {
        if(Session::has('today_day') && Session::has('today_month') && Session::has('today_year')) {
            $policies = Holder::orderBy('policy')->get('policy');
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
        // return Session::all();
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

        // return $balance;

        $balance->save();

        return redirect()->route('deposit.policy.select');
    }
}
