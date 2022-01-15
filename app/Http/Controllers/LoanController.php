<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Holder;
use App\Models\Installment;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class LoanController extends Controller
{
    /* 
        // ************* Loan Account Create *************
        // ***********************************************
    
    */

    public function create_account()
    {
        $policies = Holder::orderBy('policy')->get('policy');
        return view('front.loan.account.create', compact('policies'));
    }

    public function create_account_store(Request $request)
    {
        $request->validate([
            'policy' => 'required',
        ]);

        $holder = Holder::where('policy', $request->policy)->firstOrFail();
        $exist = Loan::where('holder_id', $holder->id)->first();

        if($exist) {
            $loan_account = $exist;
        } else {
            $loan_account = new Loan();
        }

        $loan_account->holder_id = $holder->id;
        $loan_account->daily_pay = 0;
               
        $loan_account->save();

        return redirect()->route('dashboard');
    }

    /* 
        // ************* Loan Add *************
        // ***********************************************
    
    */

    public function select_policy()
    {
        $policies = Holder::orderBy('policy')->whereHas('loan') ->get(['id', 'policy']);
        return view('front.loan.account.policy', compact('policies'));
    }

    public function select_policy_store(Request $request)
    {
        $holder = Holder::where('policy', $request->policy)->firstOrFail();
        return redirect()->route('loan.ability.check', $holder->id);
    }

    public function ability_check($id)
    {
        $holder = Holder::where('id', $id)->with('loan')->firstOrFail();
        return view('front.loan.account.eligible', compact('holder'));
    }

    public function give_loan($id)
    {
        $holder = Holder::where('id', $id)->with('loan')->firstOrFail();
        return view('front.loan.account.give_loan', compact('holder'));
    }

    public function give_loan_store(Request $request)
    {
        // return $request;
        $request->validate([
            'number' => 'required|integer',
            're_number' => 'required|integer|same:number',
            'day' => 'required|integer',
            'month' => 'required|integer',
            'year' => 'required|integer',
            'daily_pay' => 'required|integer',
        ], [
            'number.required' => 'ঋণের পরিমাণ সঠিক ভাবে দিন',
            're_number.required' => 'ঋণের পরিমাণ সঠিক ভাবে দিন',
            're_number.same' => 'ঋণের পরিমাণ সঠিক ভাবে দিন',
            'daily_pay.required' => 'দৈনিক আদাদেয়র পরিমাণ সঠিক ভাবে দিন'
        ]);

        $ins = new Installment();
        $ins->holder_id = $request->holder_id;
        $ins->day = $request->day;
        $ins->month = $request->month;
        $ins->year = $request->year;
        $ins->amount = $request->number;
        $ins->save();

        $name = Holder::where('id', $request->holder_id)->firstOrFail()->name;

        Toastr::success($name . ' ' . $request->number . ' টাকা ঋণ পেয়েছেন !!', 'অভিনন্দন', ["positionClass" => "toast-bottom-left"]);

        return redirect()->route('loan.ability.check', $request->holder_id);

    }



    /* 
        // ************* Loan  *************
        // ***********************************************
    
    */

    

    
}
