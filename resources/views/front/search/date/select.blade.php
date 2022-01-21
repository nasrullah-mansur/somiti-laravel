@extends('layouts.front')

@section('content')
<section class="categories">
    <div class="container">
        <div class="title">
            <h2>নগদ গ্রহণ</h2>
        </div>
        <div class="items">
            <a href="{{ route('search.select.day', $route) }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-1.png') }}" alt="img">
                    <h4>দৈনিক</h4>
                </div>
            </a>
            <a href="{{ route('search.select.month', $route) }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-1.png') }}" alt="img">
                    <h4>মাসিক</h4>
                </div>
            </a>
            <a href="{{ route('search.select.year', $route) }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-1.png') }}" alt="img">
                    <h4>বাৎসরিক</h4>
                </div>
            </a>
            <a href="{{ route('search.select.total', $route) }}">
                <div class="item">
                    <img src="{{ asset('front/images/icon-1.png') }}" alt="img">
                    <h4>সকল</h4>
                </div>
            </a>
            
        </div>
    </div>
</section>
@endsection