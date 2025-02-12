@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-12 col-md-5 mb-4 mb-md-0">
                            <div class="schedule-list bg-primary-25 rounded p-3">
                                <h4 id="today" class="font-weight-bold mb-3"></h4>
                                <h5 class="text-danger">Jadwal hari ini:</h5>
                                <ul class="list-unstyled">
                                    @if ($todays->isEmpty())
                                        Tidak ada undangan hari ini.
                                    @else
                                        @foreach ($todays as $today)
                                            <li class="d-flex align-items-start mb-3 p-3 rounded shadow-sm"
                                                style="cursor: pointer;"
                                                onclick="window.location.href='{{ route('event.detail', $today->id) }}'">
                                                <!-- Time Column -->
                                                <div class="flex-shrink-0" style="min-width: 60px;">
                                                    <div class="text-danger fw-semibold">{{ $today->getHourOnly }}</div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="d-flex flex-column">
                                                        <h6 class="fw-bold mb-1 text-truncate">{{ $today->kegiatan }}</h6>
                                                        <div class="d-flex align-items-center">
                                                            <small class="text-muted">{{ $today->tempat }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>

                            <div class="upcoming-schedule mt-4">
                                <h5 class="text-primary">Jadwal yang akan datang:</h5>
                                <ul class="list-unstyled">
                                    @foreach ($upcomings as $upcoming => $days)
                                        <li class="d-flex align-items-center mb-3 p-3 rounded shadow-sm">
                                            <!-- Time Column -->
                                            <div class="flex-shrink-0" style="min-width: 60px;">
                                                <div class="text-primary fw-semibold">{{ $upcoming }}</div>
                                            </div>
                                            <div class="row d-flex flex-column">
                                                @foreach ($days as $day)
                                                    <div class="flex-grow-1">
                                                        <h6 class="fw-bold mb-1 text-truncate">{{ $day->kegiatan }}</h6>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-12 col-md-7">
                            <div class="calendar-container border p-2">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/interaction/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/id.global.min.js'></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- @dd($events) --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        console.log({!! json_encode($days) !!});

        // Date formatting
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        document.getElementById('today').textContent = new Date().toLocaleDateString('id-ID', options);

        // Calendar initialization
        const calendarEl = document.getElementById('calendar');
        if (calendarEl) {
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    start: 'title', // will normally be on the left. if RTL, will be on the right
                    center: '',
                    end: 'today prev,next' // will normally be on the right. if RTL, will be on the left
                },
                selectable: true,
                editable: true,
                events: {!! json_encode($days) !!},
                eventDisplay: 'block',
                timeZone: 'Asia/Jakarta',
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                },
                eventContent: function(info) {
                    return {
                        html: `
                            <div class="fc-event-content">
                                <div class="fw-bold">${info.event.title}</div>
                                <small>${info.event.extendedProps.tempat}</small>
                            </div>
                        `
                    };
                },
                eventDidMount: function(info) {
                    new bootstrap.Tooltip(info.el, {
                        title: info.event.extendedProps.keterangan,
                        placement: 'top',
                        trigger: 'hover'
                    });
                },
                dateClick: function(info) {
                    window.location.href = `{{ route('daily.schedule', '') }}/${info.dateStr}`;
                },
                locale: 'id',
                buttonText: {
                    today: 'Hari Ini',
                    month: 'Bulan',
                    week: 'Minggu',
                    day: 'Hari'
                },
                dayHeaderFormat: {
                    weekday: 'short',
                },
                titleFormat: {
                    year: 'numeric',
                    month: 'long'
                },
                dayMaxEvents: true
            });
            calendar.render();
        }
    });
</script>
