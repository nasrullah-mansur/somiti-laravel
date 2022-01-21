<script src="{{ asset('front/js/jquery.2.2.4.min.js') }}"></script>
<script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('front/js/select-2.js') }}"></script>

<script src="{{ asset('front/js/datatable.min.js') }}"></script>
<script src="{{ asset('front/js/datatable-bootstrap.min.js') }}"></script>
<script src="{{ asset('front/js/toastr.min.js') }}"></script>


<script src="{{ asset('front/js/custom.js') }}"></script>

@push('scripts')

@yield('custom_js')

{!! Toastr::message() !!}