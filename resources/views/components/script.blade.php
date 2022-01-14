<script src="{{ asset('front/js/jquery.2.2.4.min.js') }}"></script>
<script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('front/js/select-2.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('front/js/custom.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.custom-select').select2();
    });
</script>

@push('scripts')

@yield('custom_js')