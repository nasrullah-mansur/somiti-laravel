<?php

namespace App\Http\Controllers;

use App\Models\Holder;
use Illuminate\Http\Request;

class PolicySelect extends Controller
{
    public function policy_select()
    {
        $policies = Holder::orderBy('policy')->where('status', STATUS_ON)->get('policy');
        return view('front.selection.policy', compact('policies'));
    }


    public function show(Request $request)
    {

        $for = $request->for;

        if($for === 'policy') {
            $request->validate([
                'policy'=> 'required',
            ]);
            $id = (Holder::where('policy', $request->policy)->firstOrFail())->id;
            return redirect()->route('holder.show', $id);
        }

        elseif($for === 'phone') {
            $request->validate([
                'phone'=> 'required',
            ]);

            $check_id = Holder::where('phone', $request->phone)->first();

            if(!$check_id) {
                return redirect()->back()->withErrors(['not_exist' => ['this phone no not exist.']]);
            } else {
                $id = $check_id->id;
            }

            return redirect()->route('holder.show', $id);
        }


        return abort(404);

    }
}
