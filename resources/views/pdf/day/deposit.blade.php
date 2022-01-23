<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDF Download</title>
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/pdf.css') }}">
    
</head>

<body>

    <div class="col-lg-6 m-auto py-5">
        <div id="pdf" class="p-5">
            <div class="title">
                <h2>দৈনিক নগদ কালেকশনের তালিকা</h2>
                <h4>
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
                                ];
    
                                let currentMonth = months["{{ $month }}" - 1];
                      </script>
                        <script>document.write(currentMonth)</script>
                      {{ $day }}  
                      {{ $year }} 
                </h4>
            </div>
            <table class="table table-striped table-bordered custom-width data-table-set border">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">পলিসি নং</th>
                      <th scope="col">নাম</th>
                      <th scope="col">পরিমাণ</th>
                    </tr>
                  </thead>
                <tbody>
                    @foreach ($deposits as $deposit)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $deposit->holder->policy }}</td>
                        <td>{{ $deposit->holder->name }}</td>
                        <td>{{ $deposit->amount }}</td>
                    </tr>
                    
                    @endforeach
                  
                </tbody>
            </table>
            <div class="total">
                <h4>আজকের মোট হিসাবঃ {{ $total }}</h4>
            </div>
        </div>
    </div>


    <script src="{{ asset('front/js/jquery.2.2.4.min.js') }}"></script>
    <script src="{{ asset('front/js/html2pdf.js') }}"></script>
    <script>
        let pdfName = 'নগদ-কালেকশন-' + "{{ $day }}-" + "{{ $month }}-" + "{{ $year }}"; 
        $(document).ready(function() {
            var element = document.getElementById('pdf');
            var opt = {
                    margin:       [0.4728,0],
                    filename:     pdfName,
                    image:        { type: 'jpeg', quality: 0.98 },
                    html2canvas:  { scale: 4 },
                    jsPDF:        { unit: 'in', format: 'A4', orientation: 'portrait' }
                };
            html2pdf().set(opt).from(element).save();
        })

    </script>
</body>

</html>