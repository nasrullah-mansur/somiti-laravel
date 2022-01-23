<?php

namespace App\Http\Controllers;

use App\Models\Loan;

use App\Models\Deposit;
use App\Models\Holder;
use App\Models\Withdraw;
use App\Models\Installment;
use Illuminate\Http\Request;

class PdfDownloadController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Download By Day
    |--------------------------------------------------------------------------
    |
    */

    public function by_day($route, $day, $month, $year)
    {
       
        // Deposit inquiry;
        if($route === 'deposit') {
            $total = 0;
            $deposits = Deposit::with('holder')->where('day', $day)->where('month', $month)->where('year', $year)->get();
            if($deposits->count() > 0) {
                $total = $deposits->sum('amount');
            }
            
            return view('pdf.day.deposit', compact('deposits', 'total', 'day', 'month', 'year'));
            
        }

        // Withdraw inquiry;
        if($route === 'withdraw') {
            if($route === 'withdraw') {
                $total = 0;
                $withdraws = Withdraw::with('holder')->where('day', $day)->where('month', $month)->where('year', $year)->get();
                if($withdraws->count() > 0) {
                    $total = $withdraws->sum('amount');
                }
                return view('pdf.day.withdraw', compact('withdraws', 'total', 'day', 'month', 'year'));
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
                return view('pdf.day.loan', compact('loans', 'total', 'day', 'month', 'year'));
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
                return view('pdf.day.installment', compact('installments', 'total', 'day', 'month', 'year'));
            }
        }

    }


    /*
    |--------------------------------------------------------------------------
    | Download By Month
    |--------------------------------------------------------------------------
    |
    */
    public function by_month($route, $month, $year)
    {
        // Deposit inquiry;
        if($route === 'deposit') {
            $deposits = Deposit::where('month', $month)->where('year', $year);
            $total = $deposits->sum('amount');
            $deposits = $deposits->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('pdf.month.deposit', compact('deposits', 'total', 'month', 'year'));
        }

        if($route === 'withdraw') {
            $withdraws = Withdraw::where('month', $month)->where('year', $year);
            $total = $withdraws->sum('amount');
            $withdraws = $withdraws->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('pdf.month.withdraw', compact('withdraws', 'total', 'month', 'year'));
        }

        if($route === 'loan') {
            $loans = Loan::where('month', $month)->where('year', $year);
            $total = $loans->sum('amount');
            $loans = $loans->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('pdf.month.loan', compact('loans', 'total', 'month', 'year'));
        }

        if($route === 'installment') {
            $installments = Installment::where('month', $month)->where('year', $year);
            $total = $installments->sum('amount');
            $installments = $installments->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('pdf.month.installment', compact('installments', 'total', 'month', 'year'));
        }
    }


     /*
    |--------------------------------------------------------------------------
    | Download By Year
    |--------------------------------------------------------------------------
    |
    */
    public function by_year($route, $year)
    {
         // Deposit inquiry;
         if($route === 'deposit') {
            $deposits = Deposit::where('year', $year);
            $total = $deposits->sum('amount');
            $deposits = $deposits->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('pdf.year.deposit', compact('deposits', 'total', 'year'));
        }

        // Withdraw inquiry;
        if($route === 'withdraw') {
            $withdraws = Deposit::where('year', $year);
            $total = $withdraws->sum('amount');
            $withdraws = $withdraws->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('pdf.year.withdraw', compact('withdraws', 'total', 'year'));
        }

        // Loan inquiry;
        if($route === 'loan') {
            $loans = Deposit::where('year', $year);
            $total = $loans->sum('amount');
            $loans = $loans->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('pdf.year.loan', compact('loans', 'total', 'year'));
        }

        // Installment inquiry;
        if($route === 'installment') {
            $installments = Deposit::where('year', $year);
            $total = $installments->sum('amount');
            $installments = $installments->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('pdf.year.installment', compact('installments', 'total', 'year'));
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Download By Year
    |--------------------------------------------------------------------------
    |
    */
    public function by_total($route)
    {
        // Deposit inquiry;
        if($route === 'deposit') {
            $deposits = Deposit::where('amount', '>', '0');
            $total = $deposits->sum('amount');
            $deposits = $deposits->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('pdf.total.deposit', compact('deposits', 'total'));
        }

        // Withdraw inquiry;
        if($route === 'withdraw') {
            $withdraws = Withdraw::where('amount', '>', '0');
            $total = $withdraws->sum('amount');
            $withdraws = $withdraws->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('pdf.total.withdraw', compact('withdraws', 'total'));
        }

        // Loan inquiry;
        if($route === 'loan') {
            $loans = Loan::where('amount', '>', '0');
            $total = $loans->sum('amount');
            $loans = $loans->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('pdf.total.loan', compact('loans', 'total'));
        }

        // Installment inquiry;
        if($route === 'installment') {
            $installments = Installment::where('amount', '>', '0');
            $total = $installments->sum('amount');
            $installments = $installments->get(['amount', 'holder_id'])->groupBy('holder_id');
            return view('pdf.total.installment', compact('installments', 'total'));
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Another download;
    |--------------------------------------------------------------------------
    |
    */

    public function all_policy_holder()
    {
        $holders = Holder::orderBy('policy')->get();
        return view('pdf.other.all_policy_holder', compact('holders'));
    }

    public function active_loan()
    {
        $loans = Loan::where('status', STATUS_ON)->with('holder')->get();
        return view('pdf.other.active_loan', compact('loans'));
    }
}
