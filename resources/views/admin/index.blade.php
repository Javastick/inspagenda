@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="admin-card">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">
                <i class="fas fa-envelope me-2"></i>Input Surat Undangan
            </h3>
        </div>

        <!-- Form Input -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        Form Input Surat
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.store') }}">
                            @csrf
                            <!-- Di dalam form -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Masuk Surat</label>
                                        <div class="input-group flatpickr-now-group">
                                            <input type="text" 
                                                   class="form-control" 
                                                   name="masuk"
                                                   id="masukInput"
                                                   placeholder="Pilih Tanggal & Waktu">
                                            <button type="button" class="btn btn-primary" id="btnNow">
                                                <i class="fas fa-clock"></i> Sekarang
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Kegiatan</label>
                                        <input type="text" 
                                               class="form-control" 
                                               name="hari"
                                               id="hariInput"
                                               placeholder="Pilih Tanggal & Waktu (Minimal hari ini)">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Pengirim Surat</label>
                                <input type="text" class="form-control" name="sender" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Kegiatan</label>
                                <input type="text" class="form-control" name="kegiatan" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Lokasi Kegiatan</label>
                                <input type="text" class="form-control" name="tempat" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <textarea class="form-control" name="keterangan" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-save me-2"></i>Simpan Surat
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Surat -->
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        Daftar Surat Undangan
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Tanggal Kegiatan</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Kegiatan</th>
                                        <th>Tempat</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($surat as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->hari)->translatedFormat('d M Y H:i') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->masuk)->translatedFormat('d M Y H:i') }}</td>
                                        <td>{{ $item->kegiatan }}</td>
                                        <td>{{ $item->tempat }}</td>
                                        <td>
                                            <span class="badge bg-{{ $item->status == 'terkirim' ? 'success' : 'warning' }}">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">
                                                Edit
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Tambahkan style untuk status */
.badge {
    font-size: 0.85em;
    padding: 0.5em 0.75em;
    border-radius: 1rem;
}

.table th {
    white-space: nowrap;
    vertical-align: middle;
}

.table td {
    vertical-align: middle;
}
</style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Konfigurasi untuk Tanggal Masuk
            const masukFP = flatpickr('#masukInput', {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                locale: {
                    // ... konfigurasi bahasa Indonesia
                }
            });
        
            // Tombol Sekarang
            document.getElementById('btnNow').addEventListener('click', () => {
                masukFP.setDate(new Date());
            });
        
            // Konfigurasi untuk Tanggal Kegiatan
            const hariFP = flatpickr('#hariInput', {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                minDate: "today",
                minuteIncrement: 5,
                onValueUpdate: function(selectedDates) {
                    const now = new Date();
                    if (selectedDates[0].getDate() === now.getDate()) {
                        this.set('minTime', now.getHours() + ":" + now.getMinutes());
                    }
                },
                locale: {
                    // ... konfigurasi bahasa Indonesia
                }
            });
        });
        </script>
        
        <style>
        /* Gaya untuk input group */
        .flatpickr-now-group {
            display: flex;
            gap: 8px;
        }
        
        .flatpickr-now-group .form-control {
            flex-grow: 1;
            min-width: 200px;
        }
        
        #btnNow {
            white-space: nowrap;
            padding: 0 15px;
        }
        
        /* Responsive untuk mobile */
        @media (max-width: 768px) {
            .flatpickr-now-group {
                flex-direction: column;
            }
            
            #btnNow {
                width: 100%;
                padding: 10px;
            }
        }
        </style>
        
@endsection
