@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>PSKS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.employee.report.index') }}">Data Pelaporan</a></div>
                <div class="breadcrumb-item">Ubah Laporan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Ubah Laporan {{ auth()->user()->pillar->code }}</h2>
            <p class="section-lead">{{ auth()->user()->pillar->name }}</p>
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Laporan</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('app.pillar.lks.report.update', [$report->hash, $report->type]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control" name="" value="{{ auth()->user()->name }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nomor Induk Anggota {{ auth()->user()->pillar->code }}</label>
                                            <input type="text" class="form-control" name="" value="{{ auth()->user()->nip }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="section-title mt-0">Lokasi Tugas</div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Kabupaten / Kota</label>
                                            <input type="text" class="form-control" name="" placeholder="Masukkan Kabupaten / Kota" value="{{ $report->lks->address['regency'] }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Kecamatan</label>
                                            <input type="text" class="form-control" name="" placeholder="Masukkan Kecamatan" value="{{ $report->lks->address['district'] }}" disabled>
                                        </div>
                                    </div>
                                </div>

                                @if($report->type === 'daily')
                                    <div class="type-realtime">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Waktu</label>
                                                    <input type="date" class="form-control  @error('date_daily') is-invalid @enderror" name="date_daily" value="{{ $report->date }}">
                                                    @error('date_daily')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Tempat Kegiatan</label>
                                                    <input type="text" class="form-control  @error('venue') is-invalid @enderror" name="venue" placeholder="Masukkan Tempat Kegiatan" value="{{ $report->venue }}">
                                                    @error('venue')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Aktivitas yang dilakukan</label>
                                                    <textarea name="activity" class="form-control  @error('activity') is-invalid @enderror" placeholder="Masukkan Aktivitas yang dilakukan" style="height: 100px" cols="30" rows="10">{{ $report->activity }}</textarea>
                                                    @error('activity')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Kendala</label>
                                                    <textarea name="constraint" class="form-control  @error('constraint') is-invalid @enderror" placeholder="Masukkan Kendala" style="height: 100px" cols="30" rows="10">{{ $report->constraint }}</textarea>
                                                    @error('constraint')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Dokumentasi Lapangan</label>
                                                    <input type="file" class="form-control @error('attachment_daily') is-invalid @enderror" name="attachment_daily" accept=".png, .jpg, .jpeg">
                                                    <small class="form-text text-muted">
                                                        <li>Ekstensi file harus : PNG, JPG, JPEG</li>
                                                        <li>Pilih file jika ingin melakukan perubahan.</li>
                                                    </small>
                                                    @error('attachment_daily')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror

                                                    @if ($report->attachment)
                                                        <a href="{{ asset('storage/pillars/lks/report/daily/'. $report->attachment) }}" target="_blank" class="btn btn-primary btn-sm mt-2">
                                                            <i class="bi bi-download me-1"></i> Lihat Dokumentasi Lapangan
                                                        </a>
                                                    @else
                                                        <h5>Belum ada dokumentasi lapangan</h5>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Uraian / Keterangan Foto</label>
                                                    <textarea name="description" class="form-control  @error('description') is-invalid @enderror" placeholder="Masukkan Uraian / Keterangan Foto" style="height: 100px" cols="30" rows="10">{{ $report->description }}</textarea>
                                                    @error('description')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="type-monthly">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Bulan</label>
                                                    <input type="month" class="form-control @error('date_monthly') is-invalid @enderror" name="date_monthly" placeholder="Masukkan Bulan" value="{{ $report->date }}">
                                                    @error('date_monthly')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Dokumen Laporan</label>
                                                    <input type="file" class="form-control  @error('attachment_monthly') is-invalid @enderror" name="attachment_monthly" accept=".pdf">
                                                    <small class="form-text text-muted">
                                                        <li>Ekstensi file harus : PDF</li>
                                                        <li>Pilih file jika ingin melakukan perubahan.</li>
                                                    </small>

                                                    @error('attachment_monthly')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror

                                                    @if ($report->attachment)
                                                        <a href="{{ asset('storage/pillars/lks/report/monthly/'. $report->attachment) }}" target="_blank" class="btn btn-primary btn-sm mt-2">
                                                            <i class="bi bi-download me-1"></i> Lihat Dokumentasi Laporan
                                                        </a>
                                                    @else
                                                        <h5>Belum ada dokumentasi laporan</h5>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-12">
                                        <a type="button" href="{{ route('app.pillar.lks.report.index') }}" class="btn btn-icon btn-danger" title="Batal">Batal</a>
                                        <button type="submit" class="btn btn-icon btn-success" title="Simpan">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Catatan Revisi</h4>
                        </div>
                        <div class="card-body">
                            @foreach($reportNotes as $note)
                                <div class="list-group">
                                    <a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <div>
                                                <h6>{{ $note->user->name }}</h6>
                                                <small class="pt-0">{{ $note->user->office->name }}</small>
                                                <hr>
                                            </div>
                                            <small>{{ $note->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="mb-1">{{ $note->note }}</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js-libraries')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
@endpush
