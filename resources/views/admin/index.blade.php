@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <div class="admin-card">
            <!-- Form Input -->
            <div class="row my-4">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h3 class="mb-0">
                                <i class="fas fa-envelope me-2"></i>Input Surat Undangan
                            </h3>
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
                                                <input type="text" class="form-control" name="masuk" id="masukInput"
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
                                            <input type="text" class="form-control" name="hari" id="hariInput"
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
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                            <span>Daftar Surat Undangan</span>
                            <div class="d-flex w-50 justify-content-end">
                                @if (request()->has('show_all'))
                                <div>
                                    <a href="{{ route('admin') }}" class="btn btn-sm btn-outline-light">
                                        Semua
                                    </a>
                                </div>
                            @else
                                <div>
                                    <a href="{{ request()->fullUrlWithQuery(['show_all' => 1]) }}"
                                        class="btn btn-sm btn-outline-light">
                                        Aktif
                                    </a>
                                </div>
                            @endif
                                <div class="w-75 d-flex justify-end ms-3">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" id="searchInput" placeholder="Cari surat...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0" id="suratTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="50">No</th>
                                            <th>Tanggal Kegiatan</th>
                                            <th>Pengirim</th>
                                            <th>Kegiatan</th>
                                            <th>Tempat</th>
                                            <th width="170">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $counter = 0;
                                        @endphp
                        
                                        @foreach ($surat as $item)
                                            @php
                                                // Skip surat terlewat jika tidak dalam mode arsip
                                                $status = $item->getStatus();
                                                if (!request()->has('show_all') && $status === 'terlewat') {
                                                    continue;
                                                }
                                                $counter++;
                                            @endphp
                        
                                            <tr>
                                                {{-- Nomor Urut --}}
                                                <td>
                                                    @if ($surat instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                                        {{ ($surat->currentPage() - 1) * $surat->perPage() + $counter }}
                                                    @else
                                                        {{ $counter }}
                                                    @endif
                                                </td>
                        
                                                {{-- Tanggal dengan warna status --}}
                                                <td class="text-{{ $item->getStatusColor() }}">
                                                    <i class="fas fa-calendar-alt me-1"></i>
                                                    {{ \Carbon\Carbon::parse($item->hari)->translatedFormat('d M Y H:i') }}
                                                </td>
                        
                                                <td>{{ $item->sender }}</td>
                                                <td>{{ $item->kegiatan }}</td>
                                                <td>{{ $item->tempat }}</td>
                        
                                                {{-- Tombol Aksi --}}
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <!-- Tombol Lihat Detail -->
                                                        <a href="{{ route('events.show', $item->id) }}" 
                                                           class="btn btn-sm btn-outline-info"
                                                           title="Lihat Detail">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                        
                                                        <!-- Tombol Edit -->
                                                        <a href="{{ route('admin.edit', $item->id) }}"
                                                           class="btn btn-sm btn-outline-primary"
                                                           title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                        
                                                        <!-- Tombol Hapus -->
                                                        <form action="{{ route('admin.destroy', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-danger delete-btn"
                                                                data-id="{{ $item->id }}"
                                                                title="Hapus">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if ($counter === 0)
                                            <div class="alert alert-info mt-3">
                                                Tidak ada surat yang ditemukan
                                            </div>
                                        @endif
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

        #searchInput {
            max-width: 300px;
            transition: all 0.3s ease;
        }

        #searchInput:focus {
            box-shadow: none;
            border-color: #dee2e6;
        }

        .table-responsive {
            max-height: 500px;
            overflow-y: auto;
        }

        /* Numbering style */
        td:first-child {
            font-weight: 500;
            color: #666;
        }

        @media (max-width: 768px) {
            #searchInput {
                max-width: 100%;
            }

            .table-responsive {
                max-height: 300px;
            }
        }

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Konfigurasi untuk Tanggal Masuk
            const masukFP = flatpickr('#masukInput', {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                locale: 'id'
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
                minuteIncrement: 10,
                locale: 'id'
            });

            // Filter Tabel
            const searchInput = document.getElementById('searchInput');
            const table = document.getElementById('suratTable');
            const rows = table.tBodies[0].rows;

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();

                Array.from(rows).forEach(row => {
                    const cells = row.cells;
                    let found = false;

                    // Cari di semua kolom kecuali kolom aksi
                    for (let i = 0; i < cells.length - 1; i++) {
                        const cellText = cells[i].textContent.toLowerCase();
                        if (cellText.includes(searchTerm)) {
                            found = true;
                            break;
                        }
                    }

                    row.style.display = found ? '' : 'none';
                });
            });
        });
        // Konfirmasi hapus
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
