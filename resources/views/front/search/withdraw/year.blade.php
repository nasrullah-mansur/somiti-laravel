@extends('layouts.front')

@section('content')
<section class="center add-money">
    <div class="container">
        <div class="profile">
            <div class="title">
                <h1 class="m-0">বাৎসরিক নগদ জমা হিসাবের তালিকা</h1>
                <h4 class="m-0 pt-2"><span class="bn-text">
                    বছরঃ                  
                  {{ $year }}  
                </h4>
                <br>
                <a href="#" class="btn btn-primary">পি ডি এফ ডাউনলোড</a>
                <br>
                <br>
            </div>
        </div>
        <div class="user-address">
            <h5 class="text-start mt-3">লেনদেনের বিবরণ</h5>
            <table class="table table-striped table-bordered custom-width data-table-set border">
                <thead>
                    <tr>
                      <th scope="col" style="width: 60px;">#</th>
                      <th scope="col" style="width: 80px;">পলিসি নং</th>
                      <th scope="col">নাম</th>
                      <th scope="col">মেট জমা</th>
                    </tr>
                  </thead>
                <tbody>
                    @forelse ($withdraws as $key => $withdraw)
                    <tr>
                      @php
                        $holder = DB::table('holders')->where('id', $key)->get();
                      @endphp
                        <td style="width: 60px;">{{ $loop->iteration }}</td>
                        <td style="width: 80px;">{{ $holder[0]->policy }}</td>
                        <td>{{ $holder[0]->name }}</td>
                        <td>{{ $withdraw->sum('amount') }}</td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="4">এ বসরের কোনো লেনদেন নেই</td>
                    </tr>
                    @endforelse
                  
                </tbody>
              </table>
        </div>

        <h4 class="text-start pt-2">এ বসরের মোট হিসাবঃ ‍<span class="text-primary">{{ isset($total) ? $total : '0' }}</span></h4>
        
    </div>
</section>
@endsection