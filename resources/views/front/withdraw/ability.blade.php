@extends('layouts.front')

@section('content')
<section class="center add-money">
    <div class="container">
        <div class="profile">
            <img src="{{ asset($holder->photo ? $holder->photo : 'front/images/profile.jpg') }} " alt="img">
            <div class="title">
                <h1 class="m-0">{{ $holder->name }} <span>( {{ $holder->policy }} )</span></h1>
                <small>ভর্তির তারিখ - <span class="bn-text"> {{ \Carbon\Carbon::parse($holder->joining_date)->format('F j, Y') }} </span></small>
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
                    <td>
                      @if ($holder->balance < MIN_VALUE_FOR_WITHDRAW)
                      <span class="text-danger">{{ $holder->balance }} ( টাকা তোলার জন্য পর্যাপ্ত ব্যালেন্স নাই )</span>
                      @else
                      <span>{{ $holder->balance }}</span>
                      @endif
                    </td>
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
        @if ($holder->balance >= MIN_VALUE_FOR_WITHDRAW)
        <a href="{{ route('withdraw.create', $holder->id) }}" class="btn btn-primary">নগদ প্রদান করুন</a>
        @endif
    </div>
</section>
@endsection