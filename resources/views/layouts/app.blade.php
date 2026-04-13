<!DOCTYPE html>
<html lang="en">

<head>


    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'onSchedule')</title>

    <!-- Favicon untuk browser tab -->
    <link rel="icon" type="image/png" href="{{ asset('logo/logo192.png') }}" sizes="192x192">
    <link rel="shortcut icon" href="{{ asset('logo/logo192.png') }}" type="image/png">

    <!-- Apple Touch Icon (iOS) -->
    <link rel="apple-touch-icon" href="{{ asset('logo/logo192.png') }}">

    <!-- Meta untuk iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    {{-- vite --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/calendar.js'])

    @stack('styles')
    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- date --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container d-flex">
            <a class="navbar-brand" href="/">
                <div class="brand-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                OnSchedule
            </a>
            <a  href="{{ route('admin') }}" class="btn btn-outline-custom btn-sm ms-auto">
                <i class="far fa-user"></i>
                Login Admin
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid px-0 d-flex flex-column">
        @yield('content') <!-- Bagian konten halaman akan diisi di sini -->
    </div>



    <!-- Scripts -->
    @stack('scripts') <!-- Untuk menambahkan script khusus halaman -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- manifest --}}
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js')
                .then(registration => console.log('ServiceWorker registered'))
                .catch(err => console.log('ServiceWorker registration failed:', err));
        }
    </script>
</body>

</html>
