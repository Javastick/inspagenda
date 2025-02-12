<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Jadwal')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
            overflow-x: hidden; /* Mencegah horizontal scroll */
        }
        .navbar {
            background: linear-gradient(135deg, #667eea, #764ba2);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: bold;
            color: white !important;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            width: 100%; /* Pastikan card tidak melebihi lebar parent */
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .schedule-item {
            border-bottom: 1px solid #eee;
            padding: 1rem 0;
        }
        .schedule-item:last-child {
            border-bottom: none;
        }
        .fc-toolbar-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .fc-button {
            background: #667eea !important;
            border: none !important;
        }
        .fc-button:hover {
            background: #5568d4 !important;
        }
        .main-container {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        max-width: 1000px; /* Diperkecil dari 1200px */
        margin: 1rem auto;
        padding: 0 15px;
        min-height: calc(100vh - 100px); /* Disesuaikan */
        }

        .schedule-container {
            flex: 0 0 300px; /* Lebar tetap lebih sempit */
        }

        .calendar-container {
            flex: 1;
            min-width: 0;
            max-width: 520px; /* Diperkecil dari 500px */
        }

        

        @media (max-width: 992px) {
            .main-container {
                flex-direction: column;
                padding: 0; /* Padding diatur ulang untuk mobile */
            }
            .calendar-container {
                flex: 1;
            }
            .schedule-container {
                flex: 0 0 350px; /* Lebar tetap untuk schedule */
            }
            .card {
                margin: 0; /* Hilangkan margin di mobile */
            }
        }
        @media (max-width: 576px) {
            .schedule-container {
                padding:3px;
            }
            .fc-toolbar {
                flex-direction: column;
                align-items: center;
            }
            .fc-toolbar-title {
                font-size: 1rem;
                text-align: center;
            }
            .fc-button {
                font-size: 0.8rem;
                padding: 0.25rem 0.5rem;
            }
            .card-body {
                padding: 1rem; /* Padding lebih kecil di mobile */
            }
        }
        .fc-daygrid-day-events {
    display: flex !important;
    gap: 5px !important;
    flex-wrap: wrap !important;
    justify-content: flex-start !important;
    padding: 2px 5px !important;
}

.fc-event-dot {
    width: 8px;
    height: 8px;
    background-color: #df2225;
    border-radius: 50%;
    position: relative !important; /* Ubah dari absolute ke relative */
    top: auto !important;
    right: auto !important;
    display: inline-block !important;
    margin: 1px !important;
}

.fc-daygrid-day-frame {
    cursor: pointer;
    transition: background-color 0.2s;
}

.fc-daygrid-day-frame:hover {
    background-color: #f8f9fa;
}
.clickable-card {
            display: block;
            text-decoration: none;
            color: inherit;
            transition: all 0.2s ease;
            position: relative;
        }
    
        .clickable-card:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
        }
    
        .clickable-card::after {
            content: '\f054';
            font-family: 'Font Awesome 5 Free';
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            opacity: 0;
            transition: opacity 0.2s ease;
        }
    
        .clickable-card:hover::after {
            opacity: 1;
        }
    </style>
    @stack('styles') <!-- Untuk menambahkan style khusus halaman -->
    {{-- date --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid d-flex justify-content-center">
            <a class="navbar-brand" href="/"><img src="logo.png" alt="" width="45">Inspagenda</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid px-0">
        @yield('content') <!-- Bagian konten halaman akan diisi di sini -->
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    @stack('scripts') <!-- Untuk menambahkan script khusus halaman -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>
</html>