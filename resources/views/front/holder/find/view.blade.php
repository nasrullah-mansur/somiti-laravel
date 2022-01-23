@extends('layouts.front')

@section('content')
<section class="center add-money">
    <div class="container">
        <div class="profile">
            <img src="{{ asset($holder->photo ? $holder->photo : 'front/images/profile.jpg') }}" alt="img">
            <div class="title">
                <h1 class="m-0">{{ $holder->name }} ( <span>{{ $holder->policy }}</span> )</h1>
                
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
                  </script>
                    <h5 class="pb-3">
                      মাসঃ 
                      <script>document.write(months["{{ $month }}" - 1])</script>
                      - {{ $year }}
                    </h5>
                
            </div>
        </div>
        
        <div class="user-address">
            <h5 class="text-start mt-3">নগদ জমা বিবরণ</h5>
            <table class="table table-striped table-bordered custom-width">
              <thead>
                <tr>
                  <th scope="col">তারিখ</th>
                  <th scope="col">পরিমাণ</th>
                </tr>
              </thead>
                <tbody>
                  @forelse ($deposits as $deposit)
                  <tr>
                    <td>
                      {{ $deposit->day }}
                    </td>
                    <td>
                      {{ $deposit->amount }}
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="2">কোনো তথ্য পাওয়া যায়নি</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
              <h4>সর্বমোট নগদ জমাঃ {{ $deposits ? $deposits->sum('amount') : '0'}}</h4>
        </div>
        
        <div class="user-address pt-4">
            <h5 class="text-start mt-3">কিস্তি জমা বিবরণ</h5>
            <table class="table table-striped table-bordered custom-width">
              <thead>
                <tr>
                  <th scope="col">তারিখ</th>
                  <th scope="col">পরিমাণ</th>
                </tr>
              </thead>
                <tbody>
                  @forelse ($installments as $installment)
                  <tr>
                    <td>{{ $installment->day }}</td>
                    <td>{{ $installment->amount }}</td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="2">কোনো তথ্য পাওয়া যায়নি</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>

              <h4>সর্বমোট কিস্তি জমাঃ {{ $installments ? $installments->sum('amount') : '0' }}</h4>
        </div>

    </div>
</section>
@endsection