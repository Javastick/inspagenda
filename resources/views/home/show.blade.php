@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">{{ $event->kegiatan }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <dl class="row">
                        <dt class="col-sm-3">Waktu:</dt>
                        <dd class="col-sm-9">{{ $event->getday() }} pukul {{ $event->getHourOnly }}</dd>

                        <dt class="col-sm-3">Lokasi:</dt>
                        <dd class="col-sm-9">📍 {{ $event->tempat }}</dd>

                        <dt class="col-sm-3">Pengirim:</dt>
                        <dd class="col-sm-9">{{ $event->sender }}</dd>

                        @if($event->keterangan)
                        <dt class="col-sm-3">Keterangan:</dt>
                        <dd class="col-sm-9">{{ $event->keterangan }}</dd>
                        @endif
                    </dl>
                </div>
                <div class="col-md-4 border-start">
                    <div class="d-grid gap-2">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button class="btn btn-primary">
                            <i class="fas fa-calendar-plus"></i> Tambah ke Kalender
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection