@extends('layouts.front')

@section('content')
<section class="center">
    <div class="container">
        <h4 class="text-start mb-3 pb-2  border-bottom">ব্যক্তিগত তথ্য</h4>
        <form action="{{ route('user.change.password.store') }}" method="POST">
            @csrf
           
            <div class="input-area">
                <label for="name">নাম</label>
                <input id="name" name="name" type="text" placeholder="নাম" value="{{ auth()->user()->name }}">
                @if ($errors->has('name'))
                <small>নাম সঠিকভাবে দিন</small>
                @endif
            </div>
            <div class="input-area">
                <label for="email">ইমেইল</label>
                <input id="email" name="email" type="email" placeholder="ইমেইল" value="{{ auth()->user()->email }}">
                @if ($errors->has('email'))
                <small>ইমেইল সঠিকভাবে দিন</small>
                @endif
            </div>
            
            <div class="btn-area text-start">
                <button name="personal" id="add-btn" class="btn-primary btn" type="submit">ব্যক্তিগত তথ্য পরিবর্তন করুন</button>
            </div>
        </form>

        <h4 class="text-start mt-5 mb-3 pb-2 border-bottom">পাসওয়ার্ড পরিবর্তন</h4>
        <form action="{{ route('user.change.password.store') }}" method="POST">
            @csrf
           
            <div class="input-area">
                <label for="password">নতুন পাসওয়ার্ড দিন</label>
                <input id="password" name="password" type="password" placeholder="নতুন পাসওয়ার্ড দিন">
                <i class="show-pass far fa-eye"></i>
                @if ($errors->any())
                <small>সঠিকভাবে পাসওয়ার্ড দিন</small>
                @endif
            </div>
            <div class="input-area">
                <label for="re_password">পাসওয়ার্ডটি পুনরায় দিন</label>
                <input id="re_password" name="re_password" type="password" placeholder="পাসওয়ার্ডটি পুনরায় দিন">
                <i class="show-pass far fa-eye"></i>
            </div>
            
            <small class="d-block pb-2 text-start text-danger">কমপক্ষে ৮ সংখার পাসওয়ার্ড দিন</small>
            <div class="btn-area text-start">
                <button name="change_pass" id="add-btn" class="btn-primary btn" type="submit">পাসওয়ার্ড পরিবর্তন করুন</button>
            </div>
        </form>
    </div>
</section>
@endsection