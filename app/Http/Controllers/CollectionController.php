<?php

namespace App\Http\Controllers;

use App\Models\Money;
use App\Models\Holder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CollectionController extends Controller
{
    public function collection_date()
    {
        return view('front.money.date');
    }

    public function collection_date_check(Request $request)
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

        return redirect()->route('collection.policy.select');
    }

    public function policy_select()
    {
        if(Session::has('today_day') && Session::has('today_month') && Session::has('today_year')) {
            $policies = Holder::orderBy('policy')->get('policy');
            return view('front.money.policy', compact('policies'));
        } else {
            return view('front.money.date');
        }
    }

    public function policy_select_get(Request $request)
    {
        $holder = Holder::where('policy', $request->policy)->firstOrFail();
        return redirect()->route('collection.money.create', $holder->id);
    }

    public function add_money_create($id)
    {
        // return Session::all();
        $holder = Holder::where('id', $id)->firstOrFail();
        $money = Money::where('holder_id', $id)
                        ->where('day', Session::get('today_day'))
                        ->where('month', Session::get('today_month'))
                        ->where('year', Session::get('today_year'))
                        ->first();
        if($money) {
            return view('front.money.create', compact('holder', 'money'));
        } else {
            $money = null;
            return view('front.money.create', compact('holder', 'money'));
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
            $money = new Money();
            $money = Money::where('holder_id', $holder->id)
                        ->where('day', Session::get('today_day'))
                        ->where('month', Session::get('today_month'))
                        ->where('year', Session::get('today_year'))
                        ->first();
            
        } else {
            $money = new Money();
        }
        

        $money->holder_id = $id;
        $money->day = Session::get('today_day');
        $money->month = Session::get('today_month');
        $money->year = Session::get('today_year');
        $money->amount = $request->number;
        $money->save();

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

        return redirect()->route('collection.policy.select');
    }
}
