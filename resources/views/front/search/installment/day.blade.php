@extends('layouts.front')

@section('content')
<section class="center add-money">
    <div class="container">
        <div class="profile">
            <div class="title">
                <h1 class="m-0">দৈনিক কিস্তি কালেকশনের তালিকা</h1>
                <small>তারিখ - <span class="bn-text">
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

                            let currentMonth = months["{{ $month }}" - 1];
                  </script>
                    <script>document.write(currentMonth)</script>
                  {{ $day }}  
                  {{ $year }}  
                </small>
                <br>
                <br>
                <a href="#" class="btn btn-primary">পি ডি এফ ডাউনলোড</a>
                <br>
                <br>
            </div>
        </div>
        <div class="user-address">
            <h5 class="text-start mt-3">লেনদেনের বিবরণ</h5>
            <table class="table table-striped table-bordered custom-width">
                <thead>
                    <tr>
                      <th scope="col" style="width: 60px;">#</th>
                      <th scope="col" style="width: 80px;">পলিসি নং</th>
                      <th scope="col">নাম</th>
                      <th scope="col">কিস্তি</th>
                      <th scope="col">ঋণ</th>
                      <th scope="col">বাকি</th>
                    </tr>
                  </thead>
                <tbody>
                    @foreach ($installments as $installment)
                    <tr>
                        <td style="width: 60px;">{{ $loop->iteration }}</td>
                        <td style="width: 80px;">{{ $installment->holder->policy }}</td>
                        <td>{{ $installment->holder->name }}</td>
                        <td>{{ $installment->amount }}</td>
                        <td>{{ $installment->loan->amount }}</td>
                        <td>{{ $installment->loan->due }}</td>
                    </tr>
                    @endforeach
                  
                </tbody>
              </table>
        </div>

        <h4 class="text-start pt-2">আজকের মোট হিসাবঃ ‍<span class="text-primary">{{ isset($total) ? $total : '0' }}</span></h4>
        
    </div>
</section>
@endsection