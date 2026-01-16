<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
        <!-- Favicon untuk browser tab -->
        <link rel="icon" type="image/png" href="{{ asset('logo/logo192.png') }}" sizes="192x192">
        <link rel="shortcut icon" href="{{ asset('logo/logo192.png') }}" type="image/png">
    
        <!-- Apple Touch Icon (iOS) -->
        <link rel="apple-touch-icon" href="{{ asset('logo/logo192.png') }}">
    
        <!-- Meta untuk iOS -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="welcome-body">
    <div class="welcome-card">
        <div class="welcome-title mb-0">
            <img src="logo/logobgt.jpg" alt="" width="118" class="rounded">
        </div>
        <p class="text-center mt-0">Inspagenda adalah aplikasi manajemen agenda untuk Inspektorat Daerah Kabupaten Brebes yang mempermudah pencatatan, pemantauan, dan pengelolaan jadwal undangan secara efisien.</p>
        <div class="row">
            <!-- Lihat Schedule -->
            <div class="col-md-6">
                <div class="option-card">
                    <div class="option-icon">📅</div>
                    <div class="option-title">Lihat Schedule</div>
                    <div class="option-description">
                        Lihat jadwal rapat, undangan, dan kegiatan lainnya.
                    </div>
                    <a href="{{ route('home') }}" class="btn btn-primary btn-option">Buka Schedule</a>
                </div>
            </div>
            <!-- Input Surat -->
            <div class="col-md-6">
                <div class="option-card">
                    <div class="option-icon">📝</div>
                    <div class="option-title">Input Surat</div>
                    <div class="option-description">
                        Input surat undangan masuk.
                    </div>
                    <a href="{{ route('admin') }}" class="btn btn-success btn-option">Input Surat</a>
                </div>
            </div>
        </div>
    </div>


</body>
</html>