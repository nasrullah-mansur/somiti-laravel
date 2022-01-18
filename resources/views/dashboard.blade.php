@extends('layouts.front')


@section('content')
<section class="categories">
    <div class="container">
        <div class="title">
            <h2>নগদ গ্রহণ</h2>
        </div>
        <div class="items">
            <a href="{{ route('date.select', 'deposit') }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-1.png') }}" alt="img">
                    <h4>নগদ কালেকশন</h4>
                </div>
            </a>
            <a href="{{ route('date.select', 'installment') }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-1.png') }}" alt="img">
                    <h4>কিস্তি কালেকশন</h4>
                </div>
            </a>
            
        </div>
    </div>

    <div class="container">
        <div class="title">
            <h2>নগদ প্রদান</h2>
        </div>
        <div class="items">
            <a href="{{ route('date.select', 'withdraw') }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-3.png') }}" alt="img">
                    <h4>নগদ প্রদান</h4>
                </div>
            </a>
            <a href="{{ route('date.select', 'loan') }}">
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
            <a href="{{ route('search.selection', 'deposit') }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-1.png') }}" alt="img">
                    <h4>নগদ কালেকশন অনুসন্ধান</h4>
                </div>
            </a>
            <a href="{{ route('search.selection', 'withdraw') }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-1.png') }}" alt="img">
                    <h4>নগদ প্রদান অনুসন্ধান</h4>
                </div>
            </a>
            <a href="{{ route('search.selection', 'loan') }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-1.png') }}" alt="img">
                    <h4>ঋণ প্রদান অনুসন্ধান</h4>
                </div>
            </a>
            <a href="{{ route('search.selection', 'installment') }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-1.png') }}" alt="img">
                    <h4>কিস্তি কালেকশন অনুসন্ধান</h4>
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
            <a href="{{ route('loan.account.create') }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-3.png') }}" alt="img">
                    <h4>ঋণ একাউন্ট তৈরী</h4>
                </div>
            </a>
            <a href="{{ route('loan.index') }}">
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