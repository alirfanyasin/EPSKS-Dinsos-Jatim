@extends('layouts.app')

@push('css-libraries')
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
        <div class="breadcrumb-item">Tambah Data</div>
      </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">Tambah Data LKS</h2>
        <p class="section-lead">Lembaga Kesejahteraan Sosial</p>
        <div class="card">
            <div class="card-header">
                <h4>Tambah Data LKS</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('app.pillar.lks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <h6 class="required-input">* Kolom Wajib Diisi</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nama Lengkap Lembaga <i class="required-input" style="font-size: 15px">*</i></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" name="name"
                                    placeholder="Masukkan Nama Lengkap Lembaga" required>
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
                                <input type="file"
                                    class="form-control @error('attachments.front') is-invalid @enderror"
                                    name="attachments[front]" accept=".png, .jpg, .jpeg" aria-describedby="photoKTPHelp"
                                    required>
                                <small id="photoKTPHelp" class="form-text text-muted">
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
                                <select class="form-control @error('address.regency') is-invalid @enderror"
                                    name="address[regency]" id="city" required>
                                    <option disabled selected>Pilih Kabupaten / Kota</option>
                                    @foreach ($regencies as $city)
                                        <option value="{{ $city->name }}" data-id="{{ $city->id }}">
                                            {{ $city->name }}</option>
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
                                <select class="form-control @error('address.district') is-invalid @enderror"
                                    name="address[district]" id="district" required>
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
                                <select class="form-control @error('address.village') is-invalid @enderror"
                                    name="address[village]" id="villages" required>
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
                                <input type="text"
                                    class="form-control @error('address.full_address') is-invalid @enderror"
                                    value="{{ old('address.full_address') }}" name="address[full_address]"
                                    placeholder="Masukkan Alamat Lengkap Lembaga" required="">
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
                                <input type="number" class="form-control @error('address.rw') is-invalid @enderror"
                                    value="{{ old('address.rw') }}" name="address[rw]" placeholder="Masukkan RW"
                                    required="">
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
                                <input type="number" class="form-control @error('address.rt') is-invalid @enderror"
                                    value="{{ old('address.rt') }}" name="address[rt]" placeholder="Masukkan RT"
                                    required="">
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
                                <select class="form-control @error('services') is-invalid @enderror" id="service"
                                    name="services[]" multiple required>
                                    <option value="LKS Anak Dalam Panti"
                                        @if (old('services') == 'LKS Anak Dalam Panti') selected @endif>LKS Anak Dalam Panti</option>
                                    <option value="LKS Anak Luar Panti"
                                        @if (old('services') == 'LKS Anak Luar Panti') selected @endif>LKS Anak Luar Panti</option>
                                    <option value="LKS Anak yang Berhadapan dengan Hukum (ABH)"
                                        @if (old('services') == 'LKS Anak yang Berhadapan dengan Hukum (ABH)') selected @endif>LKS Anak yang Berhadapan
                                        dengan Hukum (ABH)</option>
                                    <option value="LKS Disabilitas Dalam Panti"
                                        @if (old('services') == 'LKS Disabilitas Dalam Panti') selected @endif>LKS Disabilitas Dalam Panti
                                    </option>
                                    <option value="LKS Disabilitas Luar Panti"
                                        @if (old('services') == 'LKS Disabilitas Luar Panti') selected @endif>LKS Disabilitas Luar Panti
                                    </option>
                                    <option value="LKS Gelandangan dan Pengemis"
                                        @if (old('services') == 'LKS Gelandangan dan Pengemis') selected @endif>LKS Gelandangan dan Pengemis
                                    </option>
                                    <option value="LKS Korban Penyalahgunaan NAPZA"
                                        @if (old('services') == 'LKS Korban Penyalahgunaan NAPZA') selected @endif>LKS Korban Penyalahgunaan
                                        NAPZA</option>
                                    <option value="LKS Lanjut Usia Dalam Panti"
                                        @if (old('services') == 'LKS Lanjut Usia Dalam Panti') selected @endif>LKS Lanjut Usia Dalam Panti
                                    </option>
                                    <option value="LKS Lanjut Usia Luar Panti"
                                        @if (old('services') == 'LKS Lanjut Usia Luar Panti') selected @endif>LKS Lanjut Usia Luar Panti
                                    </option>
                                    <option value="LKS Anak Membutuhkan Perlindungan Khusus (AMPK)"
                                        @if (old('services') == 'LKS Anak Membutuhkan Perlindungan Khusus (AMPK)') selected @endif>LKS Anak Membutuhkan
                                        Perlindungan Khusus (AMPK)</option>
                                    <option value="LKS Orang dengan HIV/AIDS (ODHA)"
                                        @if (old('services') == 'LKS Orang dengan HIV/AIDS (ODHA)') selected @endif>LKS Orang dengan HIV/AIDS
                                        (ODHA)</option>
                                    <option value="LKS Taman Anak Sejahtera"
                                        @if (old('services') == 'LKS Taman Anak Sejahtera') selected @endif>LKS Taman Anak Sejahtera
                                    </option>
                                    <option value="LKS Tuna Sosial dan Korban Perdagangan Orang"
                                        @if (old('services') == 'LKS Tuna Sosial dan Korban Perdagangan Orang') selected @endif>LKS Tuna Sosial dan Korban
                                        Perdagangan Orang</option>
                                    <option value="LKS BWBP Eks Napiter"
                                        @if (old('services') == 'LKS BWBP Eks Napiter') selected @endif>LKS BWBP Eks Napiter
                                    </option>
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
                                <select class="form-control @error('owner') is-invalid @enderror" name="owner"
                                    required>
                                    <option selected disabled>Pilih Status Kepimilikan</option>
                                    <option value="Pemerintah Pusat / Kemensos"
                                        @if (old('owner') == 'Pemerintah Pusat / Kemensos') selected @endif>Pemerintah Pusat / Kemensos
                                    </option>
                                    <option value="Pemerintah Daerah / Dinas Sosial Provinsi"
                                        @if (old('owner') == 'Pemerintah Daerah / Dinas Sosial Provinsi') selected @endif>Pemerintah Daerah / Dinas
                                        Sosial Provinsi</option>
                                    <option value="Pemerintah Daerah / Dinas Sosial Kabupaten/Kota"
                                        @if (old('owner') == 'Pemerintah Daerah / Dinas Sosial Kabupaten/Kota') selected @endif>Pemerintah Daerah / Dinas
                                        Sosial Kabupaten/Kota</option>
                                    <option value="Masyarakat" @if (old('owner') == 'Masyarakat') selected @endif>
                                        Masyarakat</option>
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
                                <input type="number"
                                    class="form-control @error('phone_number') is-invalid @enderror"
                                    name="phone_number" value="{{ old('phone_number') }}"
                                    placeholder="Masukkan No. Telp Lembaga" required="">
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
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" placeholder="Masukkan Email Lembaga" required>
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
                                <input type="text" class="form-control @error('leader_name') is-invalid @enderror"
                                    value="{{ old('leader_name') }}" name="leader_name"
                                    placeholder="Masukkan Nama Lengkap Pimpinan / Ketua" required="">
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
                                <input type="file"
                                    class="form-control @error('attachments.ktp_leader') is-invalid @enderror"
                                    name="attachments[ktp_leader]" required="" accept=".png, .jpg, .jpeg"
                                    aria-describedby="photoKTPHelp">
                                <small id="photoKTPHelp" class="form-text text-muted">
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
                                <input type="number"
                                    class="form-control @error('phone_number_leader') is-invalid @enderror"
                                    value="{{ old('phone_number_leader') }}" name="phone_number_leader"
                                    placeholder="Masukkan No. Telp Pimpinan Yang Mudah Dihubungi">
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
                                <input type="number" class="form-control @error('clients.man') is-invalid @enderror"
                                    name="clients[man]" value="{{ old('clients.man') }}"
                                    placeholder="Masukkan Jumlah Klien Laki-Laki" required="">
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
                                <input type="number"
                                    class="form-control @error('clients.girl') is-invalid @enderror"
                                    value="{{ old('clients.girl') }}" name="clients[girl]"
                                    placeholder="Masukkan Jumlah Klien Perempuan" required="">
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
                                <input type="number" class="form-control @error('since') is-invalid @enderror"
                                    value="{{ old('since') }}" name="since"
                                    placeholder="Masukkan Tahun Berdiri Lembaga" required="">
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
                                <input type="text" class="form-control @error('npwp') is-invalid @enderror"
                                    value="{{ old('npwp') }}" name="npwp" placeholder="Masukkan NPWP Lembaga"
                                    required="">
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
                                <input type="file"
                                    class="form-control @error('attachments.npwp') is-invalid @enderror"
                                    name="attachments[npwp]" required="" accept=".png, .jpg, .jpeg">
                                <small id="photoKTPHelp" class="form-text text-muted">
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
                                <input type="file"
                                    class="form-control @error('attachments.leader_photo') is-invalid @enderror"
                                    name="attachments[leader_photo]" accept=".png, .jpg, .jpeg" required="">
                                <small id="photoKTPHelp" class="form-text text-muted">
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
                                <input type="file"
                                    class="form-control @error('attachments.board') is-invalid @enderror"
                                    name="attachments[board]" accept=".png, .jpg, .jpeg" required="">
                                <small id="photoKTPHelp" class="form-text text-muted">
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
                                    <input type="radio" id="customRadio1" name="is_active"
                                        class="custom-control-input @error('is_active') is-invalid @enderror"
                                        value="1" @if (old('is_active') == 1) checked @endif>
                                    <label class="custom-control-label" for="customRadio1">Aktif</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="is_active"
                                        class="custom-control-input @error('is_active') is-invalid @enderror"
                                        value="0" @if (old('is_active') == 0) checked @endif>
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
                                <input type="text"
                                    class="form-control @error('kemenkumham_number') is-invalid @enderror"
                                    value="{{ old('kemenkumham_number') }}" name="kemenkumham_number"
                                    placeholder="Masukkan Nomor SK Kemenkumham" required="">
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
                                <input type="date" class="form-control @error('sk_date') is-invalid @enderror"
                                    value="{{ old('sk_date') }}" name="sk_date" placeholder="Masukkan Tanggal SK"
                                    required="">
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
                                <input type="file"
                                    class="form-control @error('attachments.sk') is-invalid @enderror"
                                    name="attachments[sk]" accept=".pdf" required="">
                                <small id="photoKTPHelp" class="form-text text-muted">
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
                                <input type="text" class="form-control @error('notary_name') is-invalid @enderror"
                                    value="{{ old('notary_name') }}" name="notary_name"
                                    placeholder="Masukkan Nama Notaris" required="">
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
                                <input type="text" class="form-control @error('number_akta') is-invalid @enderror"
                                    value="{{ old('number_akta') }}" name="number_akta"
                                    placeholder="Masukkan Nomor Akta" required="">
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
                                <input type="date" class="form-control @error('akta_date') is-invalid @enderror"
                                    value="{{ old('akta_date') }}" name="akta_date"
                                    placeholder="Masukkan Tanggal Akta" required="">
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
                                <input type="file"
                                    class="form-control @error('attachments.akta') is-invalid @enderror"
                                    name="attachments[akta]" accept=".pdf" required="">
                                <small id="photoKTPHelp" class="form-text text-muted">
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
                                <input type="text"
                                    class="form-control @error('prov_siop_number') is-invalid @enderror"
                                    value="{{ old('prov_siop_number') }}" name="prov_siop_number"
                                    placeholder="Masukkan Nomor Surat Izin">
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
                                <input type="date"
                                    class="form-control @error('prov_siop_date') is-invalid @enderror"
                                    value="{{ old('prov_siop_date') }}" name="prov_siop_date"
                                    placeholder="Masukkan Tanggal SIOP">
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
                                <input type="file"
                                    class="form-control @error('siop_attachments.prov') is-invalid @enderror"
                                    accept=".pdf" name="siop_attachments[prov]">
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
                                <input type="text"
                                    class="form-control @error('regency_siop_number') is-invalid @enderror"
                                    value="{{ old('regency_siop_number') }}" name="regency_siop_number"
                                    placeholder="Masukkan Nomor Surat Izin">
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
                                <input type="date"
                                    class="form-control @error('regency_siop_date') is-invalid @enderror"
                                    value="{{ old('regency_siop_date') }}" name="regency_siop_date"
                                    placeholder="Masukkan Tanggal SIOP">
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
                                <input type="file"
                                    class="form-control @error('siop_attachments.regency') is-invalid @enderror"
                                    name="siop_attachments[regency]" accept=".pdf">
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
                            <a type="button" href="{{ route('app.pillar.lks.index') }}"
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
@endpush

@push('script')
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $(document).ready(function() {
      $('#city').select2();
      $('#district').select2();
      $('#villages').select2();
      $('#service').select2({
        placeholder: '  Pilih Jenis Pelayanan'
      });

      $('#city').on('change', function() {
        var cityID = $("#city option:selected").data('id');

        if (cityID) {
          $.ajax({
            url: '/app/region/getDistricts/' + cityID,
            type: "GET",
            data: {
              "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(dataDistrict) {
              if (dataDistrict) {
                $('#district').empty();
                $('#district').append(
                  '<option hidden>Pilih Kecamatan</option>');
                $.each(dataDistrict, function(key, district) {
                  $('#district').append('<option value="' + district
                    .name + '" data-id="' + district.id + '">' +
                    district.name + '</option>');
                });
              } else {
                $('#district').empty();
              }
            }
          });
        } else {
          $('#district').empty();
        }
      });


      $('#district').on('change', function() {
        var districtID = $("#district option:selected").data('id');

        if (districtID) {
          $.ajax({
            url: '/app/region/getVillages/' + districtID,
            type: "GET",
            data: {
              "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(data) {
              if (data) {
                $('#villages').empty();
                $('#villages').append(
                  '<option hidden>Pilih Kelurahan</option>');
                $.each(data, function(key, village) {
                  $("#villages").append('<option value="' + village
                    .name + '">' + village.name + '</option>');
                });
              } else {
                $('#villages').empty();
              }
            }
          });
        } else {
          $('#villages').empty();
        }
      });
    });
  </script>
@endpush
