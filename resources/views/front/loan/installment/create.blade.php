@extends('layouts.front')

@section('content')
<section class="center add-money">
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
    <div class="container">
        <div class="profile">
            <img src="{{ asset($holder->photo ? $holder->photo : 'front/images/profile.jpg') }}" alt="img">
            <div class="title">
                <h1 class="m-0">{{ $holder->name }} <span>( {{ $holder->policy }} )</span></h1>
                <small>ভর্তির তারিখ - <span class="bn-text">{{ \Carbon\Carbon::parse($holder->joining_date)->format('F j, Y') }}</span></small>
            </div>
            <div class="summery flex-wrap">
                <div class="w-50 border-bottom">
                    <h4 style="font-size: 18px;"><script>document.write(today_months[{{ $loan->month }} - 1])</script> {{ $loan->day }} {{ $loan->year }}</h4>
                    <small>ঋণ প্রদানের তারিখ</small>
                </div>
                <div class="w-50 border-bottom">
                    <h4 class="bn-text {{ $holder->balance > 0 ? 'text-primary' : 'text-danger' }} text-primary">{{ $holder->balance }}</h4>
                    <small>ব্যালেন্স</small>
                </div>
                <div class="w-50 border-end">
                    <h4 class="bn-text">{{ $loan->amount }}</h4>
                    <small>প্রদত্ত ঋণ</small>
                </div>
                <div class="w-50">
                    <h4 class="bn-text">{{ $loan->due }}</h4>
                    <small>ঋণ বাকি</small>
                </div>
            </div>
        </div>
        <div class="form">

            
            
            <h2 class="text-start">কিস্তি জমা ‍<span class="bn-text">- {{ Session::get('today_day') }} <script>document.write(today_months[{{ Session::get('today_month') }}])</script> {{ Session::get('today_year') }}</span></h2>
            <form method="POST" action="{{ route('ins.store') }}">
                @csrf
                @if ($exist)
                <div class="input-area">
                    <input name="number" id="name" type="number" placeholder="টাকার পরিমাণ" value="{{ $exist->amount  }}">
                    @if($errors->any())
                    <small>টাকার পরিমাণ সঠিক ভাবে দিন</small>
                    @endif
                </div>
                <div class="input-area">
                    <input name="con_number" type="number" placeholder="পুনরায় টাকার পরিমাণ" value="{{ $exist->amount }}">
                </div>

                @else
                <div class="input-area">
                    <input name="number" id="name" type="number" placeholder="টাকার পরিমাণ" value="{{ $loan->daily_pay < $loan->due ? $loan->daily_pay : $loan->due  }}">
                    @if($errors->any())
                    <small>টাকার পরিমাণ সঠিক ভাবে দিন</small>
                    @endif
                </div>
                <div class="input-area">
                    <input name="con_number" type="number" placeholder="পুনরায় টাকার পরিমাণ" value="{{ $loan->daily_pay < $loan->due ? $loan->daily_pay : $loan->due }}">
                </div>                    
                @endif
                <div class="btn-area text-start">
                    @if ($exist)
                        <p class="m-2">আজকের কিস্তি আদায় সম্পন্য হয়েছে <a href="javascript:void(0);" id="edit-btn">এডিট করুন</a></p>                
                    @endif

                    <div id="submit-area" class="submit-area {{ $exist ? 'd-none' : '' }}">
                        <button class="btn-primary btn" type="submit">কিস্তি {{ $exist ? 'এডিট' : 'জমা' }}  করুন</button>
                        <input type="text" name="holder_id" value="{{ $holder->id }}">
                        @if ($exist)
                            <input type="text" name="old_amount" value="{{ $exist->amount }}">
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@section('custom_js')
<script>
    let editBtn = document.getElementById('edit-btn');
    let sumbitArea = document.getElementById('submit-area');

    editBtn.addEventListener('click', function() {
        sumbitArea.classList.remove('d-none');
    })
</script>
@endsection