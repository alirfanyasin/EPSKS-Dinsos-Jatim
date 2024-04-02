@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>PSKS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.tksk.index') }}">Data TKSK</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.tksk.report.index') }}">Laporan</a></div>
                <div class="breadcrumb-item">Edit Laporan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Laporan TKSK </h2>
            <p class="section-lead">Tenaga Kerja Sosial Kecamatan</p>
            <div class="card">
                <div class="card-header">
                    <h4>Edit Laporan TKSK</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('app.pillar.tksk.report.update', ['tksk_report_hash' => $tkskReport->hash]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if ($tkskReport->type == 'daily')
                            <div class="type-realtime">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Jenis Laporan</label>
                                            <input type="text" class="form-control" name="type" value="{{ $tkskReport->reportType }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Waktu</label>
                                            <input type="date" class="form-control  @error('date_daily') is-invalid @enderror" name="date_daily" value="{{ $tkskReport->date }}">
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
                                            <input type="text" class="form-control  @error('venue') is-invalid @enderror" name="venue" placeholder="Masukkan Tempat Kegiatan" value="{{ $tkskReport->venue }}">
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
                                            <input type="text" class="form-control  @error('activity') is-invalid @enderror" name="activity" placeholder="Masukkan Aktivitas yang dilakukan" value="{{ $tkskReport->activity }}">
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
                                            <input type="text" class="form-control  @error('constraint') is-invalid @enderror" name="constraint" placeholder="Masukkan Kendala" value="{{ $tkskReport->constraint }}">
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
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control @error('attachment_daily') is-invalid @enderror" name="attachment_daily" accept=".png, .jpg, .jpeg">
                                                <div class="input-group-append">
                                                    <button data-toggle="modal" data-target="#previewPhoto" class="btn btn-primary btn-file" type="button">Foto Saat ini</button>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted">
                                                <li>Ekstensi file harus : PNG, JPG, JPEG</li>
                                            </small>
                                            @error('attachment_daily')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="modal fade" tabindex="-1" role="dialog" id="previewPhoto">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Preview Dokumetasi Lapangan </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <center>
                                                        <figure class="figure">
                                                            <img src="{{ asset('storage/pillars/tksk/report/'. $tkskReport->attachment) }}" class="figure-img img-fluid rounded" alt="...">
                                                        </figure>
                                                    </center>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Uraian / Keterangan Foto</label>
                                            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Masukkan Uraian / Keterangan Foto" value="{{ $tkskReport->description }}">
                                            @error('description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($tkskReport->type == 'monthly')
                            <div class="type-monthly">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Jenis Laporan</label>
                                            <input type="text" class="form-control" name="type" value="{{ $tkskReport->reportType }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Bulan</label>
                                            <input type="month" class="form-control @error('date_monthly') is-invalid @enderror" name="date_monthly" placeholder="Masukkan Bulan" value="{{ $tkskReport->date }}">
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
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control @error('attachment_monthly') is-invalid @enderror" name="attachment_monthly" accept=".pdf">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary btn-file" type="button" data-toggle="modal" data-target="#previewFile">File Saat ini</button>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted">
                                                <li>Ekstensi file harus : PDF</li>
                                            </small>
                                            @error('attachment_monthly')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="modal fade" tabindex="-1" role="dialog" id="previewFile">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Preview Dokumen Laporan </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <center>
                                                        <embed type="application/pdf" src="{{ asset('storage/pillars/tksk/report/'. $tkskReport->attachment) }}" width="600" height="400"></embed>
                                                    </center>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <a type="button" href="{{ route('app.pillar.tksk.report.index') }}" class="btn btn-icon btn-danger" title="Batal">Batal</a>
                                <button type="submit" class="btn btn-icon btn-success" title="Simpan">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js-libraries')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
@endpush

@push('script')
@endpush
