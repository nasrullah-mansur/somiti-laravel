<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>প্রগতি ক্ষুদ্র ব্যবসায়ী সমবায় সমিতি লিঃ</title>

    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/all.min.css') }}">
    <link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">

    <link rel="icon" href="favicon.ico" type="{{ asset('front/images/favicon.png') }}" />
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
</head>
<body>

    <!-- Log in start -->
    <section class="login">
        <div class="container">
            <h1>লগ ইন করুন</h1>
            <form  method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-area">
                    <label for="name">ইমেইল</label>
                    <input id="name" name="email" type="text" placeholder="ইমেইল">
                    @if ($errors->any())
                    <small>ইমেইল অথবা পাসওয়ার্ড ভুল আছে</small>
                    @endif
                </div>
                <div class="input-area">
                    <label for="password">পাসওয়ার্ড</label>
                    <input id="password" type="password" name="password" placeholder="পাসওয়ার্ড">
                    <i class="show-pass far fa-eye"></i>
                </div>
                
                <div class="btn-area text-start">
                    <button class="btn-primary btn" type="submit">লগ ইন করুন</button>
                </div>
            </form>
        </div>
    </section>
    <!-- Log in end -->

</body>
</html>