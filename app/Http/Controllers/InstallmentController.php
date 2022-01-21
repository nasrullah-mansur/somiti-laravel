<?php

namespace App\Http\Controllers;

use App\Models\Holder;
use App\Models\Installment;
use App\Models\Loan;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class InstallmentController extends Controller
{
    public function select_policy()
    {
        $policies = Holder::orderBy('policy')->whereHas('loan')->get(['id', 'policy']);
        return view('front.loan.installment.policy', compact('policies'));
    }

    public function ins_policy_store(Request $request)
    {
        $holder = Holder::where('policy', $request->policy)->firstOrFail();
        return redirect()->route('ins.create', $holder->id);
    }

    public function ins_create($id)
    {
        $holder = Holder::where('id', $id)->with('loan')->firstOrFail();
        $loan = Loan::where('holder_id', $holder->id)->orderBy('created_at', 'DESC')->firstOrFail();
        $day = Session::get('today_day');
        $month = Session::get('today_month');
        $year = Session::get('today_year');
        $exist = Installment::where('holder_id', $id)->where('day', $day)->where('month', $month)->where('year', $year)->first(); 

        return view('front.loan.installment.create', compact('holder', 'exist', 'loan'));
    }

    public function ins_store(Request $request)
    {
        
        $holder = Holder::where('id', $request->holder_id)->firstOrFail();

        $day = Session::get('today_day');
        $month = Session::get('today_month');
        $year = Session::get('today_year');

        $exist = Installment::where('holder_id', $request->holder_id)->where('day', $day)->where('month', $month)->where('year', $year)->orderBy('created_at', 'DESC')->first();
        $due_check = $holder->loan[$holder->loan->count() - 1]->due;

        if($exist) {
            $ins = $exist;
        } else {
            $ins = new Installment();
        }
        
        if($due_check < $request->number) {
            return redirect()->back()->withErrors(['error' => 'amount greater then due']);
        }

        $loan = Loan::where('holder_id', $holder->id)->orderBy('created_at', 'DESC')->firstOrFail();

        $ins->holder_id = $request->holder_id;
        $ins->amount = $request->number;
        $ins->day = $day;
        $ins->month = $month;
        $ins->year = $year;
        $ins->loan_id = $loan->id;
        $ins->save();
        
        if( $request->has('old_amount') ) {
            $old_amm = $request->old_amount;

            $current = ($request->number) - $old_amm;

            if($current < 0) {
                $due_loan = $loan->due + abs($current);
            } else {
                $due_loan = $loan->due - abs($current);
            }
        } else {
            $due_loan = $loan->due - $request->number;
        }

        $loan->due = $due_loan;
        $loan->save();

        Toastr::success($holder->name . ' ' . $request->number . ' টাকা কিস্তি জমা দিয়েছেন !!', 'অভিনন্দন', ["positionClass" => "toast-bottom-left"]);

        return redirect()->route('ins.select.policy');
        
    } 

}
