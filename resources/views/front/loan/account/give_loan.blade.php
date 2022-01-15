@extends('layouts.front')

@section('content')
<section class="center add-money">
    <div class="container">
        <div class="profile">
            <img src="{{ asset($holder->photo ? $holder->photo : 'front/images/profile.jpg') }} " alt="img">
            <div class="title">
                <h1 class="m-0">{{ $holder->name }}</h1>
                <small>ভর্তির তারিখ - <span class="bn-text">12-12-2020</span></small>
            </div>
            <div class="summery">
                <div>
                    <h4>{{ $holder->policy }}</h4>
                    <small>পলিসি নং</small>
                </div>
                <div>
                    <h4 class="bn-text {{ $holder->balance > 0 ? 'text-primary' : 'text-danger' }} ">{{ $holder->balance }}</h4>
                    <small>ব্যালেন্স</small>
                </div>
            </div>
        </div>
        <div class="form">
            <h2 class="text-start">ঋণের পরিমাণ যোগ করুন </h2>
            <form method="POST" action="{{ route('loan.give.store') }}">
                @csrf
                <div class="input-area">
                    <input id="name" type="number" name="number" placeholder="পরিমাণ দিন">
                    @if ($errors->has('number'))
                    <small>{{ $errors->first('number') }}</small>
                    @endif
                </div>
                <div class="input-area">
                    <input type="number" name="re_number" placeholder="পুনরায় পরিমাণ ‍দিন">
                    @if ($errors->has('re_number'))
                    <small>{{ $errors->first('re_number') }}</small>
                    @endif
                </div>
                <div class="join-date">
                    <h5 class="text-start">প্রদানের তারিখ</h5>
                    <div class="selections d-flex">
                        <div class="input-area w-100 me-2">
                            <label for="day">তারিখ</label>
                            <select id="day" name="day" class="custom-select bn">
                                <script>
                                    let todayDate = (new Date()).getDate();
                                    function dayFn(value) {
                                        if(value === todayDate) {
                                            return `<option selected value="${value}">${value}</option>`;
                                        } else {
                                            return `<option value="${value}">${value}</option>`;
                                        }
                                    }
                                    for(let dayI = 1; dayI <= 31; dayI++) {
                                        document.write( dayFn(dayI) )
                                    }
                                </script>
                            </select>
                        </div>
        
                        <div class="input-area w-100 me-2">
                            <label for="month">মাস</label>
                            <select name="month" id="month" class="custom-select bn">
        
                                <script>
                                    let months = [
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
                                    let thisMonth = (new Date()).getMonth();
                                    function monthFn(value) {
                                        if(value === (thisMonth + 1)) {
                                            return `<option selected value="${value}">${months[value - 1]}</option>`;
                                        } else {
                                            return `<option value="${value}">${months[value - 1]}</option>`;
                                        }
                                    }
        
                                    for(let monthI = 1; monthI <=12; monthI++) {
                                        document.write( monthFn(monthI) );
                                    }
                                </script>
        
                            </select>
                        </div>
        
                        <div class="input-area w-100">
                            <label for="year">বছর</label>
                            <select id="year" name="year" class="custom-select bn">
                                
                                <script>
                                    let thisYear = (new Date()).getFullYear();
                                    function thisYearFun(value) {
                                        if(value === thisYear) {
                                            return `<option selected value="${value}">${value}</option>`;
                                        } else {
                                            return `<option value="${value}">${value}</option>`;
                                        }
                                    }
                                    for(let yearI = (thisYear - 20); yearI <= thisYear; yearI++) {
                                        document.write(thisYearFun(yearI))
                                    }
                                </script>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="input-area">
                <label for="balance">দৈনিক আদায়ের পরিমাণ</label>
                <input id="balance" name="daily_pay" type="number" placeholder="দৈনিক আদায়ের পরিমাণ">
                @if ($errors->has('daily_pay'))
                <small>{{ $errors->first('daily_pay') }}</small>
                @endif
            </div>
                <div class="btn-area text-start">
                    <input type="text" name="holder_id" value="{{ $holder->id }}">
                    <button class="btn-primary btn" type="submit">নগদ প্রদান করুন</button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection