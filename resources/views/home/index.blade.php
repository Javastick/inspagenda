@extends('layouts.app')

@section('title', 'Home - Aplikasi Jadwal')

@section('content')
<div class="main-container d-flex justify-content-center">
    <!-- Jadwal Hari Ini dan Jadwal Berikutnya -->
    <div class="schedule-container">
        <!-- Jadwal Hari Ini -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">📅 Jadwal Hari Ini</h5>
                <div id="today"></div>
            </div>
            <div class="card-body">
                @foreach ($todays as $today)
                <a href="{{ route('events.show', $today->id) }}" class="schedule-item clickable-card">
                    <h6 class="fw-bold">{{ $today->getHourOnly }} - {{ $today->kegiatan }}</h6>
                    <small class="text-muted">📍 {{ $today->tempat }}</small>
                </a>
                @endforeach
            </div>
        </div>
    
        <!-- Jadwal Berikutnya -->
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="card-title mb-0">📌 Jadwal Berikutnya</h5>
            </div>
            <div class="card-body p-0">
                @foreach($upcomings as $date => $schedules)
                <div class="day-group">
                    <div class="date-header bg-success bg-opacity-10 p-3 border-bottom">
                        <h6 class="mb-0 fw-bold text-success">{{ $date }}</h6>
                    </div>
                    <div class="schedule-list p-3">
                        @foreach($schedules as $schedule)
                        <a href="{{ route('events.show', $schedule->id) }}" class="schedule-item d-flex align-items-start mb-3 clickable-card">
                            <div class="time-badge me-3">
                                <span class="badge bg-success rounded-pill">{{ $schedule->waktu }}</span>
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
    document.addEventListener("DOMContentLoaded", function() {
        // Date formatting
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        document.getElementById('today').textContent = new Date().toLocaleDateString('id-ID', options);

        const calendarEl = document.getElementById('calendar');
        if (calendarEl) {
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                events: {!! json_encode($events) !!},
                dateClick: function(info) {
                    window.location.href = `{{ route('daily.schedule', '') }}/${info.dateStr}`;
                },
                eventDidMount: function(info) {
                    // Custom rendering untuk event
                    info.el.innerHTML = `
        <div class="fc-event-dot" 
             data-bs-toggle="tooltip" 
             title="${info.event.title} - ${info.event.extendedProps.tempat}"
             onclick="window.location.href='${info.event.url}'">
        </div>
    `;
                    
                    new bootstrap.Tooltip(info.el.querySelector('.fc-event-dot'));
                    info.el.style.cursor = 'pointer';
                },
                eventContent: function(info) {
                    // Kosongkan konten default
                    return { html: '' };
                },
                headerToolbar: {
                    left: 'prev',
                    center: 'title',
                    right: 'today,next'
                }
            });
            calendar.render();
        }
        // Fungsi untuk memperbarui bagian jadwal secara real time
    function updateSchedules() {
        fetch("{{ route('home.update-schedule') }}")
            .then(response => response.text())
            .then(html => {
                const container = document.getElementById('schedule-container');
                if (container) {
                    container.innerHTML = html;
                }
            })
            .catch(error => console.error('Error updating schedules:', error));
    }

    // Lakukan polling untuk memperbarui jadwal setiap 10 detik
    setInterval(updateSchedules, 10000);

    // Perbarui kalender FullCalendar setiap 10 detik (jika menggunakan sumber events dinamis)
    if (calendar) {
        setInterval(() => {
            calendar.refetchEvents();
        }, 10000);
    }
    });
</script>
@endpush
@endsection