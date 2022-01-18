@extends('layouts.front')

@section('content')
<section class="center">
    <div class="container">
        <div class="today py-2 px-5 mb-5 d-inline-block">
            <h2>সদস্যের পলিসি নং নির্বাচন করুন</h2>
        </div>

        <h4 class="text-start">পলিসি নং</h4>
        <form method="POST" action="{{ route('loan.account.store') }}">
            @csrf
            <div class="input-area">
                <select id="day" name="policy" class="custom-select">
                    @foreach ($policies as $policy)
                    <option value="{{ $policy->policy }}">{{ $policy->policy }}</option> 
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