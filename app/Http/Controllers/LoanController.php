<?php

namespace App\Http\Controllers;
use DataTables;
use App\Models\Loan;
use App\Models\Holder;
use App\Models\Installment;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class LoanController extends Controller
{
    /* 
        // ************* Loan Account Create *************
        // ***********************************************
    
    */

    public function create_account()
    {
        $policies = Holder::orderBy('policy')->where('status', STATUS_ON)->get('policy');
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
            $loan_account->daily_pay = 0;
        }

        $loan_account->holder_id = $holder->id;
               
        $loan_account->save();
        Toastr::success($holder->name . ' ' . $holder->policy . ' ঋণ গ্রহন করতে পারবেন !!', 'অভিনন্দন', ["positionClass" => "toast-bottom-left"]);
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
        $holder = Holder::where('id', $id)->with('loan')->whereHas('loan')->firstOrFail();
        $loan = Loan::where('holder_id', $id)->orderBy('created_at', 'DESC')->firstOrFail();
        return view('front.loan.account.eligible', compact('holder', 'loan'));
    }


    /* 
        // ************* Give Loan  *************
        // ***********************************************
    
    */

    public function give_loan($id)
    {
        if(Holder::count() == 0) {
            abort(404);
        }
        $holder = Holder::where('id', $id)->with('loan')->orderBy('created_at', 'DESC')->firstOrFail();
        $loan = Loan::where('holder_id', $id)->orderBy('created_at', 'DESC')->firstOrFail();
       
        return view('front.loan.account.give_loan', compact('holder', 'loan'));
    }

    public function give_loan_store(Request $request)
    {
        
        $request->validate([
            'number' => 'required|integer',
            're_number' => 'required|integer|same:number',
            'daily_pay' => 'required|integer',
        ], [
            'number.required' => 'ঋণের পরিমাণ সঠিক ভাবে দিন',
            're_number.required' => 'ঋণের পরিমাণ সঠিক ভাবে দিন',
            're_number.same' => 'ঋণের পরিমাণ সঠিক ভাবে দিন',
            'daily_pay.required' => 'দৈনিক আদাদেয়র পরিমাণ সঠিক ভাবে দিন'
        ]);

        $exist = Loan::where('holder_id', $request->holder_id)->orderBy('created_at', 'DESC')->firstOrFail();

        if($exist->due == null && $exist->amount == null) {
            $ins = $exist;
            $ins->day = Session::get('today_day');
            $ins->month = Session::get('today_month');
            $ins->year = Session::get('today_year');
        } 
        elseif($exist->due == 0 && $exist->amount > 0) {
            $ins = new Loan();
            $ins->day = $request->day;
            $ins->month = $request->month;
            $ins->year = $request->year;
        } 
        else {
            $ins = $exist;
        }
        
        $ins->holder_id = $request->holder_id;
        
        $ins->amount = $request->number;
        $ins->due = $request->number;
        $ins->daily_pay = $request->daily_pay;
        $ins->save();

        $name = Holder::where('id', $request->holder_id)->firstOrFail()->name;

        Toastr::success($name . ' ' . $request->number . ' টাকা ঋণ পেয়েছেন !!', 'অভিনন্দন', ["positionClass" => "toast-bottom-left"]);

        return redirect()->route('loan.ability.check', $request->holder_id);

    }


    /* 
        // ************* Loan Account  *************
        // ***********************************************
    
    */

    public function index()
    {
        return view('front.loan.account.index');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = Loan::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if($row->status == STATUS_ON) {
                        $deleteBtn = '<a class="btn btn-sm btn-secondary me-1 delete-btn" href="'.route('loan.delete', $row->id).'">
                                            <i class="fas fa-lock"></i>
                                            বন্ধ
                                        </a>';
                    } else {
                        $deleteBtn = '<a class="btn btn-sm btn-secondary me-1 delete-btn" href="'.route('loan.delete', $row->id).'">
                                            <i class="fas fa-lock-open"></i>
                                            চালু
                                        </a>';
                        }

                    $actionBtn = '<div class="d-flex">
                    <a class="btn btn-sm btn-primary me-1" href="'. route('holder.show', $row->holder->id) .'">
                        <i class="fas fa-eye"></i>
                        দেখুন
                    </a> '. $deleteBtn .' </div>';
                    return $actionBtn;
                })
                ->editColumn('photo', function($row) {
                    if($row->holder->photo) {
                        return '<img width="90" src="'. asset($row->photo) .'" alt="img">';
                    } else {
                        return 'ছবি নাই';
                    }
                })
                ->editColumn('name', function($row) {
                    return $row->holder->name;
                })
                ->editColumn('policy', function($row) {
                    return $row->holder->policy;
                })
                ->editColumn('amount', function($row) {
                    if($row->amount) {
                        return $row->amount;
                    } else {
                        return DEFAULT_BLANK_DATA;
                    }
                })
                ->editColumn('due', function($row) {
                    if($row->due) {
                        return $row->due;
                    } else {
                        return DEFAULT_BLANK_DATA;
                    }
                })
                ->editColumn('status', function($row) {
                    if($row->status == STATUS_ON) {
                        return 'চালু';
                    } else {
                        return 'বন্ধ';
                    }
                })
                ->editColumn('balance', function($row) {
                    if($row->holder->balance) {
                        return $row->holder->balance;
                    } else {
                        return '0';
                    }
                })
                
                ->editColumn('collected', function($row) {
                    $collected_val = ($row->amount) - ($row->due);
                    return $collected_val;
                })
                ->editColumn('date', function($row) {

                    $months = [
                        '1' => 'জানুয়ারী',
                        '2' => 'ফেব্রুয়ারী',
                        '3' => 'মার্চ',
                        '4' => 'এপ্রিল',
                        '5' => 'মে',
                        '6' => 'জুন',
                        '7' => 'জুলাই',
                        '8' => 'আগস্ট',
                        '9' => 'সেপ্টেম্বর',
                        '10' => 'অক্টবর',
                        '11' => 'নভেম্বর',
                        '12' => 'ডিসেম্বর',
                    ];

                    $day = $row->day;
                    $month = $row->month;
                    $year = $row->year;

                    if($row->day && $row->month && $row->year) {
                        return ($months[$month] . ' ' . $day . ' ' . $year);
                    }

                    else {
                        return DEFAULT_BLANK_DATA;
                    }

                })
                ->rawColumns(['action', 'photo'])
                ->make(true);
        }
    }

    public function delete($id)
    {
        $loan = Loan::where('id', $id)->firstOrFail();

        if($loan->due > 0) {
            Toastr::warning('গ্রাহকের কাছে ঋণ পাওনা রয়েছে !!', 'দুঃখিত', ["positionClass" => "toast-bottom-left"]);
            return redirect()->back();
        }

        else {
            
            Toastr::success('ঋণ একাউন্টটির অবস্থা সফলভাবে পরিবর্তিত হয়েছে !!', 'অভিনন্দন', ["positionClass" => "toast-bottom-left"]);
            if($loan->status == STATUS_ON) {
                $loan->status = STATUS_OFF;
            } else {
                $loan->status = STATUS_ON;
            }

            $loan->save();
            return redirect()->back();
        }
    }
 
}
