@extends('layouts.app')
@push('css-libraries')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>PSKS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.tksk.index') }}">Data TKSK</a></div>
                <div class="breadcrumb-item">Import Data TKSK</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Import Data TKSK</h2>
            <p class="section-lead">Tenga Kerja Sosial Kecamatan</p>
            <div class="card">
                <div class="card-header">
                    <h4>Import Data TKSK</h4>
                    <a class="btn btn-info" href="{{ asset('dummy/FORMAT_PENDATAAN_TKSK.xlsx') }}" type="button">
                        <i class="fas fa-download"></i> Download Template CSV
                    </a>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning alert-has-icon">
                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                        <div class="alert-body">
                            <div class="alert-title">Info</div>
                            <p style="font-size: 15px">Mohon Perhatikan Persyaratan Berikut Untuk Dapat Menggunakan Fitur Import!</p>
                        </div>
                    </div>
                    <div class="section-title">Persyratan Import Data TKSK</div>
                    <div class="row">
                        <ol>
                            <li>Template yang digunakan untuk import harus sesuai dengan ketentuan, silahkan download template yang telah disediakan.</li>
                            <li>Kolom status kinerja harus sesuai dengan database, silahkan sesuaikan dengan status kinerja dibawah:
                                <ul>
                                    <li>0 = Tidak Aktif</li>
                                    <li>1 = Aktif</li>
                                </ul>
                            </li>
                            <li>Format tanggal yyyy-mm-dd</li>
                            <li>Mohon sesuikan dengan benar, jika ada kesalahan inputan berpotensi menyebabkan error pada sistem</li>
                        </ol>
                    </div>

                    <form action="{{ route('app.pillar.tksk.import.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Import Data</label>
                                    <input type="file" class="form-control" accept=".xlsx" name="attachment" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a type="button" href="{{ route('app.pillar.tksk.index') }}" class="btn btn-icon btn-danger" title="Batal">Batal</a>
                                <button type="submit" class="btn btn-icon btn-success" title="Simpan">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js-libraries')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@endpush

@push('script')
    <script>
        $(document).ready(function () {
            $('#city').select2();
            $('#subdistrict').select2();
            $('#ward').select2();
        });
    </script>
@endpush

