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
            <h2 class="text-start">নগদ প্রদানের পরিমাণ যোগ করুন </h2>
            <form method="POST" action="{{ route('withdraw.store', $holder->id) }}">
                @csrf
                <div class="input-area">
                    <input id="name" type="number" name="number" placeholder="পরিমাণ দিন" value="{{ $exist ? $exist->amount : '' }}">
                    @if ($errors->any())
                    <small>নগদ প্রদানের পরিমাণ সঠিক ভাবে দিন</small>
                    @endif
                </div>
                <div class="input-area">
                    <input type="number" name="re_number" placeholder="পুনরায় পরিমাণ ‍দিন" value="{{ $exist ? $exist->amount : '' }}">
                </div>
                
                <div class="btn-area text-start">

                    @if ($exist)
                        <p>আজকের নগদ আদায় সম্পন্য হয়েছে <a href="javascript:void(0);" id="edit-btn">এডিট করুন</a></p>
                        <input type="text" name="old_value" value="{{ $exist->amount }}">
                        @endif
                        
                        <div id="submit-area" class="{{ $exist ? 'd-none' : '' }}">
                        <button class="btn-primary btn" type="submit">নগদ প্রদান করুন</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
    
</section>

@endsection

@section('custom_js')
<script>
    let editBtn = document.getElementById('edit-btn');
    let sumbitArea = document.getElementById('submit-area');

    editBtn.addEventListener('click', function() {
        sumbitArea.classList.remove('d-none');
    })
</script>
@endsection