@extends('layouts.front')

@section('content')
<section class="categories">
    <div class="container">
        <div class="items">
            <a href="{{ route('holder.policy.select') }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-5.png') }}" alt="img">
                    <h4>একজন সদস্য</h4>
                </div>
            </a>
            <a href="{{ route('holder.index') }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-6.png') }}" alt="img">
                    <h4>সকল সদস্য</h4>
                </div>
            </a>
            <a href="{{ route('holder.create') }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-7.png') }}" alt="img">
                    <h4>সদস্য গ্রহণ</h4>
                </div>
            </a>
            <a href="{{ route('find.user.by.phone') }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-8.png') }}" alt="img">
                    <h4>সদস্য খুঁজুন</h4>
                </div>
            </a>
        </div>
    </div>
</section>
@endsection