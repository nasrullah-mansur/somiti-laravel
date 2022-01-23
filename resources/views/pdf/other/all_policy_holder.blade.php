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
                <h2>সকল সদস্যগণের নামের তালিকা</h2>
            </div>
            <table class="table table-striped table-bordered custom-width data-table-set border">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">পলিসি নং</th>
                      <th scope="col">নাম</th>
                      <th scope="col">ঠিকানা</th>
                      <th scope="col">মোবাইল নং</th>
                    </tr>
                  </thead>
                <tbody>
                    @foreach ($holders as $holder)
                    <tr>
                        <td style="width: 60px;">{{ $loop->iteration }}</td>
                        <td>{{ $holder->policy }}</td>
                        <td>{{ $holder->name }}</td>
                        <td>{{ $holder->address }}</td>
                        <td>{{ $holder->phone }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>


    <script src="{{ asset('front/js/jquery.2.2.4.min.js') }}"></script>
    <script src="{{ asset('front/js/html2pdf.js') }}"></script>
    <script>
        let pdfName = 'সকল-সদস্য'; 
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