@extends('layouts.front')

@section('content')
<section class="center add-money">
    <div class="container">
        <div class="profile">
            <img src="{{ asset($holder->photo ? $holder->photo : 'front/images/profile.jpg') }}" alt="img">
            <div class="title">
                <h1 class="m-0">{{ $holder->name }} <span>( {{ $holder->policy }} )</span></h1>
                <small>ভর্তির তারিখ - <span class="bn-text">12-12-2020</span></small>
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
                    <td>{{ $holder->balance ? $holder->balance : '0' }}</td>
                  </tr>
                  
                  <tr>
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
                    </script>
                    <td>ঋণ গ্রহনের তারিখ</td>
                    <td>
                      @if (!$loan->day && !$loan->month && !$loan->year)
                      <span>প্রযজ্য নয়</span>
                      @else
                      <script>document.write(months[{{ $loan->month }} - 1])</script> {{ $loan->day }} {{ $loan->year }}
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>একটিভ ঋণ</td>
                    <td>{{ $loan->amount ? $loan->amount : '0' }}</td>
                  </tr>
                  <tr>
                    <td>ঋণ বাকি</td>
                    <td>{{ $loan->due ? $loan->due : '0' }}</td>
                  </tr>
                  <tr>
                    <td>দৈনিক আদায়</td>
                    <td>{{ $loan->daily_pay ? $loan->daily_pay : '0' }}</td>
                  </tr>
                  
                </tbody>
              </table>
        </div>
        <div class="user-address">
            <h5 class="text-start mt-3">লেনদেন বিবরণ</h5>
            <table class="table table-striped table-bordered custom-width">
                <tbody>
                  <tr>
                    <td>গড় দৈনিক জমা</td>
                    <td>১১-মিরপুর ঢাকা</td>
                  </tr>
                  <tr>
                    <td>সর্বচ্য দৈনিক জমা</td>
                    <td>০৮-১২-১৯৯৫</td>
                  </tr>
                  <tr>
                    <td>সর্বনিম্ন দৈনিক জমা</td>
                    <td>০১৭২৮৬১৯৭৩৩</td>
                  </tr>
                  <tr>
                    <td>সর্বশেষ গৃহীত ঋণ</td>
                    <td>০১৭২৮৬১৯৭৩৩</td>
                  </tr>
                  <tr>
                    <td>সর্বমোট গৃহীত ঋণ</td>
                    <td>০১৭২৮৬১৯৭৩৩</td>
                  </tr>
                  
                </tbody>
              </table>
        </div>
        @if ($loan->due > 0) 
          <p class="m-0">সদস্য নতুন ঋণ পাবার উপযুক্ত নয় </p>
          <a href="{{ route('loan.give', $holder->id) }}">সংশধন করুন</a>
        @else
        <a href="{{ route('loan.give', $holder->id) }}" class="btn btn-primary">ঋণের পরিমাণ যোগ করুন</a>
        @endif 
    </div>
</section>
@endsection