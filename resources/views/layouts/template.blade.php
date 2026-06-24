<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Peta')</title>

    {{-- FAVICON --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" href="{{ asset('/assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('/assets/img/favicons/manifest.json') }}">

    <meta name="msapplication-TileImage" content="{{ asset('/assets/img/favicons/mstile-150x150.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta name="theme-color" content="#ffffff">

    {{-- THEME CSS (ZOU TEMPLATE) --}}
    <link href="{{ asset('/assets/css/theme.css') }}" rel="stylesheet" />

    @yield('styles')
</head>

<body>

    {{-- NAVBAR (fixed-top dari template) --}}
    @include('components.navbar')


    {{-- MAIN CONTENT --}}
    <main style="padding-top: 90px;">
        @yield('content')
    </main>


    {{-- TOAST (global notification) --}}
    @include('components.toast')


    {{-- JS --}}
    <script src="{{ asset('/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="{{ asset('/assets/js/theme.js') }}"></script> --}}


    @yield('scripts')
    <script>
document.addEventListener('DOMContentLoaded', function () {

    const toastElList = document.querySelectorAll('.toast');

    toastElList.forEach(function(toastEl) {

        const toast = new bootstrap.Toast(toastEl, {
            autohide: true,
            delay: 3000
        });

        toast.show();

    });

});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.toast').forEach(function(el){

        const toast = new bootstrap.Toast(el, {
            delay: 3000,
            autohide: true
        });

        toast.show();

    });

});
</script>
</body>
</html>
