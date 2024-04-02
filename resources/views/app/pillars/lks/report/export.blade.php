@extends('layouts.app')

@push('css-libraries')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    <style>
        .kbw-signature {
            width: 100%;
            height: 200px;
        }
        #sig canvas {
            width: 100% !important;
            height: auto;
        }
        #clear{
            margin-left: 20px
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>PSKS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.lks.report.index') }}">Data Pelaporan</a></div>
                <div class="breadcrumb-item">Export Laporan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Export Laporan {{ auth()->user()->pillar->code }}</h2>
            <p class="section-lead">{{ auth()->user()->pillar->name }}</p>
            <div class="card">
                <div class="card-header">
                    <h4>Form Export Laporan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('app.pillar.lks.report.export') }}" method="POST">
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
                                    <label>No. Indetitas {{ auth()->user()->pillar->code }}</label>
                                    <input type="text" class="form-control" name="" value="{{ auth()->user()->nip }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="section-title mt-0">Lokasi Tugas</div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Kabupaten / Kota</label>
                                    <input type="text" class="form-control" name="" placeholder="Masukkan Kabupaten / Kota" value="{{ auth()->user()->lks->address['regency'] }}" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input type="text" class="form-control" name="" placeholder="Masukkan Kecamatan" value="{{ auth()->user()->lks->address['district'] }}" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <input type="text" class="form-control" name="" placeholder="Masukkan kelurahan" value="{{ auth()->user()->lks->address['village'] }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Alamat Lengkap</label>
                                    <input type="text" class="form-control" name="" value="{{ auth()->user()->lks->address['full_address'] }}" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>RW</label>
                                    <input type="text" class="form-control" name="" value="{{ auth()->user()->lks->address['rw'] }}" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>RT</label>
                                    <input type="text" class="form-control" name="" value="{{ auth()->user()->lks->address['rt'] }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Pilih Bulan Laporan</label>
                                    <input type="month" class="form-control @error('month') is-invalid @enderror" name="month" value="{{ old('month') }}" required>
                                    @error('month')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="section-title mt-0">Desa</div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Nama Kepala Desa</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Nama Kepala Desa" name="headman" value="{{ old('headman') }}" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <input type="text" class="form-control" name="position" placeholder="Masukkan Jabatan" value="{{ old('position') }}" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>NIP</label>
                                    <input type="number" class="form-control" placeholder="Masukkan NIP" name="nip" value="{{ old('nip') }}">
                                </div>
                            </div>
                        </div>
                        <div class="section-title mt-0">Kabupaten / Kota</div>
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Nama Kepala Dinas</label>
                                    <input type="text" class="form-control" name="headOfDepartement" placeholder="Masukkan Nama Kepala Dinas" value="{{ old('headOfDepartement') }}" required>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <input type="text" class="form-control" name="positionDepartement" placeholder="Masukkan Jabatan" value="{{ old('positionDepartement') }}" required>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Pangkat Golongan</label>
                                    <input type="text" class="form-control" name="grade" placeholder="Masukkan Pangkat Golongan"value="{{ old('grade') }}" required>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>NIP</label>
                                    <input type="number" class="form-control" name="nipDepartement" placeholder="Masukkan NIP" value="{{ old('nipDepartement') }}" required>
                                </div>
                            </div>
                        </div>
                            {{-- <div class="col-6">
                                <div class="form-group">
                                    <label>Tanda Tangan Pimpinan</label>
                                    <div class="d-flex">
                                        <div id="sig"></div>
                                        <button id="clear" class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                    <small class="form-text text-muted">
                                        <li>Coretan harus ditengah</li>
                                        <li>Coretan tidak boleh melebihi kotak</li>
                                    </small>
                                    <textarea id="signature" class="@error('signed') is-invalid @enderror" name="signed" style="display: none"></textarea>
                                    @error('signed')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> --}}
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
    </section>
@endsection

@push('js-libraries')
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
@endpush

@push('script')
    <script type="text/javascript">
        var sig = $('#sig').signature({syncField: '#signature', syncFormat: 'PNG'});
        $('#clear').click(function (e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature").val('');
        });
    </script>
@endpush
