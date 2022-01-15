<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SelectDateController extends Controller
{
    public function select($page)
    {
        return view('front.date.select', compact('page'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);

        session([
            'today_day' => $request->day,
            'today_month' => ($request->month),
            'today_year' => $request->year,
        ]);

        if($request->page == 'deposit') {
            return redirect()->route('deposit.policy.select');
        } 
        
        elseif($request->page == 'loan') {
            return redirect()->route('loan.select.policy');
        }

        elseif($request->page == 'withdraw') {
            return redirect()->route('withdraw.select.policy');
        }

        elseif($request->page == 'installment') {
            return redirect()->route('ins.select.policy');
        }



    }
}
