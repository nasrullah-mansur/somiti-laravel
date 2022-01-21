@extends('layouts.front')

@section('content')
<section class="center add-money">
    <div class="container">
        <div class="profile">
            <img src="{{ asset($holder->photo ? $holder->photo : 'front/images/profile.jpg') }}" alt="img">
            <div class="title">
                <h1 class="m-0">{{ $holder->name }} ( <span>{{ $holder->policy }}</span> )</h1>
                <small>ভর্তির তারিখ - <span class="bn-text">
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
                            ];

                            let currentMonth = months["{{ \Carbon\Carbon::parse($holder->joining_date)->format('m') }}" - 1];
                  </script>
                    <script>document.write(currentMonth)</script>
                  {{ \Carbon\Carbon::parse($holder->joining_date)->format('d') }}  
                  {{ \Carbon\Carbon::parse($holder->joining_date)->format('Y') }}  
                </small>
            </div>
        </div>
        <div class="user-address">
            <h5 class="text-start mt-3">সদস্যের ঠিকানা</h5>
            <table class="table table-striped table-bordered custom-width">
                <tbody>
                  <tr>
                    <td>ঠিকানা</td>
                    <td>{{ $holder->address }}</td>
                  </tr>
                  <tr>
                    <td>মোবাইল নং</td>
                    <td>{{ $holder->phone }}</td>
                  </tr>
                  <tr>
                    <td>ব্যলেন্স</td>
                    <td>{{ $holder->balance }}</td>
                  </tr>
                  
                </tbody>
              </table>
        </div>
        <div class="user-address">
            <h5 class="text-start mt-3">ঋণের বিবরণ</h5>
            <table class="table table-striped table-bordered text-start">
                <tbody>
                  <tr>
                    <td>গ্রাহকের একটিভ ঋণ</td>
                    <td>{{ $active_loan ? $active_loan->amount : DEFAULT_BLANK_DATA }}</td>
                  </tr>
                  <tr>
                    <td>গ্রাহকের বাকি কিস্তির পরিমাণ</td>
                    <td>{{ $active_loan ? $active_loan->due : DEFAULT_BLANK_DATA }}</td>
                  </tr>
                  <tr>
                    <td>গ্রাহকের সর্বমোট গৃহীত ঋণ</td>
                    <td>{{ $all_loan ? $all_loan->sum('amount') :  DEFAULT_BLANK_DATA}}</td>
                  </tr>
                </tbody>
              </table>

              <a class="btn btn-primary" href="{{ route('holder.find.data.select.month', $holder->id) }}">মাসিক ডাটা চেক করুন</a>
        </div>
    </div>
</section>
@endsection