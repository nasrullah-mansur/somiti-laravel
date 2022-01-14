@extends('layouts.front')

@section('content')
<section class="center add-money">
    <div class="container">
        <div class="profile">
            <img src="{{ asset($holder->photo ? $holder->photo : 'front/images/profile.jpg') }}" alt="img">
            <div class="title">
                <h1 class="m-0">{{ $holder->name }}</h1>
                <small>ভর্তির তারিখ - <span class="bn-text">{{ \Carbon\Carbon::parse($holder->joining_date)->format('F j, Y') }}</span></small>
            </div>
            <div class="summery">
                <div>
                    <h4>{{ $holder->policy }}</h4>
                    <small>পলিসি নং</small>
                </div>
                <div>
                    <h4 class="bn-text {{ $holder->balance > 0 ? 'text-primary' : 'text-danger' }} text-primary">{{ $holder->balance }}</h4>
                    <small>ব্যালেন্স</small>
                </div>
            </div>
        </div>
        <div class="form">

            <script>
                let today_months = [
                            'জানুয়ারী',
                            'ফেব্রুয়ারী',
                            'মার্চ',
                            'এপ্রিল',
                            'মে',
                            'জুন',
                            'জুলাই',
                            'আগস্ট',
                            'সেপ্টেম্বর',
                            'অক্টবর',
                            'নভেম্বর',
                            'ডিসেম্বর',
                        ]
            </script>
            
            <h2 class="text-start">নগদ জমা ‍<span class="bn-text">- {{ Session::get('today_day') }} <script>document.write(today_months[{{ Session::get('today_month') }}])</script> {{ Session::get('today_year') }}</span></h2>
            <form method="POST" action="{{ route('collection.money.store', $holder->id) }}">
                @csrf
                <div class="input-area">
                    <input name="number" id="name" type="number" placeholder="টাকার পরিমাণ" value="{{ $money ? $money->amount : '' }}">
                    @if($errors->any())
                    <small>টাকার পরিমাণ সঠিক ভাবে দিন</small>
                    @endif
                </div>
                <div class="input-area">
                    <input name="con_number" type="number" placeholder="পুনরায় টাকার পরিমাণ" value="{{ $money ? $money->amount : '' }}">
                </div>
                <div class="btn-area text-start">
                    <button class="btn-primary btn" type="submit">টাকা জমা করুন</button>
                    <input type="hidden" name="exist" value="{{ $money ? 'yes' : 'no' }}">
                    <input type="hidden" name="prev" value="{{ $money ? $money->amount : '0' }}">
                </div>
            </form>
        </div>
    </div>
</section>
@endsection