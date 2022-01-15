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
            <form >
                <div class="input-area">
                    <input id="name" type="number" placeholder="ঋণের পরিমাণ">
                    <small>ঋণের পরিমাণ সঠিক ভাবে দিন</small>
                </div>
                <div class="input-area">
                    <input type="number" placeholder="পুনরায় ঋণের পরিমাণ">
                </div>
                <div class="btn-area text-start">
                    <button class="btn-primary btn" type="submit">ঋণ প্রদান করুন</button>
                </div>
            </form>
        </div>
    </div>
</section>

<div class="modal fade" id="add-money-status" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        
        <div class="modal-body">
          <div class="text-center">
              <h3>ঋণ প্রদান 
                সম্পন্য হয়েছে</h3>

            </div>
        </div>
        <div class="modal-footer">
            <div class="text-center">
                <a href="#" class="btn btn-primary">ঠিক আছে</a>

            </div>
        </div>
      </div>
    </div>
  </div>
@endsection