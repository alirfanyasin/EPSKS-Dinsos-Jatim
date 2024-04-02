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
            <h2 class="section-title">Ubah {{ $report->reportType }} {{ auth()->user()->pillar->code }}</h2>
            <p class="section-lead">{{ auth()->user()->pillar->name }}</p>
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Laporan</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('app.employee.report.update', [$report->type, $report->hash]) }}" method="POST" enctype="multipart/form-data">
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
                                    @if(auth()->user()->pillar->id === \App\Models\Pillars\Pillar::PILLAR_TKSK)
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Kabupaten / Kota</label>
                                                <input type="text" class="form-control" name="" placeholder="Masukkan Kabupaten / Kota" value="{{ auth()->user()->tksk->duty_address['regency'] }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Kecamatan</label>
                                                <input type="text" class="form-control" name="" placeholder="Masukkan Kecamatan" value="{{ auth()->user()->tksk->duty_address['district'] }}" disabled>
                                            </div>
                                        </div>
                                    @elseif(auth()->user()->pillar->id === \App\Models\Pillars\Pillar::PILLAR_PSM)
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Kabupaten / Kota</label>
                                                <input type="text" class="form-control" name="" placeholder="Masukkan Kabupaten / Kota" value="{{ auth()->user()->psm->duty_address['regency'] }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Kecamatan</label>
                                                <input type="text" class="form-control" name="" placeholder="Masukkan Kecamatan" value="{{ auth()->user()->psm->duty_address['district'] }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Desa / Kelurahan</label>
                                                <input type="text" class="form-control" name="" placeholder="Masukkan Desa / Kelurahan" value="{{ auth()->user()->psm->duty_address['village'] }}" disabled>
                                            </div>
                                        </div>
                                    @endif
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
                                                    <textarea class="form-control  @error('activity') is-invalid @enderror" name="activity" placeholder="Masukkan Aktivitas yang dilakukan" style="min-height: 150px">{{ $report->activity }}</textarea>
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
                                                    <textarea class="form-control @error('constraint') is-invalid @enderror" name="constraint" placeholder="Masukkan Kendala" style="min-height: 150px">{{ $report->constraint }}</textarea>
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
                                                        <a href="{{ url($report->attachmentPath) }}" target="_blank" class="btn btn-primary btn-sm mt-2">
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
                                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Masukkan Uraian / Keterangan Foto" style="min-height: 100px">{{ $report->description }}</textarea>
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
                                                    <select name="date_monthly" class="form-control @error('date_monthly') is-invalid @enderror">
                                                        <option value="{{ date('Y').'-01' }}" @if($report->date === date('Y').'-01') selected @endif>Januari</option>
                                                        <option value="{{ date('Y').'-02' }}" @if($report->date === date('Y').'-02') selected @endif>Februari</option>
                                                        <option value="{{ date('Y').'-03' }}" @if($report->date === date('Y').'-03') selected @endif>Maret</option>
                                                        <option value="{{ date('Y').'-04' }}" @if($report->date === date('Y').'-04') selected @endif>April</option>
                                                        <option value="{{ date('Y').'-05' }}" @if($report->date === date('Y').'-05') selected @endif>Mei</option>
                                                        <option value="{{ date('Y').'-06' }}" @if($report->date === date('Y').'-06') selected @endif>Juni</option>
                                                        <option value="{{ date('Y').'-07' }}" @if($report->date === date('Y').'-07') selected @endif>Juli</option>
                                                        <option value="{{ date('Y').'-08' }}" @if($report->date === date('Y').'-08') selected @endif>Agustus</option>
                                                        <option value="{{ date('Y').'-09' }}" @if($report->date === date('Y').'-09') selected @endif>September</option>
                                                        <option value="{{ date('Y').'-10' }}" @if($report->date === date('Y').'-10') selected @endif>Oktober</option>
                                                        <option value="{{ date('Y').'-11' }}" @if($report->date === date('Y').'-11') selected @endif>November</option>
                                                        <option value="{{ date('Y').'-12' }}" @if($report->date === date('Y').'-12') selected @endif>Desember</option>
                                                    </select>
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
                                                    <input type="file" class="form-control @error('attachment_monthly') is-invalid @enderror" name="attachment_monthly" accept=".pdf">
                                                    @error('attachment_monthly')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror

                                                    @if ($report->attachment)
                                                        <a href="{{ url($report->attachmentPath) }}" class="btn btn-primary btn-sm mt-2">
                                                            <i class="bi bi-download me-1"></i> Lihat Dokumentasi Laporan
                                                        </a>
                                                    @else
                                                        <h5>Belum ada dokumentasi lapangan</h5>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-12">
                                        <a type="button" href="{{ route('app.employee.report.index') }}" class="btn btn-icon btn-danger" title="Batal">Batal</a>
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
                            @foreach($report->notes as $note)
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <div>
                                                <h6>{{ $note->author->name }}</h6>
                                                <small class="pt-0">{{ $note->author->office->name }}</small>
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
