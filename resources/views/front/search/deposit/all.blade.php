@extends('layouts.front')

@section('content')
<section class="center add-money">
    <div class="container">
        <div class="profile">
            <div class="title">
                <h1 class="m-0">বাৎসরিক নগদ জমা হিসাবের তালিকা</h1>
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
                    @foreach ($deposits as $key => $deposit)
                    <tr>
                      @php
                        $holder = DB::table('holders')->where('id', $key)->get();
                      @endphp
                        <td style="width: 60px;">{{ $loop->iteration }}</td>
                        <td style="width: 80px;">{{ $holder[0]->policy }}</td>
                        <td>{{ $holder[0]->name }}</td>
                        <td>{{ $deposit->sum('amount') }}</td>
                    </tr>
                    @endforeach
                  
                </tbody>
              </table>
        </div>
        
    </div>
</section>
@endsection