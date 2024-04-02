@extends('layouts.app')

@push('css-libraries')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>PSKS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.lks.index') }}">Data LKS</a></div>
                <div class="breadcrumb-item">Detail Data</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Detail Data LKS</h2>
            <p class="section-lead">Lembaga Kesejahteraan Sosial</p>
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('app.pillar.lks.index') }}" class="mr-3"><i class=" fas fa-solid fa-arrow-left fa-lg"></i></a>
                    <h4>Detail Data LKS</h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="master-tab" data-toggle="tab" href="#informasi" role="tab" aria-controls="home" aria-selected="true">Informasi Dasar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="training-tab" data-toggle="tab" href="#akreditasi" role="tab" aria-controls="profile" aria-selected="false">Akreditasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="training-tab" data-toggle="tab" href="#pengurus" role="tab" aria-controls="profile" aria-selected="false">Pengurus</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="training-tab" data-toggle="tab" href="#klien" role="tab" aria-controls="profile" aria-selected="false">Klien</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent2">
                        <div class="tab-pane fade show active" id="informasi" role="tabpanel" aria-labelledby="master-tab">
                            <form action="">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Foto Tampak Depan Lembaga</label>
                                            <div class="chocolat-parent">
                                                @if ($lks->attachments == null)
                                                    <p>File belum diupload</p>
                                                @else
                                                    <a href="{{ asset('storage/pillars/lks/bnba/'. $lks->attachments['front']) }}" class="chocolat-image" title="Just an example">
                                                        <div data-crop-image="285">
                                                            <img alt="image" src="{{ asset('storage/pillars/lks/bnba/'. $lks->attachments['front']) }}" class="img-fluid">
                                                        </div>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Upload Foto Papan Nama Lembaga</label>
                                            <div class="chocolat-parent">
                                                @if ($lks->attachments == null)
                                                    <p>File belum diupload</p>
                                                @else
                                                    <a href="{{ asset('storage/pillars/lks/bnba/'. $lks->attachments['board']) }}" class="chocolat-image" title="Just an example">
                                                        <div data-crop-image="285">
                                                            <img alt="image" src="{{ asset('storage/pillars/lks/bnba/'. $lks->attachments['board']) }}" class="img-fluid">
                                                        </div>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Upload Foto Pimpinan Lembaga</label>
                                            <div class="chocolat-parent">
                                                @if ($lks->attachments == null)
                                                    <p>File belum diupload</p>
                                                @else
                                                   <a href="{{ asset('storage/pillars/lks/bnba/'. $lks->attachments['leader_photo']) }}" class="chocolat-image" title="Just an example">
                                                        <div data-crop-image="285">
                                                            <img alt="image" src="{{ asset('storage/pillars/lks/bnba/'. $lks->attachments['leader_photo']) }}" class="img-fluid">
                                                        </div>
                                                    </a>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Upload Foto KTP Pimpinan Lembaga</label>
                                            <div class="chocolat-parent">
                                                @if ($lks->attachments == null)
                                                    <p>File belum diupload</p>
                                                @else
                                                    <a href="{{ asset('storage/pillars/lks/bnba/'. $lks->attachments['ktp_leader']) }}" class="chocolat-image" title="Just an example">
                                                        <div data-crop-image="285">
                                                            <img alt="image" src="{{ asset('storage/pillars/lks/bnba/'. $lks->attachments['ktp_leader']) }}" class="img-fluid">
                                                        </div>
                                                    </a>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nama Lengkap Lembaga</label>
                                            <input type="text" class="form-control" name="" required="" value="{{ $lks->name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Jenis Pelayanan</label>
                                            @if ($lks->attachments == null)
                                                <li>Jenis pelayanan belum dipilih</li>
                                            @else
                                                @foreach ($service as $item)
                                                    <li>{{ $item->service }}</li>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="section-title">Lokasi Lembaga</div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Kabupaten / Kota</label>
                                            <input type="text" class="form-control" name="" required="" value="{{ $lks->address['regency'] }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Kecamatan</label>
                                            <input type="text" class="form-control" name="" required="" value="{{ $lks->address['district'] }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Desa / Kelurahan</label>
                                            <input type="text" class="form-control" name="" required="" value="{{ $lks->address['village'] }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Alamat Lengkap Lembaga</label>
                                            <input type="text" class="form-control" name="" required="" value="{{ $lks->address['full_address'] }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>RW</label>
                                            <input type="text" class="form-control" name="" required="" value="{{ $lks->address['rw'] }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>RT</label>
                                            <input type="text" class="form-control" name="" required="" value="{{ $lks->address['rt'] }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Status Kepemilikan</label>
                                            <input type="text" class="form-control" name="" required="" value="{{ $lks->owner }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>No. Telp Lembaga</label>
                                            <input type="number" class="form-control" name="" value="{{ $lks->phone_number }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Email Lembaga</label>
                                            <input type="email" class="form-control" name="" value="{{ $lks->email }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nama Lengkap Pimpinan / Ketua</label>
                                            <input type="text" class="form-control" name="" value="{{ $lks->leader_name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>No. HP Pimpinan</label>
                                            <input type="number" class="form-control" name="" value="{{ $lks->phone_number_leader }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Jumlah Klien Laki-Laki</label>
                                            <input type="number" class="form-control" name="" value="{{ $lks->clients['man'] }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Jumlah Klien Laki-Laki</label>
                                            <input type="number" class="form-control" name="" value="{{ $lks->clients['girl'] }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Tahun Berdiri Lembaga</label>
                                            <input type="number" class="form-control" name="" value="{{ $lks->since }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>NPWP Lembaga</label>
                                            <input type="text" class="form-control" name="" value="{{ $lks->npwp }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Upload NPWP Lembaga</label>
                                            <div class="input-group mb-3">
                                                @if ($lks->attachments == null)
                                                    <input type="text" class="form-control" value="Belum di Upload" readonly>
                                                @else
                                                    <input type="text" class="form-control" value="{{ $lks->attachments['npwp'] }}" readonly>

                                                @endif
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#previewNPWP" type="button">Lihat File</button>
                                                </div>
                                            </div>

                                            <div class="modal fade" tabindex="-1" role="dialog" id="previewNPWP">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Preview NPWP {{ $lks->name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <center>
                                                                @if ($lks->attachments == null)
                                                                    <p>File belum diupload</p>
                                                                @else
                                                                    <figure class="figure">
                                                                        <img src="{{ asset('storage/pillars/lks/bnba/'. $lks->attachments['npwp']) }}" class="figure-img img-fluid rounded" alt="...">
                                                                    </figure>
                                                                @endif

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
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Status Kinerja</label>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" @if ($lks->is_active == 1) checked @endif disabled>
                                                <label class="custom-control-label" for="customRadio1">Aktif</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" @if ($lks->is_active == 0) checked @endif  disabled>
                                                <label class="custom-control-label" for="customRadio2">Tidak Aktif</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="section-title">Status Badan Hukum</div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Nomor SK Kemenkumham</label>
                                            <input type="text" class="form-control" name="" value="{{ $lks->kemenkumham_number }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Tanggal SK</label>
                                            <input type="date" class="form-control" name="" value="{{ $lks->sk_date }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Upload SK Kemenkumham</label>
                                            <div class="input-group mb-3">
                                                @if ($lks->attachments == null)
                                                    <input type="text" class="form-control" value="Belum di Upload" readonly>
                                                @else
                                                    <input type="text" class="form-control" value="{{ $lks->attachments['sk'] }}" readonly>
                                                @endif

                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#previewFileSK" type="button">Lihat File</button>
                                                </div>

                                                <div class="modal fade" tabindex="-1" role="dialog" id="previewFileSK">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Preview Dokumen SK Kemenkumham </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <center>
                                                                    @if ($lks->attachments == null)
                                                                        <p>File belum diupload</p>
                                                                    @else
                                                                        <embed type="application/pdf" src="{{ asset('storage/pillars/lks/bnba/'. $lks->attachments['sk']) }}" width="600" height="400"></embed>
                                                                    @endif

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
                                    </div>
                                </div>
                                <div class="section-title">Akta Notaris</div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nama Notaris</label>
                                            <input type="text" class="form-control" name="" value="{{ $lks->notary_name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nomor Akta</label>
                                            <input type="text" class="form-control" name="" value="{{ $lks->number_akta }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Tanggal Akta</label>
                                            <input type="date" class="form-control" name="" value="{{ $lks->akta_date }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Upload Akta Notaris</label>
                                            <div class="input-group mb-3">
                                                @if ($lks->attachments == null)
                                                    <input type="text" class="form-control" value="" readonly>
                                                @else
                                                    <input type="text" class="form-control" value="{{ $lks->attachments['akta'] }}" readonly>
                                                @endif

                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#previewFileAkta" type="button">Lihat File</button>
                                                </div>

                                                <div class="modal fade" tabindex="-1" role="dialog" id="previewFileAkta">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Preview Dokumen Akta Notaris </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <center>
                                                                    @if ($lks->attachments == null)
                                                                        <p>File belum diupload</p>
                                                                    @else
                                                                        <embed type="application/pdf" src="{{ asset('storage/pillars/lks/bnba/'. $lks->attachments['akta']) }}" width="600" height="400"></embed>
                                                                    @endif
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
                                    </div>
                                </div>
                                <div class="section-title">Surat Izin Operasional/ Surat Tanda Pendaftaran Tingkat Provinsi</div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Nomor Surat Izin</label>
                                            <input type="text" class="form-control" name="" value="{{ $lks->prov_siop_number }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Tanggal STP/STPU</label>
                                            <input type="date" class="form-control" name="" value="{{ $lks->prov_siop_date }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Upload STP/STPU</label>
                                            <div class="input-group mb-3">
                                                @if ($lks->siop_attachments == null)
                                                    <input type="text" class="form-control" value="Belum di Upload" readonly>
                                                @else
                                                    <input type="text" class="form-control" value="{{ $lks->siop_attachments['prov'] }}" readonly>
                                                @endif

                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#previewFileSiopProv" type="button">Lihat File</button>
                                                </div>

                                                <div class="modal fade" tabindex="-1" role="dialog" id="previewFileSiopProv">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Preview Dokumen STP/STPU Provinsi </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <center>
                                                                    @if ($lks->siop_attachments == null)
                                                                        <p>File belum diupload</p>
                                                                    @else
                                                                        <embed type="application/pdf" src="{{ asset('storage/pillars/lks/bnba/'. $lks->siop_attachments['prov']) }}" width="600" height="400"></embed>
                                                                    @endif
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
                                    </div>
                                </div>
                                <div class="section-title">Surat Izin Operasional/ Surat Tanda Pendaftaran Tingkat Kab/kota</div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Nomor Surat Izin</label>
                                            <input type="text" class="form-control" name="" value="{{ $lks->regency_siop_number }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Tanggal STP/STPU</label>
                                            <input type="date" class="form-control" name="" value="{{ $lks->regency_siop_number }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Upload STP/STPU</label>
                                            <div class="input-group mb-3">
                                                @if ($lks->siop_attachments == null)
                                                    <input type="text" class="form-control" value="Belum di Upload" readonly>
                                                @else
                                                    <input type="text" class="form-control" value="{{ $lks->siop_attachments['regency'] }}" readonly>
                                                @endif

                                                <div class="input-group-append">
                                                    <button class="btn btn-primary"  data-toggle="modal" data-target="#previewFileSiopRegency" type="button">Lihat File</button>
                                                </div>
                                                <div class="modal fade" tabindex="-1" role="dialog" id="previewFileSiopRegency">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Preview Dokumen STP/STPU Kab/Kota </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <center>
                                                                    @if ($lks->siop_attachments == null)
                                                                        <p>File belum diupload</p>
                                                                    @else
                                                                        <embed type="application/pdf" src="{{ asset('storage/pillars/lks/bnba/'. $lks->siop_attachments['regency']) }}" width="600" height="400"></embed>
                                                                    @endif
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
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <a type="button" href="{{ route('app.pillar.lks.index') }}" class="btn btn-icon btn-danger" title="Kembali">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade show" id="akreditasi" role="tabpanel" aria-labelledby="master-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Data Nilai Akreditasi Lembaga {{ $lks->name }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-md" id="accreditation">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Tahun Penilaian</th>
                                                            <th>Nilai</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($accreditations as $key => $accreditation)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $accreditation->assessment_year }}</td>
                                                                <td>{{ $accreditation->grade }}</td>
                                                                <td>
                                                                    <button class="btn btn-primary" title="Lihat Sertifikat" data-toggle="modal" data-target="#previewFileAccreditation{{ $loop->iteration }}">Lihat Sertifikat</button>

                                                                    <div class="modal fade" tabindex="-1" role="dialog" id="previewFileAccreditation{{ $loop->iteration }}">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Preview File Akreditasi</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <center>
                                                                                        <embed type="application/pdf" src="{{ asset('storage/pillars/lks/accreditation/'. $accreditation->attachment) }}" width="600" height="400"></embed>
                                                                                    </center>
                                                                                </div>
                                                                                <div class="modal-footer bg-whitesmoke br">
                                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="pengurus" role="tabpanel" aria-labelledby="master-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Data Pengurus Lembaga {{ $lks->name }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-md" id="management">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Nama</th>
                                                            <th>NIK</th>
                                                            <th>Jenis Kelamin</th>
                                                            <th>Agama</th>
                                                            <th>Mulai Bekerja</th>
                                                            <th>Tempat lahir</th>
                                                            <th>Tanggal Lahir</th>
                                                            <th>Jabatan</th>
                                                            <th>Status Kepegawaian</th>
                                                            <th>Pendidikan Terakhir</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($managements as $key => $management)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $management->name }}</td>
                                                                <td>{{ $management->nik }}</td>
                                                                <td>{{ $management->gender }}</td>
                                                                <td>{{ $management->religion }}</td>
                                                                <td>{{ date('d F Y', strtotime($management->start_working)) }}</td>
                                                                <td>{{ $management->place_of_birth }}</td>
                                                                <td>{{ date('d F Y', strtotime($management->date_of_birth)) }}</td>
                                                                <td>{{ $management->position }}</td>
                                                                <td>{{ $management->employee_status }}</td>
                                                                <td>{{ $management->last_education }}</td>
                                                                <td>
                                                                    <a href="{{ route('app.pillar.lks.management.training.show', ['lks_hash' => $lks->hash, 'lks_management' => $management->hash]) }}" class="btn btn-primary">Lihat Pelatihan</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="klien" role="tabpanel" aria-labelledby="master-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Data Klien Lembaga {{ $lks->name }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-md" id="table-klien">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Nama</th>
                                                            <th>Nomor KK</th>
                                                            <th>Nomor NIK</th>
                                                            <th>Jenis Kelamin</th>
                                                            <th>Tempat Lahir</th>
                                                            <th>Tanggal Lahir</th>
                                                            <th>Agama</th>
                                                            <th>Alamat</th>
                                                            <th>Pendidikan Terakhir</th>
                                                            <th>File</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($clients as $key => $client)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $client->name }}</td>
                                                                <td>{{ $client->family_card_number }}</td>
                                                                <td>{{ $client->nik }}</td>
                                                                <td>{{ $client->gender }}</td>
                                                                <td>{{ $client->place_of_birth }}</td>
                                                                <td>{{ date('d F Y', strtotime($client->date_of_birth)) }}</td>
                                                                <td>{{ $client->religion }}</td>
                                                                <td>
                                                                    {{ $client->address['full_address'] }}, {{ $client->address['village'] }}, {{ $client->address['district'] }}, {{ $client->address['regency'] }}
                                                                </td>
                                                                <td>{{ $client->last_education }}</td>
                                                                <td width="100px">
                                                                    <div class="d-flex flex-row flex-wrap">
                                                                        <button class="btn btn-sm btn-primary w-100" data-toggle="modal" data-target="#previewFileKK{{ $loop->iteration }}">File KK</button>
                                                                        <div class="w-100">
                                                                            <button type="button" class="btn btn-sm btn-info w-100 mt-2" data-toggle="modal" data-target="#previewFileKTP{{ $loop->iteration }}">File KTP</button>
                                                                        </div>
                                                                    </div>

                                                                    {{-- modal preview file kk --}}
                                                                    <div class="modal fade" tabindex="-1" role="dialog" id="previewFileKK{{ $loop->iteration }}">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Preview File KK</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <figure class="figure">
                                                                                        <img src="{{ asset('storage/pillars/lks/client/'. $client->attachments['kk']) }}" class="figure-img img-fluid rounded" alt="...">
                                                                                    </figure>
                                                                                </div>
                                                                                <div class="modal-footer bg-whitesmoke br">
                                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    {{-- modal preview file ktp --}}
                                                                    <div class="modal fade" tabindex="-1" role="dialog" id="previewFileKTP{{ $loop->iteration }}">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Preview File KTP</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <figure class="figure">
                                                                                        <img src="{{ asset('storage/pillars/lks/client/'. $client->attachments['ktp']) }}" class="figure-img img-fluid rounded" alt="...">
                                                                                    </figure>
                                                                                </div>
                                                                                <div class="modal-footer bg-whitesmoke br">
                                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js-libraries')
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
@endpush

@push('script')
    <script>
        $(document).ready(function () {
            $('#accreditation').DataTable();
            $('#management').DataTable();
            $('#table-klien').DataTable();
        });
    </script>
@endpush
