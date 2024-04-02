@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>PSKS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.employee.report.index') }}">Data Pelaporan</a></div>
                <div class="breadcrumb-item">Export Laporan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Export Laporan {{ auth()->user()->pillar->code }}</h2>
            <p class="section-lead">{{ auth()->user()->pillar->name }}</p>
            @if($errors->any())
                <div class="alert alert-warning" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Form Export Laporan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('app.employee.report.doExport') }}" method="POST">
                        @csrf

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
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Kabupaten / Kota</label>
                                        <input type="text" class="form-control" name="" placeholder="Masukkan Kabupaten / Kota" value="{{ auth()->user()->psm->duty_address['regency'] }}" disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Kecamatan</label>
                                        <input type="text" class="form-control" name="" placeholder="Masukkan Kecamatan" value="{{ auth()->user()->psm->duty_address['district'] }}" disabled>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Pilih Bulan Laporan</label>
                                    <select name="month" class="form-control @error('month') is-invalid @enderror" required>
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
                                    @error('month')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
