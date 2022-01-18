@extends('layouts.front')

@section('content')
<section class="login">
    <div class="container">
        <h1>মাস নির্বাচন করুন</h1>
        <form method="POST" action="{{ route('search.select.month.store') }}">
            @csrf
            
            <div class="input-area">
                <label for="month">মাস</label>
                <select name="month" id="month" class="custom-select bn">

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
                        let thisMonth = (new Date()).getMonth();
                        function monthFn(value) {
                            if(value === (thisMonth + 1)) {
                                return `<option selected value="${value}">${months[value - 1]}</option>`;
                            } else {
                                return `<option value="${value}">${months[value - 1]}</option>`;
                            }
                        }

                        for(let monthI = 1; monthI <=12; monthI++) {
                            document.write( monthFn(monthI) );
                        }
                    </script>

                </select>
            </div>

            <div class="input-area">
                <label for="year">বছর</label>
                <select name="year" id="year" class="custom-select bn">
                    
                    <script>
                        let thisYear = (new Date()).getFullYear();
                        function thisYearFun(value) {
                            if(value === thisYear) {
                                return `<option selected value="${value}">${value}</option>`;
                            } else {
                                return `<option value="${value}">${value}</option>`;
                            }
                        }
                        for(let yearI = "{{ START_YEAR }}"; yearI <= thisYear; yearI++) {
                            document.write(thisYearFun(yearI))
                        }
                    </script>
                </select>
            </div>

            <div class="btn-area">
                <input type="text" name="page" value="{{ $route }}">
                <button class="btn-primary btn" type="submit">মাস সিলেক্ট করুন</button>
            </div>
        </form>
    </div>
</section>
@endsection