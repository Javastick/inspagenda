@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="admin-card">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-primary text-white py-3">
                <h2 class="mb-0">
                    <i class="fas fa-edit me-2"></i>Edit Surat Undangan
                    <div class="text-muted fs-6 mt-1 ms-2">ID: {{ str_pad($surat->id, 4, '0', STR_PAD_LEFT) }}</div>
                </h2>
            </div>

            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.update', $surat->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-calendar-plus me-2"></i>Tanggal Masuk
                                </label>
                                <input type="datetime-local" 
                                       class="form-control @error('masuk') is-invalid @enderror"
                                       name="masuk" 
                                       value="{{ old('masuk', $surat->masuk ? str_replace(' ', 'T', $surat->masuk) : '') }}">
                                @error('masuk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Tanggal Kegiatan -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-calendar-day me-2"></i>Tanggal Kegiatan
                                </label>
                                <input type="datetime-local" 
                                       class="form-control @error('hari') is-invalid @enderror"
                                       name="hari" 
                                       value="{{ old('hari', $surat->hari ? str_replace(' ', 'T', $surat->hari) : '') }}"
                                       min="{{ now()->format('Y-m-d\TH:i') }}">
                                @error('hari')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Pengirim -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-user-tie me-2"></i>Pengirim
                                </label>
                                <input type="text" 
                                       class="form-control @error('sender') is-invalid @enderror"
                                       name="sender" 
                                       value="{{ old('sender', $surat->sender) }}">
                                @error('sender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Kegiatan -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-bullhorn me-2"></i>Nama Kegiatan
                                </label>
                                <input type="text" 
                                       class="form-control @error('kegiatan') is-invalid @enderror"
                                       name="kegiatan" 
                                       value="{{ old('kegiatan', $surat->kegiatan) }}">
                                @error('kegiatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Tempat -->
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-map-marker-alt me-2"></i>Lokasi Kegiatan
                                </label>
                                <input type="text" 
                                       class="form-control @error('tempat') is-invalid @enderror"
                                       name="tempat" 
                                       value="{{ old('tempat', $surat->tempat) }}">
                                @error('tempat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-info-circle me-2"></i>Keterangan Tambahan
                                </label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                          name="keterangan" 
                                          rows="3">{{ old('keterangan', $surat->keterangan) }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-lg btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('admin') }}" class="btn btn-lg btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.admin-card {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 1rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
}

.form-control,
.form-select {
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
    border: 1px solid #dee2e6;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus,
.form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: 1.1rem;
    border-radius: 0.5rem;
}

@media (max-width: 768px) {
    .admin-card {
        padding: 1rem;
    }

    .form-control,
    .form-select {
        font-size: 0.9rem;
    }
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Konfigurasi untuk Tanggal Masuk (tanpa batasan)
    flatpickr('input[name="masuk"]', {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true,
        locale: "id"
    });

    // Konfigurasi untuk Tanggal Kegiatan
    flatpickr('input[name="hari"]', {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true,
        locale: "id",
        minDate: "today",
        minuteIncrement: 10
    });
});
</script>
@endpush
@endsection