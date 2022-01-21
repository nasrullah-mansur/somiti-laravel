@extends('layouts.front')

@section('content')
<section class="login">
    <div class="container">
        <h1>বছর নির্বাচন করুন</h1>
        <form method="POST" action="{{ route('search.select.year.store') }}">
            @csrf
           
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
                <button class="btn-primary btn" type="submit">বছর সিলেক্ট করুন</button>
            </div>
        </form>
    </div>
</section>
@endsection