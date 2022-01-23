@extends('layouts.front')

@section('content')
<section class="center">
    <div class="container">
        
        <h4 class="text-start mt-5 mb-3 pb-2 border-bottom">ম্যানেজারের তথ্য</h4>
        <form action="{{ route('user.manager.store') }}" method="POST">
            @csrf
           
            <div class="input-area">
                <label for="name">নাম</label>
                <input id="name" name="name" type="text" placeholder="নাম">
                @if ($errors->has('name'))
                <small>সঠিকভাবে নাম দিন</small>
                @endif
            </div>
            <div class="input-area">
                <label for="email">ইমেইল</label>
                <input id="email" name="email" type="email" placeholder="ইমেইল">
                @if ($errors->has('email'))
                <small>সঠিকভাবে ইমেইল দিন</small>
                @endif
            </div>
            <div class="input-area">
                <label for="password">পাসওয়ার্ড</label>
                <input id="password" name="password" type="password" placeholder="পাসওয়ার্ড">
                <i class="show-pass far fa-eye"></i>
                @if ($errors->has('password'))
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
                <button id="add-btn" class="btn-primary btn" type="submit">ম্যানেজার যোগ করুন</button>
            </div>
        </form>
    </div>
</section>
@endsection