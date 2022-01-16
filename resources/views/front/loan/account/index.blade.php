@extends('layouts.front')

@section('content')
<section class="all-users">
    <div class="container">
        <div class="text-center pb-3">
            <h1 class="pb-3">ঋণ গ্রাহকদের বিবরণ</h1>
            <a href="#" class="btn btn-primary">পি ডি এফ ডাউনলোড</a>
        </div>
        <div class="user-address pt-3">
            <div class="table-responsive">
                <table class="table table-striped table-bordered yajra-datatable bg-white w-100">
                    <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">পলিসি নং</th>
                          <th scope="col">ছবি</th>
                          <th scope="col">নাম</th>
                          <th scope="col">ঋণ গ্রহনের তারিখ</th>
                          <th scope="col">ঋণের পরিমাণ</th>
                          <th scope="col">আদায়</th>
                          <th scope="col">পাওনা</th>
                          <th scope="col">ব্যালেন্স</th>
                          <th scope="col">অবস্থা</th>
                          <th scope="col">একসন</th>
                            
                        </tr>
                      </thead>
                    <tbody>
                    </tbody>
                  </table>
                  

            </div>
        </div>
        
    </div>
</section>
@endsection

@section('custom_js')
<script type="text/javascript">
    $(function () {
      
      var table = $('.yajra-datatable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('loan.list') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'policy', name: 'policy'},
              {data: 'photo', name: 'photo'},
              {data: 'name', name: 'name'},
              {data: 'date', name: 'joining_date'},
              {data: 'amount', name: 'amount'},
              {data: 'collected', name: 'collected'},
              {data: 'due', name: 'due'},
              {data: 'balance', name: 'balance'},
              {data: 'status', name: 'status'},
              {
                  data: 'action', 
                  name: 'action', 
                  orderable: false, 
                  searchable: false
              },
          ]
      });
      
    });
  </script>
@endsection