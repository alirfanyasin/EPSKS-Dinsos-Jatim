@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Aduan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.complaint.index') }}">Aduan</a></div>
                <div class="breadcrumb-item">Tambah Aduan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Tambah Aduan</h2>
            <p class="section-lead">Laporkan Aduan Baru</p>
            <div class="card">
                <div class="card-header">
                    <h4>Formulir Tambah Aduan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('app.complaint.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Judul Aduan</label>
                                    <input type="text" class="form-control" name="judul"
                                        placeholder="Masukkan Judul Aduan" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Detail Aduan</label>
                                    <textarea class="form-control" name="detail" required></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Bukti Laporan</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="image"
                                            required>
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
