<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function change_password()
    {
        return view('user.password');
    }

    public function change_password_store(Request $request)
    {

        $user = User::where('id', Auth::user()->id)->firstOrFail();

        if($request->has('personal')) {
            $request->validate([
                'name' => 'required|max:555',
                'email' => 'required|email|unique:users|regex:/(.+)@(.+)\.(.+)/i',
            ]);

            $user->name = $request->name;
            $user->email = $request->email;
        } 
        
        else {
            $request->validate([
                'password' => 'required|min:8',
                're_password' => 'required|same:password',
            ]);
    
            $user->password = Hash::make($request->password);
        }

        $user->save();
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }

    public function managers()
    {
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return view('user.manager.index', compact('users'));
    }

    public function managers_create()
    {
        return view('user.manager.create');
    }

    public function managers_store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:505',
            'email' => 'required|email|unique:users|regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'required|min:8',
            're_password' => 'required|same:password',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();
        Toastr::success('ম্যানেজারের একাউন্ট তৈরী সম্পন্য হয়েছে', 'অভিনন্দন', ["positionClass" => "toast-bottom-left"]);
        return redirect()->route('user.manager.index');
    }

    public function managers_delete($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $user->delete();
        return redirect()->route('user.manager.index');
        Toastr::success('ম্যানেজারের একাউন্ট ডিলিট সম্পন্য হয়েছে', 'অভিনন্দন', ["positionClass" => "toast-bottom-left"]);

    }
}
