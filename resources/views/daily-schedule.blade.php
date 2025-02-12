@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card">
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
                                        @if ($schedules->isEmpty())
                                            Tidak ada undangan hari ini.
                                        @else
                                            @foreach ($schedules as $schedule)
                                                <li class="d-flex align-items-start mb-3 p-3 rounded shadow-sm">
                                                    <!-- Time Column -->
                                                    <div class="flex-shrink-0" style="min-width: 60px;">
                                                        <div class="text-danger fw-semibold">{{ $schedule->getHourOnly }}</div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex flex-column">
                                                            <h6 class="fw-bold mb-1 text-truncate">{{ $schedule->kegiatan }}</h6>
                                                            <div class="d-flex align-items-center">
                                                                <small class="text-muted">{{ $schedule->tempat }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
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
    </div>
@endsection
