@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>PSKS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.lks.report.index') }}">Data Pelaporan</a>
                </div>
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
                    <form action="{{ route('app.pillar.lks.report.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <div class="section-title mt-0">Pilih Jenis Laporan</div>
                                <div class="form-group">
                                    <label>Pilih salah satu</label>
                                    <select class="custom-select @error('type') is-invalid @enderror" name="type"
                                        required>
                                        <option disabled selected>Pilih Jenis Laporan</option>
                                        <option value="daily">Harian</option>
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
                                    <input type="text" class="form-control" name=""
                                        value="{{ auth()->user()->name }}" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nomor Induk Anggota {{ auth()->user()->pillar->code }}</label>
                                    <input type="text" class="form-control" name=""
                                        value="{{ auth()->user()->nip }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="section-title mt-0">Lokasi Tugas</div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Kabupaten / Kota</label>
                                    <input type="text" class="form-control" name=""
                                        placeholder="Masukkan Kabupaten / Kota"
                                        value="{{ auth()->user()->lks->address['regency'] }}" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input type="text" class="form-control" name=""
                                        placeholder="Masukkan Kecamatan"
                                        value="{{ auth()->user()->lks->address['district'] }}" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <input type="text" class="form-control" name=""
                                        placeholder="Masukkan kelurahan"
                                        value="{{ auth()->user()->lks->address['village'] }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Alamat Lengkap</label>
                                    <input type="text" class="form-control" name=""
                                        value="{{ auth()->user()->lks->address['full_address'] }}" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>RW</label>
                                    <input type="text" class="form-control" name=""
                                        value="{{ auth()->user()->lks->address['rw'] }}" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>RT</label>
                                    <input type="text" class="form-control" name=""
                                        value="{{ auth()->user()->lks->address['rt'] }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="type-realtime" hidden>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Waktu</label>
                                        <input type="date"
                                            class="form-control  @error('date_daily') is-invalid @enderror"
                                            name="date_daily" value="{{ old('date_daily') }}">
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
                                        <input type="text" class="form-control  @error('venue') is-invalid @enderror"
                                            name="venue" placeholder="Masukkan Tempat Kegiatan"
                                            value="{{ old('venue') }}">
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
                                        <textarea name="activity" style="height: 100px" class="form-control  @error('activity') is-invalid @enderror"
                                            id="" cols="30" rows="10" placeholder="Masukkan Aktivitas yang dilakukan">{{ old('activity') }}</textarea>
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
                                        <textarea name="constraint" style="height: 100px" class="form-control  @error('constraint') is-invalid @enderror"
                                            id="" cols="30" rows="10" placeholder="Masukkan Kendala">{{ old('constraint') }}</textarea>
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
                                        <input type="file"
                                            class="form-control @error('attachment_daily') is-invalid @enderror"
                                            name="attachment_daily" accept=".png, .jpg, .jpeg">
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
                                        <textarea name="description" style="height: 100px" class="form-control  @error('description') is-invalid @enderror"
                                            id="" cols="30" rows="10" placeholder="Masukkan Uraian / Keterangan Foto">{{ old('description') }}</textarea>
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
                                        <input type="month"
                                            class="form-control @error('date_monthly') is-invalid @enderror"
                                            name="date_monthly" placeholder="Masukkan Bulan"
                                            value="{{ old('date_monthly') }}">
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
                                        <input type="file"
                                            class="form-control  @error('attachment_monthly') is-invalid @enderror"
                                            name="attachment_monthly" accept=".pdf">
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
                                <a type="button" href="{{ route('app.pillar.lks.report.index') }}"
                                    class="btn btn-icon btn-danger" title="Batal">Batal</a>
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
        $('.custom-select').on('change', function() {
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
