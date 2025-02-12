@extends('layouts.app')

@section('title', 'Jadwal Harian')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <a href="{{ url()->previous() }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <h2 class="mb-0 text-center">
            <span class="text-muted">Jadwal</span><br>
            <strong>{{ $date->translatedFormat('l, j F Y') }}</strong>
        </h2>
        <div></div> <!-- Untuk alignment -->
    </div>

    <!-- Daftar Jadwal -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if($events->isEmpty())
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">Tidak ada jadwal hari ini</h4>
                    </div>
                </div>
            @else
                @foreach($events as $event)
                <div class="card schedule-card mb-3 border-0 shadow-sm hover-shadow">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <!-- Garis Warna -->
                            <div class="col-auto ps-0">
                                <div class="timeline-line bg-primary"></div>
                            </div>
                            
                            <!-- Konten Jadwal -->
                            <div class="col">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <span class="badge bg-primary bg-opacity-10 text-primary mb-2">
                                            <i class="fas fa-clock me-2"></i>{{ $event->getHourOnly }}
                                        </span>
                                        <h4 class="mb-0">{{ $event->kegiatan }}</h4>
                                    </div>
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                                
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                    <span class="text-muted">{{ $event->tempat }}</span>
                                </div>
                                
                                @if($event->keterangan)
                                <div class="alert alert-light mt-2 mb-0">
                                    <i class="fas fa-info-circle me-2 text-primary"></i>
                                    {{ $event->keterangan }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<style>
    .schedule-card {
        transition: transform 0.2s, box-shadow 0.2s;
        border-left: 3px solid transparent;
    }
    
    .schedule-card:hover {
        transform: translateY(-3px);
        border-left-color: #0d6efd;
    }
    
    .timeline-line {
        width: 3px;
        height: 100%;
        min-height: 80px;
        background: #0d6efd;
        border-radius: 3px;
    }
    
    .hover-shadow {
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    
    .hover-shadow:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    @media (max-width: 576px) {
        .schedule-card .col-auto {
            display: none;
        }
        
        .schedule-card {
            border-left: none !important;
            border-top: 3px solid #0d6efd;
        }
    }
</style>
@endsection