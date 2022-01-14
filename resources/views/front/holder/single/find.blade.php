@extends('layouts.front')

@section('content')
<section class="center add-money">
    <div class="container">
        <div class="profile">
            <div class="title">
                <h1 class="m-0 pb-5">সদস্যকে খুঁজুন</h1>
            </div>
        </div>
        <div class="form">
            <form method="POST" action="{{ route('holder.show.policy') }}">
                @csrf
                <div class="input-area">
                    <input id="name" type="text" name="phone" placeholder="সদস্যের মোবাইল নং">
                    @if($errors->any())
                    <small>কোনো সদস্যকে খুঁজে পাওয়া যায়নি</small>
                    @endif
                </div>
                
                <div class="btn-area text-start">
                    <button class="btn-primary btn" type="submit">সদস্যকে খুঁজুন</button>
                    <input type="hidden" name="for" value="phone">
                </div>
            </form>
        </div>
    </div>
</section>
@endsection