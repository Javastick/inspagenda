@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('input') }}">
                        <fieldset>
                          <legend>Surat</legend>
                          @csrf
                          <div class="mb-3">
                            <label for="sender" class="form-label">Pengirim</label>
                            <input type="text" id="sender" class="form-control" name="sender">
                          </div>
                          <div class="mb-3">
                            <label for="masuk" class="form-label">Tanggal Masuk</label>
                            <input type="date" id="masuk" class="form-control" name="masuk">
                          </div>
                          <div class="mb-3">
                            <label for="hari" class="form-label">Tanggal Acara</label>
                            <input type="datetime-local" id="hari" class="form-control" name="hari">
                          </div>
                          <div class="mb-3">
                            <label for="kegiatan" class="form-label">Kegiatan</label>
                            <input type="text" id="kegiatan" class="form-control" name="kegiatan">
                          </div>
                          <div class="mb-3">
                            <label for="tempat" class="form-label">Tempat</label>
                            <input type="text" id="tempat" class="form-control" name="tempat">
                          </div>
                          <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" id="keterangan" class="form-control" name="keterangan">
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </fieldset>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
