@extends('layouts.app')

@push('css-libraries')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
     <style>
        .required-input {
            color: red
        }
  </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>PSKS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.lks.index') }}">Data LKS</a></div>
                <div class="breadcrumb-item">Edit Data</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Data LKS</h2>
            <p class="section-lead">Lembaga Kesejahteraan Sosial</p>
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('app.pillar.lks.index') }}" class="mr-3"><i class=" fas fa-solid fa-arrow-left fa-lg"></i></a>
                    <h4>Edit Data LKS</h4>
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
                            <form action="{{ route('app.pillar.lks.update', $lks->hash) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="required-input">* Kolom Wajib Diisi</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nama Lengkap Lembaga <i class="required-input" style="font-size: 15px">*</i></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $lks->name }}" name="name" placeholder="Masukkan Nama Lengkap Lembaga" required>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Foto Tampak Depan Lembaga <i class="required-input" style="font-size: 15px">*</i></label>
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control @error('attachments.front') is-invalid @enderror" name="attachments[front]" accept=".png, .jpg, .jpeg">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#previewPhotoFront" type="button">Foto Saat Ini</button>
                                                </div>

                                                <div class="modal fade" tabindex="-1" role="dialog" id="previewPhotoFront">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Preview Foto Tampak Depan Lembaga</h5>
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
                                                                            <img src="{{ asset('storage/pillars/lks/bnba/'. $lks->attachments['front']) }}" class="figure-img img-fluid rounded" alt="...">
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
                                            <small id="photoKTPHelp" class="form-text text-muted">
                                                @if ($lks->attachments == null)
                                                    <li class="required-input">File belum diupload</li>
                                                @endif
                                                <li>Ekstensi file harus : PNG, JPG, JPEG</li>
                                            </small>

                                            @error('attachments.front')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="section-title">Lokasi Lembaga</div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Kabupaten / Kota <i class="required-input" style="font-size: 15px">*</i></label>
                                            <select class="form-control @error('address.regency') is-invalid @enderror" name="address[regency]" id="city" required>
                                                <option disabled selected>Pilih Kabupaten / Kota</option>
                                                @foreach ($regencies as $city)
                                                    <option value="{{ $city->name }}" @if ($lks->address['regency'] == $city->name) selected @endif data-id="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                                @error('address.regency')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Kecamatan <i class="required-input" style="font-size: 15px">*</i></label>
                                            <select class="form-control @error('address.district') is-invalid @enderror" name="address[district]" id="district" required>
                                                <option value="{{ $lks->address['district'] }}" selected>{{ $lks->address['district'] }}</option>
                                            </select>
                                            @error('address.district')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Desa / Kelurahan <i class="required-input" style="font-size: 15px">*</i></label>
                                            <select class="form-control @error('address.village') is-invalid @enderror" name="address[village]" id="villages" required>
                                                <option value="{{ $lks->address['village'] }}" selected>{{ $lks->address['village'] }}</option>
                                            </select>
                                            @error('address.village')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Alamat Lengkap Lembaga <i class="required-input" style="font-size: 15px">*</i></label>
                                            <input type="text" class="form-control @error('address.full_address') is-invalid @enderror" value="{{ $lks->address['full_address'] }}" name="address[full_address]" placeholder="Masukkan Alamat Lengkap Lembaga" required="">
                                            @error('address.full_address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>RW <i class="required-input" style="font-size: 15px">*</i></label>
                                            <input type="number" class="form-control @error('address.rw') is-invalid @enderror" value="{{ $lks->address['rw'] }}" name="address[rw]" placeholder="Masukkan RW" required="">
                                            @error('address.rw')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>RT <i class="required-input" style="font-size: 15px">*</i></label>
                                            <input type="text" class="form-control @error('address.rt') is-invalid @enderror" value="{{ $lks->address['rt'] }}" name="address[rt]" placeholder="Masukkan RT" required="">
                                            @error('address.rt')
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
                                            <label>Jenis Pelayanan <i class="required-input" style="font-size: 15px">*</i></label>
                                            <select class="form-control @error('services') is-invalid @enderror" id="service" name="services[]" multiple required>
                                                <option value="LKS Anak Dalam Panti" {{ in_array("LKS Anak Dalam Panti", $services) ? 'selected' : '' }} >LKS Anak Dalam Panti</option>
                                                <option value="LKS Anak Luar Panti" {{ in_array("LKS Anak Luar Panti", $services) ? 'selected' : '' }} >LKS Anak Luar Panti</option>
                                                <option value="LKS Anak yang Berhadapan dengan Hukum (ABH)" {{ in_array("LKS Anak yang Berhadapan dengan Hukum (ABH)", $services) ? 'selected' : '' }} >LKS Anak yang Berhadapan dengan Hukum (ABH)</option>
                                                <option value="LKS Disabilitas Dalam Panti" {{ in_array("LKS Disabilitas Dalam Panti", $services) ? 'selected' : '' }} >LKS Disabilitas Dalam Panti</option>
                                                <option value="LKS Disabilitas Luar Panti" {{ in_array("LKS Disabilitas Luar Panti", $services) ? 'selected' : '' }} >LKS Disabilitas Luar Panti</option>
                                                <option value="LKS Gelandangan dan Pengemis" {{ in_array("LKS Gelandangan dan Pengemis", $services) ? 'selected' : '' }} >LKS Gelandangan dan Pengemis</option>
                                                <option value="LKS Korban Penyalahgunaan NAPZA" {{ in_array("LKS Korban Penyalahgunaan NAPZA", $services) ? 'selected' : '' }} >LKS Korban Penyalahgunaan NAPZA</option>
                                                <option value="LKS Lanjut Usia Dalam Panti" {{ in_array("LKS Lanjut Usia Dalam Panti", $services) ? 'selected' : '' }} >LKS Lanjut Usia Dalam Panti</option>
                                                <option value="LKS Lanjut Usia Luar Panti" {{ in_array("LKS Lanjut Usia Luar Panti", $services) ? 'selected' : '' }} >LKS Lanjut Usia Luar Panti</option>
                                                <option value="LKS Anak Membutuhkan Perlindungan Khusus (AMPK)" {{ in_array("LKS Anak Membutuhkan Perlindungan Khusus (AMPK)", $services) ? 'selected' : '' }} >LKS Anak Membutuhkan Perlindungan Khusus (AMPK)</option>
                                                <option value="LKS Orang dengan HIV/AIDS (ODHA)" {{ in_array("LKS Orang dengan HIV/AIDS (ODHA)", $services) ? 'selected' : '' }} >LKS Orang dengan HIV/AIDS (ODHA)</option>
                                                <option value="LKS Taman Anak Sejahtera" {{ in_array("LKS Taman Anak Sejahtera", $services) ? 'selected' : '' }} > LKS Taman Anak Sejahtera</option>
                                                <option value="LKS Tuna Sosial dan Korban Perdagangan Orang" {{ in_array("LKS Tuna Sosial dan Korban Perdagangan Orang", $services) ? 'selected' : '' }} >LKS Tuna Sosial dan Korban Perdagangan Orang</option>
                                                <option value="LKS BWBP Eks Napiter" {{ in_array("LKS BWBP Eks Napiter", $services) ? 'selected' : '' }} >LKS BWBP Eks Napiter</option>
                                            </select>
                                            @error('services')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Status Kepemilikan <i class="required-input" style="font-size: 15px">*</i></label>
                                            <select class="form-control @error('owner') is-invalid @enderror" name="owner" required>
                                                <option selected disabled>Pilih Status Kepimilikan</option>
                                                <option value="Pemerintah Pusat / Kemensos" @if ($lks->owner == "Pemerintah Pusat / Kemensos") selected @endif>Pemerintah Pusat / Kemensos</option>
                                                <option value="Pemerintah Daerah / Dinas Sosial Provinsi" @if ($lks->owner == "Pemerintah Daerah / Dinas Sosial Provinsi") selected @endif>Pemerintah Daerah / Dinas Sosial Provinsi</option>
                                                <option value="Pemerintah Daerah / Dinas Sosial Kabupaten/Kota" @if ($lks->owner == "Pemerintah Daerah / Dinas Sosial Kabupaten/Kota") selected @endif>Pemerintah Daerah / Dinas Sosial Kabupaten/Kota</option>
                                                <option value="Masyarakat" @if ($lks->owner == "Masyarakat") selected @endif>Masyarakat</option>
                                            </select>
                                            @error('owner')
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
                                            <label>No. Telp Lembaga <i class="required-input" style="font-size: 15px">*</i></label>
                                            <input type="number" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $lks->phone_number }}" placeholder="Masukkan No. Telp Lembaga" required="">
                                            @error('phone_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Email Lembaga <i class="required-input" style="font-size: 15px">*</i></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $lks->email }}" placeholder="Masukkan Email Lembaga">
                                            @error('email')
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
                                            <label>Nama Lengkap Pimpinan / Ketua <i class="required-input" style="font-size: 15px">*</i></label>
                                            <input type="text" class="form-control @error('leader_name') is-invalid @enderror" value="{{ $lks->leader_name }}" name="leader_name" placeholder="Masukkan Nama Lengkap Pimpinan / Ketua" required="">
                                            @error('leader_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Upload KTP Ketua <i class="required-input" style="font-size: 15px">*</i></label>
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control @error('attachments.ktp_leader') is-invalid @enderror" name="attachments[ktp_leader]" accept=".png, .jpg, .jpeg">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#previewPhotoIdentityLeader" type="button">Foto Saat Ini</button>
                                                </div>

                                                <div class="modal fade" tabindex="-1" role="dialog" id="previewPhotoIdentityLeader">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Preview Foto KTP Pimpinan</h5>
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
                                                                            <img src="{{ asset('storage/pillars/lks/bnba/'. $lks->attachments['ktp_leader']) }}" class="figure-img img-fluid rounded" alt="...">
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
                                            <small id="photoKTPHelp" class="form-text text-muted">
                                                @if ($lks->attachments == null)
                                                    <li class="required-input">File belum diupload</li>
                                                @endif
                                                <li>Ekstensi file harus : PNG, JPG, JPEG</li>
                                            </small>
                                            @error('attachments.ktp_leader')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>No. HP Pimpinan <i class="required-input" style="font-size: 15px">*</i></label>
                                            <input type="number" class="form-control @error('phone_number_leader') is-invalid @enderror" value="{{ $lks->phone_number_leader }}" name="phone_number_leader" placeholder="Masukkan No. Telp Pimpinan Yang Mudah Dihubungi">
                                            @error('phone_number_leader')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Jumlah Klien Laki-Laki <i class="required-input" style="font-size: 15px">*</i></label>
                                            <input type="number" class="form-control @error('clients.man') is-invalid @enderror" name="clients[man]" value="{{ $lks->clients['man'] }}" placeholder="Masukkan Jumlah Klien Laki-Laki" required="">
                                            @error('clients.man')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Jumlah Klien Perempuan <i class="required-input" style="font-size: 15px">*</i></label>
                                            <input type="number" class="form-control @error('clients.girl') is-invalid @enderror" value="{{ $lks->clients['girl'] }}" name="clients[girl]" placeholder="Masukkan Jumlah Klien Perempuan" required="">
                                            @error('clients.girl')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Tahun Berdiri Lembaga <i class="required-input" style="font-size: 15px">*</i></label>
                                            <input type="number" class="form-control @error('since') is-invalid @enderror" value="{{ $lks->since }}" name="since" placeholder="Masukkan Tahun Berdiri Lembaga" required="">
                                            @error('since')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>NPWP Lembaga <i class="required-input" style="font-size: 15px">*</i></label>
                                            <input type="text" class="form-control @error('npwp') is-invalid @enderror" value="{{ $lks->npwp }}" name="npwp" placeholder="Masukkan NPWP Lembaga" required="">
                                            @error('npwp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Upload NPWP Lembaga <i class="required-input" style="font-size: 15px">*</i></label>
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control @error('attachments.npwp') is-invalid @enderror" name="attachments[npwp]" accept=".png, .jpg, .jpeg">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#previewPhotoNPWP" type="button">Foto Saat Ini</button>
                                                </div>

                                                <div class="modal fade" tabindex="-1" role="dialog" id="previewPhotoNPWP">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Preview Foto NPWP Lembaga</h5>
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
                                            <small id="photoKTPHelp" class="form-text text-muted">
                                                @if ($lks->attachments == null)
                                                    <li class="required-input">File belum diupload</li>
                                                @endif
                                                <li>Ekstensi file harus : PNG, JPG, JPEG</li>
                                            </small>
                                            @error('attachments.npwp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Upload Foto Pimpinan Lembaga <i class="required-input" style="font-size: 15px">*</i></label>
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control @error('attachments.leader_photo') is-invalid @enderror" name="attachments[leader_photo]" accept=".png, .jpg, .jpeg">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#previewPhotoLeader" type="button">Foto Saat Ini</button>
                                                </div>

                                                <div class="modal fade" tabindex="-1" role="dialog" id="previewPhotoLeader">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Preview Foto Pimpinan Lembaga</h5>
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
                                                                            <img src="{{ asset('storage/pillars/lks/bnba/'. $lks->attachments['leader_photo']) }}" class="figure-img img-fluid rounded" alt="...">
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
                                            <small id="photoKTPHelp" class="form-text text-muted">
                                                @if ($lks->attachments == null)
                                                    <li class="required-input">File belum diupload</li>
                                                @endif
                                                <li>Ekstensi file harus : PNG, JPG, JPEG</li>
                                            </small>
                                            @error('attachments.leader_photo')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Upload Foto Papan Nama Lembaga <i class="required-input" style="font-size: 15px">*</i></label>
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control @error('attachments.board') is-invalid @enderror" name="attachments[board]" accept=".png, .jpg, .jpeg">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#previewPhotoBoard" type="button">Foto Saat Ini</button>
                                                </div>

                                                <div class="modal fade" tabindex="-1" role="dialog" id="previewPhotoBoard">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Preview Foto Papan Nama Lembaga</h5>
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
                                                                            <img src="{{ asset('storage/pillars/lks/bnba/'. $lks->attachments['board']) }}" class="figure-img img-fluid rounded" alt="...">
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
                                            <small id="photoKTPHelp" class="form-text text-muted">
                                                @if ($lks->attachments == null)
                                                    <li class="required-input">File belum diupload</li>
                                                @endif
                                                <li>Ekstensi file harus : PNG, JPG, JPEG</li>
                                            </small>
                                            @error('attachments.board')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Status Kinerja <i class="required-input" style="font-size: 15px">*</i></label>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" name="is_active" class="custom-control-input @error('is_active') is-invalid @enderror" value="1" @if ( $lks->is_active == 1 ) checked @endif>
                                                <label class="custom-control-label" for="customRadio1">Aktif</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio2" name="is_active" class="custom-control-input @error('is_active') is-invalid @enderror" value="0" @if ( $lks->is_active == 0 ) checked @endif>
                                                <label class="custom-control-label" for="customRadio2">Tidak Aktif</label>
                                            </div>
                                            @error('is_active')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="section-title">Status Badan Hukum</div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Nomor SK Kemenkumham <i class="required-input" style="font-size: 15px">*</i></label>
                                            <input type="text" class="form-control @error('kemenkumham_number') is-invalid @enderror" value="{{ $lks->kemenkumham_number }}" name="kemenkumham_number" placeholder="Masukkan Nomor SK Kemenkumham" required="">
                                            @error('kemenkumham_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Tanggal SK <i class="required-input" style="font-size: 15px">*</i></label>
                                            <input type="date" class="form-control @error('sk_date') is-invalid @enderror" value="{{ $lks->sk_date }}" name="sk_date" placeholder="Masukkan Tanggal SK" required="">
                                            @error('sk_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Upload SK Kemenkumham <i class="required-input" style="font-size: 15px">*</i></label>
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control @error('attachments.sk') is-invalid @enderror" name="attachments[sk]" accept=".pdf">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#previewFileSK" type="button">File Saat Ini</button>
                                                </div>

                                                <div class="modal fade" tabindex="-1" role="dialog" id="previewFileSK">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Preview File SK Kemenkumham</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <center>
                                                                     @if ($lks->attachments == null)
                                                                        <p>File belum diupload</p>
                                                                    @else
                                                                       <embed type="application/pdf" src="{{ asset('storage/pillars/lks/bnba/'. $lks->attachments['sk']) }}" width="600" height="400"></embed>>
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
                                            <small id="photoKTPHelp" class="form-text text-muted">
                                                @if ($lks->attachments == null)
                                                    <li class="required-input">File belum diupload</li>
                                                @endif
                                                <li>Ekstensi file harus : PDF</li>
                                            </small>
                                            @error('attachments.sk')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="section-title">Akta Notaris</div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nama Notaris <i class="required-input" style="font-size: 15px">*</i></label>
                                            <input type="text" class="form-control @error('notary_name') is-invalid @enderror" value="{{ $lks->notary_name }}" name="notary_name" placeholder="Masukkan Nama Notaris" required="">
                                            @error('notary_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nomor Akta <i class="required-input" style="font-size: 15px">*</i></label>
                                            <input type="text" class="form-control @error('number_akta') is-invalid @enderror" value="{{ $lks->number_akta }}" name="number_akta" placeholder="Masukkan Nomor Akta" required="">
                                            @error('number_akta')
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
                                            <label>Tanggal Akta <i class="required-input" style="font-size: 15px">*</i></label>
                                            <input type="date" class="form-control @error('akta_date') is-invalid @enderror" value="{{ $lks->akta_date }}" name="akta_date" placeholder="Masukkan Tanggal Akta" required="">
                                            @error('akta_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Upload Akta Notaris <i class="required-input" style="font-size: 15px">*</i></label>
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control @error('attachments.akta') is-invalid @enderror" name="attachments[akta]" accept=".pdf">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#previewFileAkta" type="button">File Saat Ini</button>
                                                </div>

                                                <div class="modal fade" tabindex="-1" role="dialog" id="previewFileAkta">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Preview File Akta Notaris</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <center>
                                                                    @if ($lks->attachments == null)
                                                                        <p>File belum diupload</p>
                                                                    @else
                                                                       <embed type="application/pdf" src="{{ asset('storage/pillars/lks/bnba/'. $lks->attachments['akta']) }}" width="600" height="400"></embed>>
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
                                            <small id="photoKTPHelp" class="form-text text-muted">
                                                @if ($lks->attachments == null)
                                                    <li class="required-input">File belum diupload</li>
                                                @endif
                                                <li>Ekstensi file harus : PDF</li>
                                            </small>
                                            @error('attachments.akta')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="section-title">Surat Izin Operasional/ Surat Tanda Pendaftaran Tingkat Provinsi</div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Nomor Surat Izin</label>
                                            <input type="text" class="form-control @error('prov_siop_number') is-invalid @enderror" value="{{ $lks->prov_siop_number }}" name="prov_siop_number" placeholder="Masukkan Nomor Surat Izin">
                                            @error('prov_siop_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Tanggal STP/STPU</label>
                                            <input type="date" class="form-control @error('prov_siop_date') is-invalid @enderror" value="{{ $lks->prov_siop_date }}" name="prov_siop_date" placeholder="Masukkan Tanggal SIOP">
                                            @error('prov_siop_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Upload STP/STPU</label>
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control @error('siop_attachments.prov') is-invalid @enderror" name="siop_attachments[prov]" accept=".pdf">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#previewFileSIOPProv" type="button">File Saat Ini</button>
                                                </div>

                                                <div class="modal fade" tabindex="-1" role="dialog" id="previewFileSIOPProv">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Preview File SIOP Provinsi</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <center>
                                                                    @if ($lks->attachments == null)
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
                                            <small id="photoKTPHelp" class="form-text text-muted">
                                                <li>Ekstensi file harus : PDF</li>
                                            </small>
                                            @error('siop_attachments.prov')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="section-title">Surat Izin Operasional/ Surat Tanda Pendaftaran Tingkat Kab/kota</div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Nomor Surat Izin</label>
                                            <input type="text" class="form-control @error('regency_siop_number') is-invalid @enderror" value="{{ $lks->regency_siop_number }}" name="regency_siop_number" placeholder="Masukkan Nomor Surat Izin">
                                            @error('regency_siop_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Tanggal STP/STPU</label>
                                            <input type="date" class="form-control @error('regency_siop_date') is-invalid @enderror" value="{{ $lks->regency_siop_date }}" name="regency_siop_date" placeholder="Masukkan Tanggal SIOP">
                                            @error('regency_siop_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Upload STP/STPU</label>
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control @error('siop_attachments.regency') is-invalid @enderror" name="siop_attachments[regency]" accept=".pdf">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#previewFileSiopRegency" type="button">File Saat Ini</button>
                                                </div>

                                                <div class="modal fade" tabindex="-1" role="dialog" id="previewFileSiopRegency">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Preview File STP/STPU Kab/Kota</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <center>
                                                                    @if ($lks->attachments == null)
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
                                            <small id="photoKTPHelp" class="form-text text-muted">
                                                <li>Ekstensi file harus : PDF</li>
                                            </small>
                                            @error('siop_attachments.regency')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <a type="button" href="{{ route('app.pillar.lks.index') }}" class="btn btn-icon btn-danger" title="Batal">Batal</a>
                                        <button type="submit" class="btn btn-icon btn-success" title="Simpan">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade show" id="akreditasi" role="tabpanel" aria-labelledby="master-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header" style="display: block">
                                            <h4>Data Nilai Akreditasi Lembaga {{ $lks->name }}</h4>
                                            <button class="btn btn-success mt-2" type="button" data-toggle="modal" data-target="#modalsAddAccreditation">
                                                <i class="fas fa-plus"></i> Tambah Akreditasi
                                            </button>

                                            <div class="modal fade" tabindex="-1" role="dialog" id="modalsAddAccreditation">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Tambah Akreditasi {{ $lks->name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('app.pillar.lks.accreditation.store') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <h6 class="required-input">* Kolom Wajib Diisi</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label>Tahun Akreditasi <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <input type="text" name="hash" value="{{ $lks->hash }}" readonly hidden>
                                                                            <input type="number" class="form-control @error('assessment_year') is-invalid @enderror" name="assessment_year" placeholder="Masukkan Tahun Akreditasi" value="{{ old('assessment_year') }}" required>
                                                                            @error('assessment_year')
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
                                                                            <label>Nilai Akreditasi <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <input type="text" class="form-control @error('grade') is-invalid @enderror" name="grade" placeholder="Masukkan Nilai Akreditasi" value="{{ old('grade') }}" required>
                                                                            @error('grade')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Upload Sertifikat Akreditasi <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <input type="file" class="form-control @error('attachment') is-invalid @enderror" name="attachment" accept=".pdf" required>
                                                                            <small id="photoKTPHelp" class="form-text text-muted">
                                                                                <li>Ekstensi file harus : PDF</li>
                                                                            </small>
                                                                            @error('attachment')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer bg-whitesmoke br">
                                                                <button type="submit" class="btn btn-success">Simpan</button>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

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
                                                                    <button class="btn btn-info" title="Edit" data-toggle="modal" data-target="#modalsEditAccreditation{{ $loop->iteration }}">Edit Data</button>
                                                                    <button class="btn btn-danger" title="Hapus" data-toggle="modal" data-target="#modalsDeleteAccreditation{{ $loop->iteration }}">Hapus Data</button>

                                                                    {{-- modal edit --}}
                                                                    <div class="modal fade" tabindex="-1" role="dialog" id="modalsEditAccreditation{{ $loop->iteration }}">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Edit Akreditasi {{ $lks->name }}</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <form action="{{ route('app.pillar.lks.accreditation.update', $accreditation->hash) }}" method="POST" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    @method('PUT')
                                                                                    <div class="modal-body">
                                                                                        <div class="row">
                                                                                            <div class="col-12">
                                                                                                <div class="form-group">
                                                                                                    <label>Tahun Akreditasi</label>
                                                                                                    <input type="number" class="form-control @error('assessment_year') is-invalid @enderror" name="assessment_year" placeholder="Masukkan Tahun Akreditasi" value="{{ $accreditation->assessment_year }}">
                                                                                                    @error('assessment_year')
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
                                                                                                    <label>Nilai Akreditasi</label>
                                                                                                    <input type="text" class="form-control @error('grade') is-invalid @enderror" name="grade" placeholder="Masukkan Nilai Akreditasi" value="{{ $accreditation->grade }}">
                                                                                                    @error('grade')
                                                                                                        <div class="invalid-feedback">
                                                                                                            {{ $message }}
                                                                                                        </div>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-6">
                                                                                                <div class="form-group">
                                                                                                    <label>Upload Sertifikat Akreditasi</label>
                                                                                                    <div class="input-group mb-3">
                                                                                                        <input type="file" class="form-control @error('attachment') is-invalid @enderror" name="attachment" accept=".pdf">
                                                                                                        <div class="input-group-append">
                                                                                                            <button class="btn btn-primary" data-toggle="modal" data-target="#previewFileAccreditation" type="button">File Saat Ini</button>
                                                                                                        </div>

                                                                                                        <div class="modal fade" tabindex="-1" role="dialog" id="previewFileAccreditation">
                                                                                                            <div class="modal-dialog modal-lg" role="document">
                                                                                                                <div class="modal-content">
                                                                                                                    <div class="modal-header">
                                                                                                                        <h5 class="modal-title">Preview File Accreditation</h5>
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
                                                                                                    </div>
                                                                                                    <small id="photoKTPHelp" class="form-text text-muted">
                                                                                                        <li>Ekstensi file harus : PDF</li>
                                                                                                    </small>
                                                                                                    @error('attachment')
                                                                                                        <div class="invalid-feedback">
                                                                                                            {{ $message }}
                                                                                                        </div>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer bg-whitesmoke br">
                                                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    {{-- modal delete --}}
                                                                    <div class="modal fade" tabindex="-1" role="dialog" id="modalsDeleteAccreditation{{ $loop->iteration }}">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Hapus Akreditasi {{ $lks->name }}</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <form action="{{ route('app.pillar.lks.accreditation.destroy', $accreditation->hash) }}" method="POST" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    @method('delete')
                                                                                    <div class="modal-body">
                                                                                       <p>Apakah anda yakin ingin menghapus data akreditasi tahun {{ $accreditation->assessment_year }} ?</p>
                                                                                    </div>
                                                                                    <div class="modal-footer bg-whitesmoke br">
                                                                                        <button type="submit" class="btn btn-success">Yakin</button>
                                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                                                    </div>
                                                                                </form>
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
                                        <div class="card-header" style="display: block">
                                            <h4>Data Pengurus Lembaga {{ $lks->name }}</h4>
                                            <button class="btn btn-success mt-2" type="button" data-toggle="modal" data-target="#modalsAddManagement">
                                                <i class="fas fa-plus"></i> Tambah Pengurus
                                            </button>

                                            <div class="modal fade" tabindex="-1" role="dialog" id="modalsAddManagement">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Tambah Pengurus {{ $lks->name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('app.pillar.lks.management.store') }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <h6 class="required-input">* Kolom Wajib Diisi</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Nama Pengurus <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <input type="text" name="hash" value="{{ $lks->hash }}" readonly hidden>
                                                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Masukkan Nama Pengurus" value="{{ old('name') }}" required>
                                                                            @error('name')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>No. KTP /NIK <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <input type="number" class="form-control @error('nik') is-invalid @enderror" name="nik" placeholder="Masukkan N0. KTP / NIK" value="{{ old('nik') }}" required>
                                                                            @error('nik')
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
                                                                            <label>Jenis Kelamin <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="" required>
                                                                                <option selected disabled>Pilih Jenis Kelamin</option>
                                                                                <option value="Laki-Laki" @if ( old('gender') == 'Laki-Laki' ) selected @endif>Laki-Laki</option>
                                                                                <option value="Perempuan" @if ( old('gendedr') == 'Perempuan' ) selected @endif>Perempuan</option>
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
                                                                            <label>Agama <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <select name="religion" class="form-control @error('religion') is-invalid @enderror" id="" required>
                                                                                <option disabled selected>Pilih Agama</option>
                                                                                <option @if ( old('religion') == 'Islam' ) selected @endif value="Islam">Islam</option>
                                                                                <option @if ( old('religion') == 'Kristen Katolik' ) selected @endif value="Kristen Katolik">Kristen Katolik</option>
                                                                                <option @if ( old('religion') == 'Kristen Protestan' ) selected @endif value="Kristen Protestan">Kristen Protestan</option>
                                                                                <option @if ( old('religion') == 'Hindu' ) selected @endif value="Hindu">Hindu</option>
                                                                                <option @if ( old('religion') == 'Buddha' ) selected @endif value="Buddha">Budha</option>
                                                                            </select>
                                                                            @error('religion')
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
                                                                            <label>Tempat Lahir <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" name="place_of_birth" placeholder="Masukkan Tempat lahir" value="{{ old('place_of_birth') }}" required>
                                                                            @error('place_of_birth')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Tanggal Lahir <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                                                                            @error('date_of_birth')
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
                                                                            <label>Mulai Bekerja di LKS <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <input type="date" class="form-control @error('start_working') is-invalid @enderror" name="start_working" placeholder="Masukkan Mulai Bekerja" value="{{ old('start_working') }}" required>
                                                                            @error('start_working')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Jabatan di LKS <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <input type="text" class="form-control @error('position') is-invalid @enderror" name="position" placeholder="Masukkan Jabatan" value="{{ old('position') }}" required>
                                                                            @error('position')
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
                                                                            <label>Status Kepegawaian <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="statusActive" name="employee_status" class="custom-control-input @error('employee_status') is-invalid @enderror" @if ( old('employee_status') == "Tetap" ) checked @endif value="Tetap" required>
                                                                                <label class="custom-control-label" for="statusActive">Aktif</label>
                                                                            </div>
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="statusDie" name="employee_status" class="custom-control-input @error('employee_status') is-invalid @enderror" @if ( old('employee_status') == "Tidak Tetap" ) checked @endif value="Tidak Tetap" required>
                                                                                <label class="custom-control-label" for="statusDie">Tidak Aktif</label>
                                                                            </div>
                                                                            @error('employee_status')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Pendidikan Terakhir <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <select class="form-control @error('last_education') is-invalid @enderror" name="last_education" required>
                                                                                <option value="" disabled selected>Pilih Pendidikan Terakhir</option>
                                                                                <option @if (old('last_education') == 'SMA / MA / SMK / Sederajat' ) selected @endif value="SMA / MA / SMK / Sederajat">SMA / MA / SMK / Sederajat</option>
                                                                                <option @if ( old('last_education') == 'Diploma I / II' ) selected @endif value="Diploma I / II">Diploma I/II</option>
                                                                                <option @if ( old('last_education') == 'Diploma III' ) selected @endif value="Diploma III">Diploma III</option>
                                                                                <option @if ( old('last_education') == 'Diploma IV / S1' ) selected @endif value="Diploma IV / S1">Diploma IV/S1</option>
                                                                                <option @if ( old('last_education') == 'S2 / S3' ) selected @endif value="S2 / S3">S2 / S3</option>
                                                                            </select>
                                                                            @error('last_education')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer bg-whitesmoke br">
                                                                <button type="submit" class="btn btn-success">Simpan</button>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-md" id="management">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Nama</th>
                                                            <th>NIK</th>
                                                            <th>Jabatan</th>
                                                            <th>Jenis Kelamin</th>
                                                            <th>Status Pegawai</th>
                                                            <th>Aksi</th>
                                                            <th>Pelatihan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($managements as $key => $management)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $management->name }}</td>
                                                                <td>{{ $management->nik }}</td>
                                                                <td>{{ $management->position }}</td>
                                                                <td>{{ $management->gender }}</td>
                                                                <td>{{ $management->employee_status }}</td>
                                                                <td>
                                                                    <div class="d-flex flex-row flex-wrap">
                                                                        <button class="btn btn-sm btn-info w-100" title="Edit" data-toggle="modal" data-target="#modalsEditManagement{{ $loop->iteration }}">Edit Data</button>
                                                                        <button class="btn btn-sm btn-danger w-100 mt-2" title="Hapus" data-toggle="modal" data-target="#modalsDeleteManagement{{ $loop->iteration }}">Hapus Data</button>
                                                                    </div>

                                                                    {{-- modal edit --}}
                                                                    <div class="modal fade" tabindex="-1" role="dialog" id="modalsEditManagement{{ $loop->iteration }}">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Edit Pengurus {{ $lks->name }}</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <form action="{{ route('app.pillar.lks.management.update', $management->hash) }}" method="POST">
                                                                                    @csrf
                                                                                    @method('PUT')
                                                                                    <div class="modal-body">
                                                                                        <div class="row">
                                                                                            <div class="col-6">
                                                                                                <div class="form-group">
                                                                                                    <label>Nama Pengurus</label>
                                                                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Masukkan Nama Pengurus" value="{{ $management->name }}">
                                                                                                    @error('name')
                                                                                                        <div class="invalid-feedback">
                                                                                                            {{ $message }}
                                                                                                        </div>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-6">
                                                                                                <div class="form-group">
                                                                                                    <label>No. KTP /NIK</label>
                                                                                                    <input type="number" class="form-control @error('nik') is-invalid @enderror" name="nik" placeholder="Masukkan N0. KTP / NIK" value="{{ $management->nik }}">
                                                                                                    @error('nik')
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
                                                                                                    <label>Jenis Kelamin</label>
                                                                                                    <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="">
                                                                                                        <option selected disabled>Pilih Jenis Kelamin</option>
                                                                                                        <option value="Laki-Laki" @if ( $management->gender == 'Laki-Laki' ) selected @endif>Laki-Laki</option>
                                                                                                        <option value="Perempuan" @if ( $management->gender == 'Perempuan' ) selected @endif>Perempuan</option>
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
                                                                                                    <label>Agama</label>
                                                                                                    <select name="religion" class="form-control @error('religion') is-invalid @enderror" id="">
                                                                                                        <option disabled selected>Pilih Agama</option>
                                                                                                        <option @if ( $management->religion == 'Islam' ) selected @endif value="Islam">Islam</option>
                                                                                                        <option @if ( $management->religion == 'Kristen Katolik' ) selected @endif value="Kristen Katolik">Kristen Katolik</option>
                                                                                                        <option @if ( $management->religion == 'Kristen Protestan' ) selected @endif value="Kristen Protestan">Kristen Protestan</option>
                                                                                                        <option @if ( $management->religion == 'Hindu' ) selected @endif value="Hindu">Hindu</option>
                                                                                                        <option @if ( $management->religion == 'Buddha' ) selected @endif value="Buddha">Budha</option>
                                                                                                    </select>
                                                                                                    @error('religion')
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
                                                                                                    <label>Tempat Lahir</label>
                                                                                                    <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" name="place_of_birth" placeholder="Masukkan Tempat lahir" value="{{ $management->place_of_birth }}">
                                                                                                    @error('place_of_birth')
                                                                                                        <div class="invalid-feedback">
                                                                                                            {{ $message }}
                                                                                                        </div>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-6">
                                                                                                <div class="form-group">
                                                                                                    <label>Tanggal Lahir</label>
                                                                                                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ $management->date_of_birth }}">
                                                                                                    @error('date_of_birth')
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
                                                                                                    <label>Mulai Bekerja di LKS</label>
                                                                                                    <input type="date" class="form-control @error('start_working') is-invalid @enderror" name="start_working" placeholder="Masukkan Mulai Bekerja" value="{{ $management->start_working }}">
                                                                                                    @error('start_working')
                                                                                                        <div class="invalid-feedback">
                                                                                                            {{ $message }}
                                                                                                        </div>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-6">
                                                                                                <div class="form-group">
                                                                                                    <label>Jabatan di LKS</label>
                                                                                                    <input type="text" class="form-control @error('position') is-invalid @enderror" name="position" placeholder="Masukkan Jabatan" value="{{ $management->position }}">
                                                                                                    @error('position')
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
                                                                                                    <label>Status Kepegawaian</label>
                                                                                                    <div class="custom-control custom-radio">
                                                                                                        <input type="radio" id="statusPermanent" name="employee_status" class="custom-control-input @error('employee_status') is-invalid @enderror" @if ( $management->employee_status == "Tetap" ) checked @endif value="Tetap">
                                                                                                        <label class="custom-control-label" for="statusPermanent">Aktif</label>
                                                                                                    </div>
                                                                                                    <div class="custom-control custom-radio">
                                                                                                        <input type="radio" id="statusNotPermanent" name="employee_status" class="custom-control-input @error('employee_status') is-invalid @enderror" @if ( $management->employee_status == "Tidak Tetap" ) checked @endif value="Tidak Tetap">
                                                                                                        <label class="custom-control-label" for="statusNotPermanent">Tidak Aktif</label>
                                                                                                    </div>
                                                                                                    @error('employee_status')
                                                                                                        <div class="invalid-feedback">
                                                                                                            {{ $message }}
                                                                                                        </div>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-6">
                                                                                                <div class="form-group">
                                                                                                    <label>Pendidikan Terakhir</label>
                                                                                                    <select class="form-control @error('last_education') is-invalid @enderror" name="last_education" required>
                                                                                                        <option disabled selected>Pilih Pendidikan Terakhir</option>
                                                                                                        <option @if ($management->last_education == 'SMA / MA / SMK / Sederajat' ) selected @endif value="SMA / MA / SMK / Sederajat">SMA / MA / SMK / Sederajat</option>
                                                                                                        <option @if ( $management->last_education == 'Diploma I / II' ) selected @endif value="Diploma I / II">Diploma I/II</option>
                                                                                                        <option @if ( $management->last_education == 'Diploma III' ) selected @endif value="Diploma III">Diploma III</option>
                                                                                                        <option @if ( $management->last_education == 'Diploma IV / S1' ) selected @endif value="Diploma IV / S1">Diploma IV/S1</option>
                                                                                                        <option @if ( $management->last_education == 'S2 / S3' ) selected @endif value="S2 / S3">S2 / S3</option>
                                                                                                    </select>
                                                                                                    @error('last_education')
                                                                                                        <div class="invalid-feedback">
                                                                                                            {{ $message }}
                                                                                                        </div>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer bg-whitesmoke br">
                                                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    {{-- modal delete --}}
                                                                    <div class="modal fade" tabindex="-1" role="dialog" id="modalsDeleteManagement{{ $loop->iteration }}">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Hapus Pengurus LKS {{ $lks->name }}</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <form action="{{ route('app.pillar.lks.management.destroy', $management->hash) }}" method="POST">
                                                                                    @csrf
                                                                                    @method('delete')
                                                                                    <div class="modal-body">
                                                                                       <p>Apakah anda yakin ingin menghapus data pengurus {{ $management->name }} ?</p>
                                                                                    </div>
                                                                                    <div class="modal-footer bg-whitesmoke br">
                                                                                        <button type="submit" class="btn btn-success">Yakin</button>
                                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('app.pillar.lks.management.training.index', ['lks_hash' => $lks->hash, 'lks_management' => $management->hash]) }}" class="btn btn-sm btn-primary" title="Lihat Pelatihan">Lihat Pelatihan</a>
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
                                        <div class="card-header" style="display: block">
                                            <h4>Data Klien Lembaga {{ $lks->name }}</h4>
                                            <button class="btn btn-success mt-2" type="button" data-toggle="modal" data-target="#modalsAddClient">
                                                <i class="fas fa-plus"></i> Tambah Klien
                                            </button>

                                            <div class="modal fade" tabindex="-1" role="dialog" id="modalsAddClient">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Tambah Klien {{ $lks->name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('app.pillar.lks.client.store') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <h6 class="required-input">* Kolom Wajib Diisi</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label>Nama Klien <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <input type="text" name="hash" value="{{ $lks->hash }}" readonly hidden>
                                                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Masukkan Nama klien" value="{{ old('name') }}" required>
                                                                            @error('name')
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
                                                                            <label>No. KTP /NIK <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <input type="number" class="form-control @error('nik') is-invalid @enderror" name="nik" placeholder="Masukkan No. KTP / NIK" value="{{ old('nik') }}" required>
                                                                            @error('nik')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Upload KTP <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <input type="file" class="form-control @error('attachments.ktp') is-invalid @enderror" name="attachments[ktp]" accept=".png, .jpg, .jpeg" required>
                                                                            <small id="photoKTPHelp" class="form-text text-muted">
                                                                                <li>Ekstensi file harus : PNG, JPG, JPEG</li>
                                                                            </small>
                                                                            @error('attachments.ktp')
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
                                                                            <label>No. Kartu Keluarga (KK) <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <input type="number" class="form-control @error('family_card_number') is-invalid @enderror" name="family_card_number" placeholder="Masukkan No. KK" value="{{ old('family_card_number') }}" required>
                                                                            @error('family_card_number')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Upload Kartu Keluarga (KK) <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <input type="file" class="form-control @error('attachments.kk') is-invalid @enderror" name="attachments[kk]" accept=".png, .jpg, .jpeg" required>
                                                                            <small id="photoKTPHelp" class="form-text text-muted">
                                                                                <li>Ekstensi file harus : PNG, JPG, JPEG</li>
                                                                            </small>
                                                                            @error('attachments.kk')
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
                                                                            <label>Jenis Kelamin <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="" required>
                                                                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                                                                <option value="Laki-Laki" @if ( old('gender') == 'Laki-Laki' ) selected @endif>Laki-Laki</option>
                                                                                <option value="Perempuan" @if ( old('gendedr') == 'Perempuan' ) selected @endif>Perempuan</option>
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
                                                                            <label>Agama <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <select name="religion" class="form-control @error('religion') is-invalid @enderror" id="">
                                                                                <option value="" disabled selected>Pilih Agama</option>
                                                                                <option @if ( old('religion') == 'Islam' ) selected @endif value="Islam">Islam</option>
                                                                                <option @if ( old('religion') == 'Kristen Katolik' ) selected @endif value="Kristen Katolik">Kristen Katolik</option>
                                                                                <option @if ( old('religion') == 'Kristen Protestan' ) selected @endif value="Kristen Protestan">Kristen Protestan</option>
                                                                                <option @if ( old('religion') == 'Hindu' ) selected @endif value="Hindu">Hindu</option>
                                                                                <option @if ( old('religion') == 'Buddha' ) selected @endif value="Buddha">Budha</option>
                                                                            </select>
                                                                            @error('religion')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <div class="form-group">
                                                                            <label>Tempat Lahir <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" name="place_of_birth" placeholder="Masukkan Tempat lahir" value="{{ old('place_of_birth') }}" required>
                                                                            @error('place_of_birth')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div class="form-group">
                                                                            <label>Tanggal Lahir <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                                                                            @error('date_of_birth')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div class="form-group">
                                                                            <label>Pendidikan Terakhir <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <select class="form-control @error('last_education') is-invalid @enderror" name="last_education" required>
                                                                                <option value="" disabled selected>Pilih Pendidikan Terakhir</option>
                                                                                <option @if (old('last_education') == 'SMA / MA / SMK / Sederajat' ) selected @endif value="SMA / MA / SMK / Sederajat">SMA / MA / SMK / Sederajat</option>
                                                                                <option @if ( old('last_education') == 'Diploma I / II' ) selected @endif value="Diploma I / II">Diploma I/II</option>
                                                                                <option @if ( old('last_education') == 'Diploma III' ) selected @endif value="Diploma III">Diploma III</option>
                                                                                <option @if ( old('last_education') == 'Diploma IV / S1' ) selected @endif value="Diploma IV / S1">Diploma IV/S1</option>
                                                                                <option @if ( old('last_education') == 'S2 / S3' ) selected @endif value="S2 / S3">S2 / S3</option>
                                                                            </select>
                                                                            @error('last_education')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="section-title">Alamat</div>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Kabupaten / Kota <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <select class="form-control @error('address.regency') is-invalid @enderror" name="address[regency]" id="cityClient" required>
                                                                                <option value="" disabled selected>Pilih Kabupaten / Kota</option>
                                                                                @foreach ($regencies as $city)
                                                                                    <option value="{{ $city->name }}" data-id="{{ $city->id }}">{{ $city->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('address.regency')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Kecamatan <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <select class="form-control @error('address.district') is-invalid @enderror" id="districtClient" name="address[district]" required>
                                                                            </select>
                                                                            @error('address.district')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Desa / Kelurahan <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <select class="form-control @error('address.village') is-invalid @enderror" id="villagesClient" name="address[village]" required>
                                                                            </select>
                                                                            @error('address.village')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Alamat Lengkap <i class="required-input" style="font-size: 15px">*</i></label>
                                                                            <input type="text" class="form-control @error('address.full_address') is-invalid @enderror" name="address[full_address]" placeholder="Masukkan Alamat Lengkap" value="{{ old("address.full_address") }}" required>
                                                                            @error('address.full_address')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer bg-whitesmoke br">
                                                                <button type="submit" class="btn btn-success">Simpan</button>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-md" id="table-klien">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Nama Klien</th>
                                                            <th>NIK</th>
                                                            <th>No KK</th>
                                                            <th>Alamat</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($clients as $key => $client)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $client->name }}</td>
                                                                <td>{{ $client->nik }}</td>
                                                                <td>{{ $client->family_card_number }}</td>
                                                                <td>
                                                                    {{ $client->address['full_address'] }} , {{ $client->address['regency'] }} , {{ $client->address['district'] }} , {{ $client->address['village'] }}
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex flex-row flex-wrap">
                                                                        <button class="btn btn-sm btn-info w-100" title="Edit" data-toggle="modal" data-target="#modalsEditClient{{ $loop->iteration }}">Edit Data</button>
                                                                        <button class="btn btn-sm btn-danger w-100 mt-2" title="Hapus" data-toggle="modal" data-target="#modalsDeleteClient{{ $loop->iteration }}">Hapus Data</button>
                                                                    </div>

                                                                    {{-- modal edit --}}
                                                                    <div class="modal fade" tabindex="-1" role="dialog" id="modalsEditClient{{ $loop->iteration }}">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Edit Klien LKS {{ $lks->name }}</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <form action="{{ route('app.pillar.lks.client.update', $client->hash) }}" method="POST" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    @method('PUT')
                                                                                    <div class="modal-body">
                                                                                        <div class="row">
                                                                                            <div class="col-12">
                                                                                                <div class="form-group">
                                                                                                    <label>Nama Klien</label>
                                                                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Masukkan Nama klien" value="{{ $client->name }}">
                                                                                                    @error('name')
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
                                                                                                    <label>No. KTP /NIK</label>
                                                                                                    <input type="number" class="form-control @error('nik') is-invalid @enderror" name="nik" placeholder="Masukkan No. KTP / NIK" value="{{ $client->nik }}">
                                                                                                    @error('nik')
                                                                                                        <div class="invalid-feedback">
                                                                                                            {{ $message }}
                                                                                                        </div>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-6">
                                                                                                <div class="form-group">
                                                                                                    <label>Upload KTP</label>
                                                                                                    <div class="input-group mb-3">
                                                                                                        <input type="file" class="form-control @error('attachments.ktp') is-invalid @enderror" name="attachments[ktp]" accept=".png, .jpg, .jpeg" aria-describedby="photoKTPHelp">
                                                                                                        <div class="input-group-append">
                                                                                                            <button class="btn btn-primary" data-toggle="modal" data-target="#previewPhotoKtp" type="button">Foto Saat ini</button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <small id="photoKTPHelp" class="form-text text-muted">
                                                                                                        <li>Ekstensi file harus : PNG, JPG, JPEG</li>
                                                                                                    </small>
                                                                                                    @error('attachments.ktp')
                                                                                                        <div class="invalid-feedback">
                                                                                                            {{ $message }}
                                                                                                        </div>
                                                                                                    @enderror

                                                                                                        <div class="modal fade" tabindex="-1" role="dialog" id="previewPhotoKtp">
                                                                                                            <div class="modal-dialog modal-lg" role="document">
                                                                                                                <div class="modal-content">
                                                                                                                    <div class="modal-header">
                                                                                                                        <h5 class="modal-title">Preview Foto KTP {{ $client->name }}</h5>
                                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                                        </button>
                                                                                                                    </div>
                                                                                                                    <div class="modal-body">
                                                                                                                        <center>
                                                                                                                            <figure class="figure">
                                                                                                                                <img src="{{ asset('storage/pillars/lks/client/'. $client->attachments['ktp']) }}" class="figure-img img-fluid rounded" alt="...">
                                                                                                                            </figure>
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
                                                                                        <div class="row">
                                                                                            <div class="col-6">
                                                                                                <div class="form-group">
                                                                                                    <label>No. Kartu Keluarga (KK)</label>
                                                                                                    <input type="number" class="form-control @error('family_card_number') is-invalid @enderror" name="family_card_number" placeholder="Masukkan No. KK" value="{{ $client->family_card_number }}">
                                                                                                    @error('family_card_number')
                                                                                                        <div class="invalid-feedback">
                                                                                                            {{ $message }}
                                                                                                        </div>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-6">
                                                                                                <div class="form-group">
                                                                                                    <label>Upload Kartu Keluarga (KK)</label>
                                                                                                    <div class="input-group mb-3">
                                                                                                        <input type="file" class="form-control @error('attachments.kk') is-invalid @enderror" name="attachments[kk]" accept=".png, .jpg, .jpeg" aria-describedby="photoKTPHelp">
                                                                                                        <div class="input-group-append">
                                                                                                            <button class="btn btn-primary" data-toggle="modal" data-target="#previewPhotoKK" type="button">Foto Saat ini</button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <small id="photoKTPHelp" class="form-text text-muted">
                                                                                                        <li>Ekstensi file harus : PNG, JPG, JPEG</li>
                                                                                                    </small>
                                                                                                    @error('attachments.kk')
                                                                                                        <div class="invalid-feedback">
                                                                                                            {{ $message }}
                                                                                                        </div>
                                                                                                    @enderror

                                                                                                    <div class="modal fade" tabindex="-1" role="dialog" id="previewPhotoKK">
                                                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                                                            <div class="modal-content">
                                                                                                                <div class="modal-header">
                                                                                                                    <h5 class="modal-title">Preview Foto KK {{ $client->name }}</h5>
                                                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                                        <span aria-hidden="true">&times;</span>
                                                                                                                    </button>
                                                                                                                </div>
                                                                                                                <div class="modal-body">
                                                                                                                    <center>
                                                                                                                        <figure class="figure">
                                                                                                                            <img src="{{ asset('storage/pillars/lks/client/'. $client->attachments['kk']) }}" class="figure-img img-fluid rounded" alt="...">
                                                                                                                        </figure>
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
                                                                                        <div class="row">
                                                                                            <div class="col-6">
                                                                                                <div class="form-group">
                                                                                                    <label>Jenis Kelamin</label>
                                                                                                    <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="">
                                                                                                        <option selected disabled>Pilih Jenis Kelamin</option>
                                                                                                        <option value="Laki-Laki" @if ($client->gender == 'Laki-Laki' ) selected @endif>Laki-Laki</option>
                                                                                                        <option value="Perempuan" @if ( $client->gender == 'Perempuan' ) selected @endif>Perempuan</option>
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
                                                                                                    <label>Agama</label>
                                                                                                    <select name="religion" class="form-control @error('religion') is-invalid @enderror" id="">
                                                                                                        <option disabled selected>Pilih Agama</option>
                                                                                                        <option @if ( $client->religion == 'Islam' ) selected @endif value="Islam">Islam</option>
                                                                                                        <option @if ( $client->religion == 'Kristen Katolik' ) selected @endif value="Kristen Katolik">Kristen Katolik</option>
                                                                                                        <option @if ( $client->religion == 'Kristen Protestan' ) selected @endif value="Kristen Protestan">Kristen Protestan</option>
                                                                                                        <option @if ( $client->religion == 'Hindu' ) selected @endif value="Hindu">Hindu</option>
                                                                                                        <option @if ( $client->religion == 'Buddha' ) selected @endif value="Buddha">Budha</option>
                                                                                                    </select>
                                                                                                    @error('religion')
                                                                                                        <div class="invalid-feedback">
                                                                                                            {{ $message }}
                                                                                                        </div>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-4">
                                                                                                <div class="form-group">
                                                                                                    <label>Tempat Lahir</label>
                                                                                                    <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" name="place_of_birth" placeholder="Masukkan Tempat lahir" value="{{ $client->place_of_birth }}">
                                                                                                    @error('place_of_birth')
                                                                                                        <div class="invalid-feedback">
                                                                                                            {{ $message }}
                                                                                                        </div>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-4">
                                                                                                <div class="form-group">
                                                                                                    <label>Tanggal Lahir</label>
                                                                                                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ $client->date_of_birth }}">
                                                                                                    @error('date_of_birth')
                                                                                                        <div class="invalid-feedback">
                                                                                                            {{ $message }}
                                                                                                        </div>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-4">
                                                                                                <div class="form-group">
                                                                                                    <label>Pendidikan Terakhir</label>
                                                                                                    <select class="form-control @error('last_education') is-invalid @enderror" name="last_education" required>
                                                                                                        <option disabled selected>Pilih Pendidikan Terakhir</option>
                                                                                                        <option @if ( $client->last_education == 'SMA / MA / SMK / Sederajat' ) selected @endif value="SMA / MA / SMK / Sederajat">SMA / MA / SMK / Sederajat</option>
                                                                                                        <option @if ( $client->last_education == 'Diploma I / II' ) selected @endif value="Diploma I / II">Diploma I/II</option>
                                                                                                        <option @if ( $client->last_education == 'Diploma III' ) selected @endif value="Diploma III">Diploma III</option>
                                                                                                        <option @if ( $client->last_education == 'Diploma IV / S1' ) selected @endif value="Diploma IV / S1">Diploma IV/S1</option>
                                                                                                        <option @if ( $client->last_education == 'S2 / S3' ) selected @endif value="S2 / S3">S2 / S3</option>
                                                                                                    </select>
                                                                                                    @error('last_education')
                                                                                                        <div class="invalid-feedback">
                                                                                                            {{ $message }}
                                                                                                        </div>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="section-title">Alamat</div>
                                                                                        <div class="row">
                                                                                            <div class="col-6">
                                                                                                <div class="form-group">
                                                                                                    <label>Kabupaten / Kota</label>
                                                                                                    <select class="form-control @error('address.regency') is-invalid @enderror" name="address[regency]" id="cityClientEdit" required>
                                                                                                        <option disabled selected>Pilih Kabupaten / Kota</option>
                                                                                                        @foreach ($regencies as $city)
                                                                                                            <option value="{{ $city->name }}" data-id="{{ $city->id }}" @if ( $client->address['regency'] == $city->name ) selected @endif>{{ $city->name }}</option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                    @error('address.regency')
                                                                                                        <div class="invalid-feedback">
                                                                                                            {{ $message }}
                                                                                                        </div>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-6">
                                                                                                <div class="form-group">
                                                                                                    <label>Kecamatan</label>
                                                                                                    <select class="form-control @error('address.district') is-invalid @enderror" id="districtClientEdit" name="address[district]" required>
                                                                                                        <option value="{{ $client->address['district'] }}" selected>{{ $client->address['district'] }}</option>
                                                                                                    </select>
                                                                                                    @error('address.district')
                                                                                                        <div class="invalid-feedback">
                                                                                                            {{ $message }}
                                                                                                        </div>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-6">
                                                                                                <div class="form-group">
                                                                                                    <label>Desa / Kelurahan</label>
                                                                                                    <select class="form-control @error('address.village') is-invalid @enderror" id="villagesClientEdit" name="address[village]" required>
                                                                                                        <option value="{{ $client->address['village'] }}" selected>{{ $client->address['village'] }}</option>
                                                                                                    </select>
                                                                                                    @error('address.village')
                                                                                                        <div class="invalid-feedback">
                                                                                                            {{ $message }}
                                                                                                        </div>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-6">
                                                                                                <div class="form-group">
                                                                                                    <label>Alamat Lengkap</label>
                                                                                                    <input type="text" class="form-control @error('address.full_address') is-invalid @enderror" name="address[full_address]" placeholder="Masukkan Alamat Lengkap" value="{{ $client->address['full_address'] }}" required>
                                                                                                    @error('address.full_address')
                                                                                                        <div class="invalid-feedback">
                                                                                                            {{ $message }}
                                                                                                        </div>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer bg-whitesmoke br">
                                                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    {{-- modal delete --}}
                                                                    <div class="modal fade" tabindex="-1" role="dialog" id="modalsDeleteClient{{ $loop->iteration }}">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Hapus Klien LKS {{ $lks->name }}</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <form action="{{ route('app.pillar.lks.client.destroy', $client->hash) }}" method="POST">
                                                                                    @csrf
                                                                                    @method('delete')
                                                                                    <div class="modal-body">
                                                                                       <p>Apakah anda yakin ingin menghapus data klien {{ $client->name }} ?</p>
                                                                                    </div>
                                                                                    <div class="modal-footer bg-whitesmoke br">
                                                                                        <button type="submit" class="btn btn-success">Yakin</button>
                                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                                                    </div>
                                                                                </form>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@endpush

@push('script')
    <script>

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('#accreditation').DataTable();
            $('#management').DataTable();
            $('#table-klien').DataTable();

            $('#city').select2();
            $('#district').select2();
            $('#villages').select2();
            $('#service').select2();
            $('#cityClient').select2();
            $('#districtClient').select2();
            $('#villagesClient').select2();
            $('#cityClientEdit').select2();
            $('#districtClientEdit').select2();
            $('#villagesClientEdit').select2();


            $('#city').on('change', function() {
                var cityID = $("#city option:selected").data('id');

                if(cityID) {
                    $.ajax({
                        url: '/app/region/getDistricts/'+cityID,
                        type: "GET",
                        data : {"_token":"{{ csrf_token() }}"},
                        dataType: "json",
                        success:function(dataDistrict)
                        {
                            if(dataDistrict){
                                $('#district').empty();
                                $('#district').append('<option hidden>Pilih Kecamatan</option>');
                                $.each(dataDistrict, function(key, district){
                                    $('#district').append('<option value="'+ district.name +'" data-id="'+ district.id +'">' + district.name+ '</option>');
                                });
                            }else{
                                $('#district').empty();
                            }
                        }
                    });
                }else{
                    $('#district').empty();
                }
            });


            $('#district').on('change', function() {
                var districtID = $("#district option:selected").data('id');

                if(districtID) {
                    $.ajax({
                        url: '/app/region/getVillages/'+districtID,
                        type: "GET",
                        data : {"_token":"{{ csrf_token() }}"},
                        dataType: "json",
                        success:function(data)
                        {
                            if(data){
                                $('#villages').empty();
                                $('#villages').append('<option hidden>Pilih Kelurahan</option>');
                                $.each(data, function(key, village){
                                    $("#villages").append('<option value="'+ village.name +'">' + village.name+ '</option>');
                                });
                            }else{
                                $('#villages').empty();
                            }
                        }
                    });
                }else{
                    $('#villages').empty();
                }
            });


            $('#cityClient').on('change', function() {
                var cityID = $("#cityClient option:selected").data('id');

                if(cityID) {
                    $.ajax({
                        url: '/app/region/getDistricts/'+cityID,
                        type: "GET",
                        data : {"_token":"{{ csrf_token() }}"},
                        dataType: "json",
                        success:function(dataDistrict)
                        {
                            if(dataDistrict){
                                $('#districtClient').empty();
                                $('#districtClient').append('<option hidden>Pilih Kecamatan</option>');
                                $.each(dataDistrict, function(key, district){
                                    $('#districtClient').append('<option value="'+ district.name +'" data-id="'+ district.id +'">' + district.name+ '</option>');
                                });
                            }else{
                                $('#districtClient').empty();
                            }
                        }
                    });
                }else{
                    $('#districtClient').empty();
                }
            });


            $('#districtClient').on('change', function() {
                var districtID = $("#districtClient option:selected").data('id');

                if(districtID) {
                    $.ajax({
                        url: '/app/region/getVillages/'+districtID,
                        type: "GET",
                        data : {"_token":"{{ csrf_token() }}"},
                        dataType: "json",
                        success:function(data)
                        {
                            if(data){
                                $('#villagesClient').empty();
                                $('#villagesClient').append('<option hidden>Pilih Kelurahan</option>');
                                $.each(data, function(key, village){
                                    $("#villagesClient").append('<option value="'+ village.name +'">' + village.name+ '</option>');
                                });
                            }else{
                                $('#villagesClient').empty();
                            }
                        }
                    });
                }else{
                    $('#villagesClient').empty();
                }
            });


            $('#cityClientEdit').on('change', function() {
                var cityID = $("#cityClientEdit option:selected").data('id');

                if(cityID) {
                    $.ajax({
                        url: '/app/region/getDistricts/'+cityID,
                        type: "GET",
                        data : {"_token":"{{ csrf_token() }}"},
                        dataType: "json",
                        success:function(dataDistrict)
                        {
                            if(dataDistrict){
                                $('#districtClientEdit').empty();
                                $('#districtClientEdit').append('<option hidden>Pilih Kecamatan</option>');
                                $.each(dataDistrict, function(key, district){
                                    $('#districtClientEdit').append('<option value="'+ district.name +'" data-id="'+ district.id +'">' + district.name+ '</option>');
                                });
                            }else{
                                $('#districtClientEdit').empty();
                            }
                        }
                    });
                }else{
                    $('#districtClientEdit').empty();
                }
            });


            $('#districtClientEdit').on('change', function() {
                var districtID = $("#districtClientEdit option:selected").data('id');

                if(districtID) {
                    $.ajax({
                        url: '/app/region/getVillages/'+districtID,
                        type: "GET",
                        data : {"_token":"{{ csrf_token() }}"},
                        dataType: "json",
                        success:function(data)
                        {
                            if(data){
                                $('#villagesClientEdit').empty();
                                $('#villagesClientEdit').append('<option hidden>Pilih Kelurahan</option>');
                                $.each(data, function(key, village){
                                    $("#villagesClientEdit").append('<option value="'+ village.name +'">' + village.name+ '</option>');
                                });
                            }else{
                                $('#villagesClientEdit').empty();
                            }
                        }
                    });
                }else{
                    $('#villagesClientEdit').empty();
                }
            });
        });
    </script>
@endpush
