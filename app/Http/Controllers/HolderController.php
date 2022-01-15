<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Holder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use DataTables;

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
                    $actionBtn = '<div class="d-flex">
                    <a class="btn btn-sm btn-primary me-1" href="'. route('holder.show', $row->id) .'">
                        <i class="fas fa-eye"></i>
                        দেখুন
                    </a>
                    <a class="btn btn-sm btn-primary me-1" href="'.route('holder.edit', $row->id).'">
                        <i class="fas fa-edit"></i>
                        এডিট
                    </a>
                    <a class="btn btn-sm btn-secondary me-1 delete-btn" href="'.route('holder.delete', $row->id).'">
                        <i class="fas fa-trash-alt"></i>
                        ডিলিট
                    </a>
                </div>';
                    return $actionBtn;
                })
                ->editColumn('photo', function($row) {
                    if($row->photo) {
                        return '<img width="90" src="'. asset($row->photo) .'" alt="img">';
                    } else {
                        return 'ছবি নাই';
                    }
                })
                ->editColumn('joining_date', function($row) {
                    return Carbon::parse($row->joining_date)->format('F j, Y');
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
        removeImage($holder->photo);
        $holder->delete();

        $deposits = Deposit::where('holder_id', $holder->id)->get();
        foreach ($deposits as $deposit) {
            $deposit->delete();
        }

        return redirect()->route('holder.index');
    }

    

    public function show($id)
    {
        $holder = Holder::where('id', $id)->firstOrFail();
        return view('front.holder.single.view', compact('holder'));
    }
}
