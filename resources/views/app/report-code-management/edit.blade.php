<!-- UNUSED -->

@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>PSKS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.report-code.index') }}">Kode Pelaporan</a></div>
                <div class="breadcrumb-item">Generate Kode Pelaporan</div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Generate Kode Pelaporan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('app.report-code.store') }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Pillar</label>
                                <select class="form-control @error('pillar') is-invalid @enderror" name="pillar" required>
                                    <option disabled selected>Pilih Pillar</option>
                                    <option value="male">Laki-Laki</option>
                                    <option value="female">Perempuan</option>
                                </select>
                                @error('gender')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nama Anggota</label>
                                <select class="form-control @error('pillar') is-invalid @enderror" name="pillar" required>
                                    <option disabled selected>Pilih Pillar</option>
                                    <option value="male">Laki-Laki</option>
                                    <option value="female">Perempuan</option>
                                </select>
                                @error('gender')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Kode Pelaporan</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror" value="{{ old('report-code') }}" name="name" placeholder="Masukkan Kode Pelaporan">
                                <p class="text-danger">* Kosongkan jika ingin di generate oleh sistem.</p>
                                @error('report-code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Berlaku Sampai</label>
                                <input type="datetime-local" class="form-control @error('expired-date') is-invalid @enderror" value="{{ old('expired-date') }}" name="name" required>
                                @error('expired-date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <a type="button" href="{{ route('app.pillar.tksk.index') }}" class="btn btn-icon btn-danger mr-2" title="Batal">Batal</a>
                            <button type="submit" class="btn btn-icon btn-success" title="Simpan">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
