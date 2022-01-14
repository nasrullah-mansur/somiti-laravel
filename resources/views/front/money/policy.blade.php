@extends('layouts.front')

@section('content')

<section class="center">
    <div class="container">
        <div class="today py-2 px-5 mb-3 border d-inline-block">
            <h2>কালেকশনের তারিখ</h2>
            <p class="bn-text m-0">{{ Session::get('today_day') }}-{{ Session::get('today_month') }}-{{ Session::get('today_year') }}</p>
        </div>

        <div class="today py-2 px-5 mb-5 d-inline-block">
            <h2>সদস্যের পলিসি নং নির্বাচন করুন</h2>
        </div>

        <h4 class="text-start">পলিসি নং</h4>
        <form method="POST" action="{{ route('collection.policy.select.get') }}">
            @csrf
            <div class="input-area">
                <select id="day" name="policy" class="custom-select">
                    @foreach ($policies as $policy)
                    <option value="{{ $policy->policy }}">{{ $policy->policy }}</option> 
                    @endforeach
                </select>
            </div>

            <div class="btn-area">
                <button class="btn-primary btn" type="submit">এগিয়ে যান</button>
            </div>
        </form>
    </div>
</section>

@endsection