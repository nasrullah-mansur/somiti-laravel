@extends('layouts.front')


@section('content')
<section class="categories">
    <div class="container">
        <div class="items">
            <a href="{{ route('collection.date') }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-1.png') }}" alt="img">
                    <h4>কালেকশন</h4>
                </div>
            </a>
            <a href="#">
                <div class="item">
                    <img src="{{ asset('front/images/icon-2.png') }}" alt="img">
                    <h4>হিসাব অনুসন্ধান</h4>
                </div>
            </a>
            <a href="#">
                <div class="item">
                    <img src="{{ asset('front/images/icon-3.png') }}" alt="img">
                    <h4>নগদ প্রদান</h4>
                </div>
            </a>
            <a href="{{ route('holder.type') }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-4.png') }}" alt="img">
                    <h4>সদস্যগণ</h4>
                </div>
            </a>
        </div>
    </div>
</section>
@endsection