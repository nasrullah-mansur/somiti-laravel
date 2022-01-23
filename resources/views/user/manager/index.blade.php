@extends('layouts.front')

@section('content')
<section class="all-users col-lg-8 m-auto">
    <div class="container">
        <div class="text-center pb-3">
            <h1 class="pb-3">ম্যানেজারগণের বিবরণ</h1>
            <a href="{{ route('user.manager.create') }}" class="btn btn-primary">নতুন ম্যানেজার যোগ করুন</a>
        </div>
        <div class="user-address pt-3">
            <div class="table-responsive">
                <table class="table table-striped table-bordered yajra-datatable bg-white w-100">
                    <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">নাম</th>
                          <th scope="col">ইমেইল</th>
                          <th scope="col">একসন</th>
                        </tr>
                      </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('user.manager.delete', $user->id) }}" onclick="return confirm('সত্যিই কি মুছে ফেলতে চান??')" class="btn bg-danger text-white btn-sm ms-2">ডিলিট</a>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="4">কোনো তথ্য পাওয়া যায়নি</td>
                            </tr>
                        @endforelse
                    </tbody>
                  </table>
                  

            </div>
        </div>
        
    </div>
</section>
@endsection