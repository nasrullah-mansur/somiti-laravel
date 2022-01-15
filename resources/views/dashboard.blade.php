@extends('layouts.front')


@section('content')
<section class="categories">
    <div class="container">
        <div class="title">
            <h2>নগদ গ্রহণ</h2>
        </div>
        <div class="items">
            <a href="{{ route('deposit.date') }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-1.png') }}" alt="img">
                    <h4>নগদ কালেকশন</h4>
                </div>
            </a>
            <a href="#">
                <div class="item">
                    <img src="{{ asset('front/images/icon-1.png') }}" alt="img">
                    <h4>ঋণ কালেকশন</h4>
                </div>
            </a>
            
        </div>
    </div>

    <div class="container">
        <div class="title">
            <h2>নগদ প্রদান</h2>
        </div>
        <div class="items">
            <a href="{{ route('withdraw.select.policy') }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-3.png') }}" alt="img">
                    <h4>নগদ প্রদান</h4>
                </div>
            </a>
            <a href="#">
                <div class="item">
                    <img src="{{ asset('front/images/icon-4.png') }}" alt="img">
                    <h4>ঋণ প্রদান</h4>
                </div>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="title">
            <h2>হিসাব অনুসন্ধান</h2>
        </div>
        <div class="items">
            <a href="{{ route('deposit.date') }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-1.png') }}" alt="img">
                    <h4>নগদ জমা অনুসন্ধান</h4>
                </div>
            </a>
            <a href="#">
                <div class="item">
                    <img src="{{ asset('front/images/icon-1.png') }}" alt="img">
                    <h4>ঋণ ব্যালেন্স অনুসন্ধান</h4>
                </div>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="title">
            <h2>সদস্যগণ</h2>
        </div>
        <div class="items">
            <a href="{{ route('holder.policy.select') }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-1.png') }}" alt="img">
                    <h4>একজন সদস্যের তথ্য</h4>
                </div>
            </a>
            <a href="{{ route('holder.index') }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-1.png') }}" alt="img">
                    <h4>সকল সদস্যের তথ্য</h4>
                </div>
            </a>
            <a href="{{ route('holder.create') }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-2.png') }}" alt="img">
                    <h4>নতুন সদস্য গ্রহণ</h4>
                </div>
            </a>
            <a href="#">
                <div class="item">
                    <img src="{{ asset('front/images/icon-3.png') }}" alt="img">
                    <h4>ঋণ একাউন্ট তৈরী</h4>
                </div>
            </a>
            <a href="#">
                <div class="item">
                    <img src="{{ asset('front/images/icon-4.png') }}" alt="img">
                    <h4>সকল ঋণ একাউন্ট</h4>
                </div>
            </a>
            <a href="{{ route('find.user.by.phone') }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-4.png') }}" alt="img">
                    <h4>সদস্য খুঁজুন</h4>
                </div>
            </a>
        </div>
    </div>
</section>
@endsection