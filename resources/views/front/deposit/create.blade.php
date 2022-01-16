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
            <form method="POST" action="{{ route('deposit.money.store', $holder->id) }}">
                @csrf
                <div class="input-area">
                    <input name="number" id="name" type="number" placeholder="টাকার পরিমাণ" value="{{ $deposit ? $deposit->amount : '' }}">
                    @if($errors->any())
                    <small>টাকার পরিমাণ সঠিক ভাবে দিন</small>
                    @endif
                </div>
                <div class="input-area">
                    <input name="con_number" type="number" placeholder="পুনরায় টাকার পরিমাণ" value="{{ $deposit ? $deposit->amount : '' }}">
                </div>
                <div class="btn-area text-start">
                    @if ($deposit)
                        <p class="mb-2">আজকের নগদ আদায় সম্পন্য হয়েছে ‍<a href="javascript:void(0);" id="edit-btn">এডিট করুন</a></p>
                    @endif

                    <div class="{{ $deposit ? 'd-none' : '' }}" id="submit-area">
                        <button class="btn-primary btn" type="submit">টাকা {{ $deposit ? 'এডিট' : 'জমা' }} করুন</button>
                        <input type="hidden" name="exist" value="{{ $deposit ? 'yes' : 'no' }}">
                        <input type="hidden" name="prev" value="{{ $deposit ? $deposit->amount : '0' }}">
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