@extends('layouts.app')

@section('title', 'Home - Aplikasi Jadwal')

@section('content')
<div class="main-container d-flex justify-content-center">
    <!-- Jadwal Hari Ini dan Jadwal Berikutnya -->
    <div class="schedule-container">
        <!-- Jadwal Hari Ini -->
        <div class="card mb-4 h-50">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">📅 Jadwal Hari Ini</h5>
                <div id="today">{{ now()->translatedFormat('l, d F Y') }}</div>
            </div>
            <div class="card-body">
                @forelse ($todays as $today)
                <a href="{{ route('events.show', $today->id) }}" class="schedule-item clickable-card d-block mb-3">
                    <div class="d-flex align-items-center">
                        <span class="badge bg-primary me-2">
                            {{ $today->getHourOnly }}
                        </span>
                        <div>
                            <h6 class="fw-bold mb-0">{{ $today->kegiatan }}</h6>
                            <small class="text-muted">📍 {{ $today->tempat }}</small>
                        </div>
                    </div>
                </a>
                @empty
                <div class="text-center py-3">
                    <i class="fas fa-calendar-times fa-2x text-muted mb-2"></i>
                    <p class="mb-0 text-muted">Tidak ada jadwal hari ini</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Jadwal Berikutnya -->
        <div class="card">
            <div class="card-header bg-success text-white h-50">
                <h5 class="card-title mb-0">📌 Jadwal Berikutnya</h5>
            </div>
            <div class="card-body p-0">
                @foreach($upcomings as $date => $schedules)
                <div class="day-group">
                    <div class="date-header bg-opacity-10 p-3 border-bottom">
                        <h6 class="mb-0 fw-bold text-success">
                            {{ $date }}
                        </h6>
                    </div>
                    <div class="schedule-list p-3">
                        @foreach($schedules as $schedule)
                        <a href="{{ route('events.show', $schedule->id) }}" class="schedule-item d-flex align-items-start mb-3 clickable-card">
                            <div class="time-badge me-3">
                                <span class="badge bg-success rounded-pill">
                                    {{ $schedule->getHourOnly }}
                                </span>
                            </div>
                            <div class="schedule-detail">
                                <h6 class="fw-bold mb-1">{{ $schedule->kegiatan }}</h6>
                                <small class="text-muted">📍 {{ $schedule->tempat }}</small>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Kalender -->
    <div class="calendar-container">
        <div class="card h-100">
            <div class="card-header bg-warning text-dark">
                <h5 class="card-title mb-0">🗓️ Kalender</h5>
            </div>
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    window.calendarData = {
        events: {!! json_encode($events) !!},
        routeUrl: "{{ route('daily.schedule', 'PLACEHOLDER') }}"
    };
</script>
@vite('resources/js/calendar.js')
@endpush
@endsection