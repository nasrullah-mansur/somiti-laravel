@extends('layouts.front')

@section('content')
<section class="center">
    <div class="container">
        <div class="today py-2 px-5 mb-3 border d-inline-block">
            <h2>কিস্তি আদায়ের তারিখ</h2>
            <script>
                let months = [
                        'জানুয়ারী',
                        'ফেব্রুয়ারী',
                        'মার্চ',
                        'এপ্রিল',
                        'মে',
                        'জুন',
                        'জুলাই',
                        'আগস্ট',
                        'সেপ্টেম্বর',
                        'অক্টবর',
                        'নভেম্বর',
                        'ডিসেম্বর',
                    ]
            </script>
            <p class="bn-text m-0"><script>document.write(months[{{ Session::get('today_month') }}])</script>-{{ Session::get('today_day') }}-{{ Session::get('today_year') }}</p>
        </div>

        <div class="today py-2 px-5 mb-5 d-inline-block">
            <h2>সদস্যের পলিসি নং নির্বাচন করুন</h2>
        </div>

        <h4 class="text-start">পলিসি নং</h4>
        <form method="POST" action="{{ route('ins.select.policy.store') }}">
            @csrf
            <div class="input-area">
                <select id="day" name="policy" class="custom-select">
                    @foreach ($policies as $policy)
                    @foreach ($policy->loan as $single_policy)
                        @if ($single_policy->due && $single_policy->due > 0)
                        <option value="{{ $policy->policy }}">{{ $policy->policy }}</option> 
                        @endif
                    @endforeach
                    @endforeach
                </select>
            </div>

            <div class="btn-area">
                <button class="btn-primary btn" type="submit">পলিসি সিলেক্ট করুন</button>
            </div>
        </form>
    </div>
</section>

@endsection