@extends('layouts.app')
@push('css-libraries')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css"> --}}
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>PSKS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Data ASPD</div>
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.aspd.report.index') }}">Laporan</a></div>
                <div class="breadcrumb-item active"><a href="">Detail
                        Laporan</a></div>
                <div class="breadcrumb-item">Revisi Laporan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Revisi Laporan ASPD</h2>
            <p class="section-lead">Asistensi Sosial Pendamping Disabilitas</p>
            <div class="card">
                <div class="card-header">
                    <h4>Revisi Laporan ASPD</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('app.pillar.aspd.report.revision-update', ['id' => $data->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <input type="hidden" name="status" value="Menunggu disetujui">
                        <input type="hidden" name="office_id" value="{{ Auth::user()->office_id }}">
                        <input type="hidden" name="type" value="{{ $data->type }}">
                        <div class="row">
                            <div class="col">
                                <div class="alert alert-warning d-flex align-items-center" role="alert">
                                    <div style="width: 30px; height: 30px" class="mr-3">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                        </svg>
                                    </div>

                                    <div>
                                        {{ $data->message }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mt-0 section-title">Pilih Tipe Laporan</div>
                                <div class="form-group">
                                    <label>Pilih salah satu</label>
                                    <input type="text" name=""
                                        value="{{ $data->type == 'daily' ? 'Harian' : 'Bulanan' }}" class="form-control"
                                        readonly>
                                    {{-- <select class="custom-select" name="type">
                    <option value="daily" {{ $data->type == 'daily' ? 'selected' : '' }}>Realtime (Harian)</option>
                    <option value="monthly" {{ $data->type == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                  </select> --}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control" name=""
                                        value="{{ auth()->user()->name }}" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" class="form-control" name=""
                                        value="{{ auth()->user()->aspd->nik }}" disabled>
                                </div>
                            </div>
                        </div>
                        @if ($data->type == 'daily')
                            <div class="row">
                                <div class="col-6 type-daily">
                                    <div class="form-group">
                                        <label>Waktu <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('date') is-invalid @enderror"
                                            name="date" placeholder="Masukkan waktu" value="{{ $data->date }}">
                                        @error('date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 type-daily">
                                    <div class="form-group">
                                        <label>Tempat Kegiatan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('venue') is-invalid @enderror"
                                            name="venue" placeholder="Masukkan Tempat Kegiatan"
                                            value="{{ $data->venue }}">
                                        @error('venue')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 type-daily">
                                    <div class="form-group">
                                        <label>Aktivitas yang dilakukan</label>
                                        <textarea class="form-control @error('activity') is-invalid @enderror" name="activity"
                                            placeholder="Masukkan Aktivitas yang dilakukan" style="min-height: 150px">{{ $data->activity }}</textarea>
                                        @error('activity')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 type-daily">
                                    <div class="form-group">
                                        <label>Kendala</label>
                                        <textarea class="form-control @error('constraint') is-invalid @enderror" name="constraint"
                                            placeholder="Masukkan Kendala" style="min-height: 150px">{{ $data->constraint }}</textarea>
                                        @error('constraint')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 type-daily">
                                    <div class="form-group">
                                        <label>Dokumentasi Lapangan <span class="text-danger">*</span></label>
                                        <input type="file"
                                            class="form-control @error('attachment_daily') is-invalid @enderror"
                                            name="attachment_daily" accept=".png, .jpg, .jpeg">
                                        <small class="form-text text-muted">
                                            <li>Ekstensi file harus : PNG, JPG, JPEG</li>
                                            <li>Maksimal : 2 MB</li>
                                        </small>
                                        @error('attachment_daily')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 type-daily">
                                    <div class="form-group">
                                        <label>Uraian / Keterangan Foto</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                            placeholder="Masukkan Uraian / Keterangan Foto" style="min-height: 100px">{{ $data->description }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($data->type == 'monthly')
                            <div class="type-monthly">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Bulan</label>
                                            <input type="month"
                                                class="form-control @error('month') is-invalid @enderror" name="month"
                                                placeholder="Masukkan Bulan" value="{{ $data->month }}">
                                            @error('month')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Dokumen Laporan</label>
                                            <input type="file"
                                                class="form-control  @error('attachment_monthly') is-invalid @enderror"
                                                name="attachment_monthly" accept=".pdf">
                                            <small class="form-text text-muted">
                                                <li>Ekstensi file harus : PDF</li>
                                                <li>Maksimal : 7 MB</li>
                                            </small>
                                            @error('attachment_monthly')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <a type="button" href="{{ route('app.pillar.aspd.report.index') }}"
                                    class="btn btn-icon btn-danger" title="Batal">Batal</a>
                                <button type="submit" class="btn btn-icon btn-success">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('js-libraries')
    {{-- <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
@endpush


@push('script')
    <script>
        $(document).ready(function() {
            $('#table-data').DataTable();
        });



        $('.formDelete').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>
@endpush
