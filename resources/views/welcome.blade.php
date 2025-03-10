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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .welcome-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 800px;
            width: 100%;
            margin: 1rem;
        }
        .welcome-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .option-card {
            background: white;
            border: none;
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
            padding: 2rem;
            margin: 1rem 0;
        }
        .option-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        .option-icon {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 1rem;
        }
        .option-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 0.5rem;
        }
        .option-description {
            color: #666;
            font-size: 0.9rem;
        }
        .btn-option {
            margin-top: 1rem;
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            border-radius: 8px;
        }
    </style>
</head>
<body>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>