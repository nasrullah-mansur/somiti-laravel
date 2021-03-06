@extends('layouts.front')

@section('content')
<section class="center add-money">
    <div class="container">
        <div class="profile">
            <div class="title">
                <h1 class="m-0">দৈনিক নগদ প্রদানের তালিকা</h1>
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
                <a href="{{ route('pdf.by.day', ['withdraw', $day, $month, $year]) }}" target="_blank" class="btn btn-primary">পি ডি এফ ডাউনলোড</a>
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
                      <th scope="col">উত্তলন</th>
                      <th scope="col">ব্যালেন্স</th>
                    </tr>
                  </thead>
                <tbody>
                    @foreach ($withdraws as $withdraw)
                    <tr>
                        <td style="width: 60px;">{{ $loop->iteration }}</td>
                        <td style="width: 80px;">{{ $withdraw->holder->policy }}</td>
                        <td>{{ $withdraw->holder->name }}</td>
                        <td>{{ $withdraw->amount }}</td>
                        <td>{{ $withdraw->holder->balance }}</td>
                    </tr>
                    @endforeach
                  
                </tbody>
              </table>
        </div>

        <h4 class="text-start pt-2">আজকের মোট হিসাবঃ ‍<span class="text-primary">{{ isset($total) ? $total : '0' }}</span></h4>
        
    </div>
</section>
@endsection