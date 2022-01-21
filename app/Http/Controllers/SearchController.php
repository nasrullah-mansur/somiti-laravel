<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Installment;
use App\Models\Loan;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function select_date($route)
    {
        return view('front.search.date.select', compact('route'));
    }


    /*
    |--------------------------------------------------------------------------
    | Search By Day
    |--------------------------------------------------------------------------
    |
    */

    public function day($route)
    {
        return view('front.search.date.day', compact('route'));
    }

    public function day_store(Request $request)
    {
        $day = $request->day;
        $month = $request->month;
        $year = $request->year;
        $page = $request->page;

        return redirect()->route('search.data.by.day', [$page, $day, $month, $year]);
    }

    public function search_data_by_day($route, $day, $month, $year)
    {

        // Deposit inquiry;
        if($route === 'deposit') {
            $total = 0;
            $deposits = Deposit::with('holder')->where('day', $day)->where('month', $month)->where('year', $year)->get();
            if($deposits->count() > 0) {
                $total = $deposits->sum('amount');
            }
            return view('front.search.deposit.day', compact('deposits', 'total', 'day', 'month', 'year'));
        }

        // Withdraw inquiry;
        if($route === 'withdraw') {
            if($route === 'withdraw') {
                $total = 0;
                $withdraws = Withdraw::with('holder')->where('day', $day)->where('month', $month)->where('year', $year)->get();
                if($withdraws->count() > 0) {
                    $total = $withdraws->sum('amount');
                }
                return view('front.search.withdraw.day', compact('withdraws', 'total', 'day', 'month', 'year'));
            }
        }

        // Loan inquiry;
        if($route === 'loan') {
            if($route === 'loan') {
                $total = 0;
                $loans = Loan::with('holder')->where('day', $day)->where('month', $month)->where('year', $year)->get();
                if($loans->count() > 0) {
                    $total = $loans->sum('amount');
                }
                return view('front.search.loan.day', compact('loans', 'total', 'day', 'month', 'year'));
            }
        }

        // Installment inquiry;
        if($route === 'installment') {
            if($route === 'installment') {
                $total = 0;
                $installments = Installment::with('holder', 'loan')->where('day', $day)->where('month', $month)->where('year', $year)->get();
                if($installments->count() > 0) {
                    $total = $installments->sum('amount');
                }
                return view('front.search.installment.day', compact('installments', 'total', 'day', 'month', 'year'));
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Search By Month
    |--------------------------------------------------------------------------
    |
    */

    public function month($route)
    {
        return view('front.search.date.month', compact('route'));
    }

    public function month_store(Request $request)
    {
        // return $request;
        $page = $request->page;
        $month = $request->month;
        $year = $request->year;

        return redirect()->route('search.data.by.month', [$page, $month, $year]);
    }

    public function search_data_by_month($route, $month, $year)
    {
        // Deposit inquiry;
        if($route === 'deposit') {
            $deposits = Deposit::where('month', $month)->where('year', $year);
            $total = $deposits->sum('amount');
            $deposits = $deposits->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('front.search.deposit.month', compact('deposits', 'total', 'month', 'year'));
        }

        if($route === 'withdraw') {
            $withdraws = Withdraw::where('month', $month)->where('year', $year);
            $total = $withdraws->sum('amount');
            $withdraws = $withdraws->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('front.search.withdraw.month', compact('withdraws', 'total', 'month', 'year'));
        }

        if($route === 'loan') {
            $loans = Loan::where('month', $month)->where('year', $year);
            $total = $loans->sum('amount');
            $loans = $loans->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('front.search.loan.month', compact('loans', 'total', 'month', 'year'));
        }

        if($route === 'installment') {
            $installments = Installment::where('month', $month)->where('year', $year);
            $total = $installments->sum('amount');
            $installments = $installments->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('front.search.installment.month', compact('installments', 'total', 'month', 'year'));
        }


        
    }

    /*
    |--------------------------------------------------------------------------
    | Search By Year
    |--------------------------------------------------------------------------
    |
    */

    public function year($route)
    {
        return view('front.search.date.year', compact('route'));
    }

    public function year_store(Request $request)
    {
        // return $request;
        $page = $request->page;
        $year = $request->year;

        return redirect()->route('search.data.by.year', [$page, $year]);
    }

    public function search_data_by_year($route, $year)
    {
        // Deposit inquiry;
        if($route === 'deposit') {
            $deposits = Deposit::where('year', $year);
            $total = $deposits->sum('amount');
            $deposits = $deposits->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('front.search.deposit.year', compact('deposits', 'total', 'year'));
        }

        // Withdraw inquiry;
        if($route === 'withdraw') {
            $withdraws = Deposit::where('year', $year);
            $total = $withdraws->sum('amount');
            $withdraws = $withdraws->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('front.search.withdraw.year', compact('withdraws', 'total', 'year'));
        }

        // Loan inquiry;
        if($route === 'loan') {
            $loans = Deposit::where('year', $year);
            $total = $loans->sum('amount');
            $loans = $loans->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('front.search.loan.year', compact('loans', 'total', 'year'));
        }

        // Installment inquiry;
        if($route === 'installment') {
            $installments = Deposit::where('year', $year);
            $total = $installments->sum('amount');
            $installments = $installments->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('front.search.installment.year', compact('installments', 'total', 'year'));
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Search By Total
    |--------------------------------------------------------------------------
    |
    */

    public function total($route)
    {
        return redirect()->route('search.data.by.total', $route);
    }

    public function search_data_by_total($route)
    {
        // Deposit inquiry;
        if($route === 'deposit') {
            $deposits = Deposit::where('amount', '>', '0');
            $total = $deposits->sum('amount');
            $deposits = $deposits->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('front.search.deposit.all', compact('deposits'));
        }

        // Withdraw inquiry;
        if($route === 'withdraw') {
            $withdraws = Withdraw::where('amount', '>', '0');
            $total = $withdraws->sum('amount');
            $withdraws = $withdraws->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('front.search.withdraw.all', compact('withdraws'));
        }

        // Loan inquiry;
        if($route === 'loan') {
            $loans = Loan::where('amount', '>', '0');
            $total = $loans->sum('amount');
            $loans = $loans->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('front.search.loan.all', compact('loans'));
        }

        // Installment inquiry;
        if($route === 'installment') {
            $installments = Installment::where('amount', '>', '0');
            $total = $installments->sum('amount');
            $installments = $installments->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('front.search.installment.all', compact('installments'));
        }
    }

}
