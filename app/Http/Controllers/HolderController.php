<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Holder;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Brian2694\Toastr\Facades\Toastr;

class HolderController extends Controller
{

    public function index()
    {
        return view('front.holder.policy.index');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = Holder::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    if($row->status == STATUS_ON) {
                        $deleteBtn = '<a class="btn btn-sm btn-secondary me-1 delete-btn" href="'.route('holder.delete', $row->id).'">
                                            <i class="fas fa-lock"></i>
                                            বন্ধ
                                        </a>';
                    } else {
                        $deleteBtn = '<a class="btn btn-sm btn-secondary me-1 delete-btn" href="'.route('holder.delete', $row->id).'">
                                            <i class="fas fa-lock-open"></i>
                                            চালু
                                        </a>';
                        }
                    

                    $actionBtn = '<div class="d-flex">
                    <a class="btn btn-sm btn-primary me-1" href="'. route('holder.show', $row->id) .'">
                        <i class="fas fa-eye"></i>
                        দেখুন
                    </a>
                    <a class="btn btn-sm btn-primary me-1" href="'.route('holder.edit', $row->id).'">
                        <i class="fas fa-edit"></i>
                        এডিট
                    </a>'. $deleteBtn .' </div>';
                    
                    return $actionBtn;
                })
                ->editColumn('photo', function($row) {
                    if($row->photo) {
                        return '<img width="90" src="'. asset($row->photo) .'" alt="img">';
                    } else {
                        return 'ছবি নাই';
                    }
                })
                ->editColumn('balance', function($row) {
                    if($row->balance) {
                        return $row->balance;
                    } else {
                        return '0';
                    }
                })
                ->editColumn('status', function($row) {
                    if($row->status == 'on') {
                        return 'চালু';
                    } else {
                        return 'বন্ধ';
                    }
                })
                ->editColumn('joining_date', function($row) {

                    $months = [
                        '01' => 'জানুয়ারী',
                        '02' => 'ফেব্রুয়ারী',
                        '03' => 'মার্চ',
                        '04' => 'এপ্রিল',
                        '05' => 'মে',
                        '06' => 'জুন',
                        '07' => 'জুলাই',
                        '08' => 'আগস্ট',
                        '09' => 'সেপ্টেম্বর',
                        '10' => 'অক্টবর',
                        '11' => 'নভেম্বর',
                        '12' => 'ডিসেম্বর',
                    ];

                    $day = Carbon::parse($row->joining_date)->format('d');
                    $month = Carbon::parse($row->joining_date)->format('m');
                    $year = Carbon::parse($row->joining_date)->format('Y');

                    return ($months[$month] . ' ' . $day . ' ' . $year);
                })
                ->rawColumns(['action', 'photo'])
                ->make(true);
        }
    }

    public function create()
    {
        return view('front.holder.policy.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'policy' => 'required|unique:holders',
            'name' => 'required',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $year = $request->year;
        $month = $request->month;
        $day = $request->day;
        $joining_date = new Carbon($year . '-' . $month . '-' . $day);
        
        $holder = new Holder();
        $holder->policy = strtoupper( trim($request->policy) );
        $holder->name = $request->name;
        $holder->joining_date = $joining_date;
        $holder->address = $request->address;
        $holder->phone = trim($request->phone);
        $holder->balance = $request->balance;

        if($request->hasFile('photo')) {
            $holder->photo = ImageUpload($request->photo, 'uploaded_photo/', null);
        }
        
        $holder->save();
        return $holder;

    }

    public function edit($id)
    {
        $holder = Holder::where('id', $id)->firstOrFail();
        return view('front.holder.policy.edit', compact('holder'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $year = $request->year;
        $month = $request->month;
        $day = $request->day;
        $joining_date = new Carbon($year . '-' . $month . '-' . $day);
        
        $holder = Holder::where('id', $request->id)->firstOrFail();
        $holder->name = $request->name;
        $holder->joining_date = $joining_date;
        $holder->address = $request->address;
        $holder->phone = trim($request->phone);
        $holder->balance = $request->balance;

        if($request->hasFile('photo')) {
            $holder->photo = ImageUpload($request->photo, 'uploaded_photo/', null);
        }
        
        $holder->save();
        return $request;
    }

    public function delete($id)
    {
        $holder = Holder::where('id', $id)->firstOrFail();
        // removeImage($holder->photo);
        if($holder->status == STATUS_ON) {
            $holder->status = STATUS_OFF;
        } else {
            $holder->status = STATUS_ON;
        }

        $holder->save();

        // $deposits = Deposit::where('holder_id', $holder->id)->get();
        // foreach ($deposits as $deposit) {
        //     $deposit->delete();
        // }
        Toastr::success('একাউন্টটির অবস্থা সফলভাবে পরিবর্তিত হয়েছে', 'অভিনন্দন', ["positionClass" => "toast-bottom-left"]);
        return redirect()->route('holder.index');
    }

    

    public function show($id)
    {
        $holder = Holder::where('id', $id)->firstOrFail();
        return view('front.holder.single.view', compact('holder'));
    }
}
