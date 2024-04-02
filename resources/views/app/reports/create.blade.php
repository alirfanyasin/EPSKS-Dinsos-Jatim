@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>PSKS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.employee.report.index') }}">Data Pelaporan</a></div>
                <div class="breadcrumb-item">Tambah Laporan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Tambah Laporan {{ auth()->user()->pillar->code }}</h2>
            <p class="section-lead">{{ auth()->user()->pillar->name }}</p>
            <div class="card">
                <div class="card-header">
                    <h4>Form Laporan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('app.employee.report.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <div class="section-title mt-0">Pilih Jenis Laporan</div>
                                <div class="form-group">
                                    <label>Pilih salah satu</label>
                                    <select class="custom-select @error('type') is-invalid @enderror" name="type" required>
                                        <option disabled selected>Pilih Jenis Laporan</option>
                                        <option value="daily">Real Time (Harian)</option>
                                        <option value="monthly">Bulanan</option>
                                    </select>
                                    @error('type')
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

                        <div class="type-realtime" hidden>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Waktu</label>
                                        <input type="date" class="form-control  @error('date_daily') is-invalid @enderror" name="date_daily" value="{{ old('date_daily') }}">
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
                                        <input type="text" class="form-control  @error('venue') is-invalid @enderror" name="venue" placeholder="Masukkan Tempat Kegiatan" value="{{ old('venue') }}">
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
                                        <textarea class="form-control @error('activity') is-invalid @enderror" name="activity" placeholder="Masukkan Aktivitas yang dilakukan" style="min-height: 150px">{{ old('activity') }}</textarea>
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
                                        <textarea class="form-control @error('constraint') is-invalid @enderror" name="constraint" placeholder="Masukkan Kendala" style="min-height: 150px">{{ old('constraint') }}</textarea>
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
                                        </small>
                                        @error('attachment_daily')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Uraian / Keterangan Foto</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Masukkan Uraian / Keterangan Foto" style="min-height: 100px">{{ old('description') }}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="type-monthly" hidden>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Bulan</label>
                                        <select name="date_monthly" class="form-control @error('date_monthly') is-invalid @enderror">
                                            <option value="{{ date('Y').'-01' }}">Januari</option>
                                            <option value="{{ date('Y').'-02' }}">Februari</option>
                                            <option value="{{ date('Y').'-03' }}">Maret</option>
                                            <option value="{{ date('Y').'-04' }}">April</option>
                                            <option value="{{ date('Y').'-05' }}">Mei</option>
                                            <option value="{{ date('Y').'-06' }}">Juni</option>
                                            <option value="{{ date('Y').'-07' }}">Juli</option>
                                            <option value="{{ date('Y').'-08' }}">Agustus</option>
                                            <option value="{{ date('Y').'-09' }}">September</option>
                                            <option value="{{ date('Y').'-10' }}">Oktober</option>
                                            <option value="{{ date('Y').'-11' }}">November</option>
                                            <option value="{{ date('Y').'-12' }}">Desember</option>
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
                                        <input type="file" class="form-control  @error('attachment_monthly') is-invalid @enderror" name="attachment_monthly" accept=".pdf">
                                        @error('attachment_monthly')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
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
    </section>
@endsection

@push('js-libraries')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
@endpush

@push('script')
    <script>
        $('.custom-select').on('change', function () {
            console.log($(this).val());
            if ($(this).val() == 'daily') {
                $('.type-realtime').attr('hidden', false);
                $('.type-monthly').attr('hidden', true);
            } else {
                $('.type-realtime').attr('hidden', true);
                $('.type-monthly').attr('hidden', false);
            }
        })
    </script>
@endpush
