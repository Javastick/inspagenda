@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-{{ $event->getStatusColor() }} text-white">
            <h3 class="mb-1">{{ $event->kegiatan }}</h3>
        </div>
        
        <div class="card-body">
            <div class="row">
                <!-- Kolom Informasi Utama -->
                <div class="col-md-8">
                    <dl class="row">
                        <!-- Waktu -->
                        <dt class="col-sm-3 d-flex align-items-center gap-2 text-muted">
                            <i class="fas fa-clock"></i> Waktu
                        </dt>
                        <dd class="col-sm-9 mb-3">
                            <div class="d-flex flex-column">
                                <span class="fw-bold">
                                    {{ $event->getDay() }}
                                </span>
                                <span class="text-muted">
                                    {{ \Carbon\Carbon::parse($event->hari)->format('H:i') }} WIB
                                </span>
                            </div>
                        </dd>

                        <!-- Lokasi -->
                        <dt class="col-sm-3 d-flex align-items-center gap-2 text-muted">
                            <i class="fas fa-map-marker-alt"></i> Lokasi
                        </dt>
                        <dd class="col-sm-9 mb-3">
                            <span class="badge bg-light text-dark border">
                                {{ $event->tempat }}
                            </span>
                        </dd>

                        <!-- Pengirim -->
                        <dt class="col-sm-3 d-flex align-items-center gap-2 text-muted">
                            <i class="fas fa-user"></i> Pengirim
                        </dt>
                        <dd class="col-sm-9 mb-3">
                            <span class="text-primary">{{ $event->sender }}</span>
                        </dd>

                        <!-- Keterangan Kegiatan (Tidak Dihapus) -->
                        @if($event->keterangan)
                        <div class="col-12 mt-3">
                            <div class="bg-light p-3 rounded">
                                <dt class="text-muted small mb-2">
                                    <i class="fas fa-info-circle"></i> Keterangan Kegiatan
                                </dt>
                                <dd class="mb-0">
                                    {{ $event->keterangan }}
                                </dd>
                            </div>
                        </div>
                        @endif
                    </dl>
                </div>

                <!-- Kolom Aksi -->
                <div class="col-md-4">
                    <div class="bg-light p-3 rounded shadow-sm">
                        <a href="{{ url()->previous() }}" 
                           class="btn btn-outline-secondary d-flex align-items-center gap-2">
                           <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        
                        <!-- Metadata -->
                        <div class="mt-3 pt-3 border-top text-center">
                            <small class="text-muted">
                                Terakhir diperbarui:<br>
                                <span class="text-primary">
                                    {{ $event->updated_at->diffForHumans() }}
                                </span>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection