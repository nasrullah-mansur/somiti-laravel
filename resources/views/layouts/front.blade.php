<!DOCTYPE html>
<html lang="en">
<head>
    @include('components.head')
</head>
<body>

    
    <!-- Header start -->
    @include('components.header')
    <!-- Header end -->

    @yield('content')

    <!-- Footer start -->
    @include('components.footer')
    <!-- Footer end -->


    <!-- Scripts -->
    @include('components.script')
</body>
</html>