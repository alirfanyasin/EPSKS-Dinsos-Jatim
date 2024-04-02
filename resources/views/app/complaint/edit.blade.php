@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Aduan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.complaint.index') }}">Aduan</a></div>
                <div class="breadcrumb-item">Edit Aduan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Aduan</h2>
            <p class="section-lead">Ubah Laporan Aduan</p>
            <div class="card">
                <div class="card-header">
                    <h4>Formulir Edit Aduan</h4>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Judul Aduan</label>
                                    <input type="text" class="form-control" name=""
                                        placeholder="Masukkan Judul Aduan" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Detail Aduan</label>
                                    <textarea class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Bukti Laporan</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a type="button" href="{{ route('app.complaint.index') }}" class="btn btn-icon btn-danger"
                                    title="Batal">Batal</a>
                                <button type="submit" class="btn btn-icon btn-success" title="Simpan">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
