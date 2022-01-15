<?php

namespace App\Http\Controllers;

use App\Models\Holder;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    public function select_policy()
    {
        $policies = Holder::orderBy('policy')->whereHas('loan') ->get(['id', 'policy']);
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
        return view('front.loan.installment.create', compact('holder'));
    }

    

}
