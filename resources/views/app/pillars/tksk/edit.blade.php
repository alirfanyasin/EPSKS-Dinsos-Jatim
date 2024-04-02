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
                <div class="breadcrumb-item">Edit Data</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Data TKSK</h2>
            <p class="section-lead">Tenaga Kesejahteraan Sosial Kecamatan</p>
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="master-tab" data-toggle="tab" href="#dataMaster" role="tab" aria-controls="home" aria-selected="true">Data Master</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="training-tab" data-toggle="tab" href="#dataTraining" role="tab" aria-controls="profile" aria-selected="false">Data Pelatihan</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent2">
                        <div class="tab-pane fade show active" id="dataMaster" role="tabpanel" aria-labelledby="master-tab">
                            <form action="{{ route('app.pillar.tksk.update', $tksk->hash) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                @if(auth()->user()->isDinsosJatim)
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Pilih Kantor Dinas Sosial</label>
                                                <select name="office_id" id="offices" class="form-control">
                                                    <option value="">Pilih Kantor Dinas Sosial</option>
                                                    @foreach ($offices as $office)
                                                        <option value="{{ $office->id }}" @if($tksk->office_id === $office->id) selected @endif>{{ $office->name }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="form-text text-muted">
                                                    <li>Data akan ditambahkan di Dinas Sosial yang dipilih</li>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endif

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Masukkan Nama Lengkap" value="{{ $tksk->name }}" required="">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Pas Foto</label>
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control @error('attachments.photo') is-invalid @enderror" name="attachments[photo]" accept=".png, .jpg, .jpeg" aria-describedby="photoHelp">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#previewPhoto" type="button">Foto Saat ini</button>
                                                </div>
                                            </div>
                                            <small id="photoHelp" class="form-text text-muted">
                                                <li>Ukuran foto 3x4</li>
                                                <li>Ekstensi file harus : PNG, JPG, JPEG</li>
                                            </small>
                                            @error('attachments.photo')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="modal fade" tabindex="-1" role="dialog" id="previewPhoto">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Preview Pas Foto {{ $tksk->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <center>
                                                        <figure class="figure">
                                                            <img src="{{ $tksk->photo }}" class="figure-img img-fluid rounded" alt="...">
                                                        </figure>
                                                    </center>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Nama Ibu Kandung</label>
                                            <input type="text" class="form-control @error('mother_name') is-invalid @enderror" name="mother_name" placeholder="Masukkan Nama Ibu Kandung" value="{{ $tksk->mother_name }}" required="">
                                            @error('mother_name')
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
                                            <label>NO. KTP / NIK</label>
                                            <input type="text" class="form-control @error('nik') is-invalid @enderror no_ktp" name="nik" placeholder="Masukkan NO. KTP / NIK" value="{{ $tksk->nik }}" required="">
                                            @error('nik')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Nomor Induk Anggota TKSK (NIAT)</label>
                                            <input type="text" class="form-control @error('membership_number') is-invalid @enderror membership_number" name="membership_number" placeholder="Masukkan Nomor Induk Anggota TKSK (NIAT)" value="{{ $tksk->membership_number }}" required="">
                                            @error('membership_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Foto KTP</label>
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
                                        </div>
                                    </div>

                                    <div class="modal fade" tabindex="-1" role="dialog" id="previewPhotoKtp">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Preview Foto KTP {{ $tksk->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <center>
                                                        <figure class="figure">
                                                            <img src="{{ $tksk->photo_ktp }}" class="figure-img img-fluid rounded" alt="...">
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
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Tempat Lahir</label>
                                            <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" name="place_of_birth" placeholder="Masukkan Tempat Lahir" value="{{ $tksk->place_of_birth }}" required="">
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
                                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" placeholder="Masukkan Tanggal Lahir" value="{{ $tksk->date_of_birth }}" required="">
                                            @error('date_of_birth')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                                                <option disabled>Pilih Jenis Kelamin</option>
                                                <option @if ($tksk->gender == 'male') selected @endif value="male">Laki-Laki</option>
                                                <option @if ($tksk->gender == 'female') selected @endif value="female">Perempuan</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="section-title">Alamat</div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Kabupaten / Kota</label>
                                            <select class="form-control @error('address.regency') is-invalid @enderror" name="address[regency]" id="city" required>
                                                @foreach ($regencies as $city)
                                                    <option value="{{ $city->name }}" data-id="{{ $city->id }}" @if ($tksk->regency_address === $city->name)
                                                        selected
                                                    @endif >{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                            <small class="form-text text-muted">
                                                <li>Data saat ini : {{ $tksk->regency_address ?: 'Belum ada data' }}</li>
                                            </small>
                                            @error('address.regency')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Kecamatan</label>
                                            <select class="form-control @error('address.district') is-invalid @enderror" id="district" name="address[district]" required>
                                                <option value="{{ $tksk->district_address }}" selected>{{ $tksk->district_address }}</option>
                                            </select>
                                            <small class="form-text text-muted">
                                                <li>Data saat ini : {{ $tksk->district_address ?: 'Belum ada data' }}</li>
                                            </small>
                                            @error('address.district')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Desa / Kelurahan</label>
                                            <select class="form-control @error('address.village') is-invalid @enderror" id="villages" name="address[village]" required>
                                                <option value="{{ $tksk->village_address }}" selected>{{ $tksk->village_address }}</option>
                                            </select>
                                            <small class="form-text text-muted">
                                                <li>Data saat ini : {{ $tksk->village_address ?: 'Belum ada data' }}</li>
                                            </small>
                                            @error('address.village')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Alamat Lengkap</label>
                                            <input type="text" class="form-control @error('address.full_address') is-invalid @enderror" value="{{ $tksk->address['full_address'] }}" name="address[full_address]" placeholder="Masukkan Alamat Lengkap" required="">
                                            @error('address.full_address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>RW</label>
                                            <input type="text" class="form-control @error('address.rw') is-invalid @enderror" value="{{ $tksk->address['rw'] }}" name="address[rw]" placeholder="Masukkan RW" required="">
                                            @error('address.rw')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>RT</label>
                                            <input type="text" class="form-control @error('address.rt') is-invalid @enderror" value="{{ $tksk->address['rt'] }}" name="address[rt]" placeholder="Masukkan RT" required="">
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
                                            <label>Agama</label>
                                            <select class="form-control @error('religion') is-invalid @enderror" name="religion" required>
                                                <option disabled>Pilih Agama</option>
                                                <option @if ($tksk->religion == 'Islam') selected @endif value="Islam">Islam</option>
                                                <option @if ($tksk->religion == 'Kristen Katolik') selected @endif value="Kristen Katolik">Kristen Katolik</option>
                                                <option @if ($tksk->religion == 'Kristen Protestan') selected @endif value="Kristen Protestan">Kristen Protestan</option>
                                                <option @if ($tksk->religion == 'Hindu') selected @endif value="Hindu">Hindu</option>
                                                <option @if ($tksk->religion == 'Budha') selected @endif value="Budha">Budha</option>
                                            </select>
                                            @error('religion')
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
                                                <option disabled>Pilih Pendidikan Terakhir</option>
                                                <option value="SMA / MA / SMK / Sederajat" @if ($tksk->last_education == 'SMA / MA / SMK / Sederajat') selected @endif>SMA / MA / SMK / Sederajat</option>
                                                <option value="Diploma I / II" @if ($tksk->last_education == 'Diploma I / II') selected @endif>Diploma I/II</option>
                                                <option value="Diploma III" @if ($tksk->last_education == 'Diploma III') selected @endif>Diploma III</option>
                                                <option value="Diploma IV / S1" @if ($tksk->last_education == 'Diploma IV / S1') selected @endif>Diploma IV/S1</option>
                                                <option value="S2 / S3" @if ($tksk->last_education == 'S2 / S3') selected @endif>S2 / S3</option>
                                            </select>
                                            @error('last_education')
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
                                            <label>No. Handphone / Whatsapp</label>
                                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" placeholder="Masukkan No. Handphone / Whatsapp" value="{{ $tksk->phone_number }}" required="">
                                            @error('phone_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Masukkan Email" value="{{ $tksk->email }}">
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
                                            <label>Pekerjaan Utama</label>
                                            <input type="text" class="form-control @error('main_job') is-invalid @enderror" name="main_job" placeholder="Masukkan Pekerjaan Utama" value="{{ $tksk->main_job }}">
                                            @error('main_job')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Tahun Pengangkatan TKSK</label>
                                            <input type="text" class="form-control @error('year_of_appointment') is-invalid @enderror" name="year_of_appointment" placeholder="Masukan Tahun Pengangkatan TKSK" value="{{ $tksk->year_of_appointment }}"  required="">
                                            @error('year_of_appointment')
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
                                            <label>Status Kinerja</label>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="statusActive" @if ($tksk->is_active == 1) checked @endif name="is_active" class="custom-control-input @error('is_active') is-invalid @enderror" value="1">
                                                <label class="custom-control-label" for="statusActive">Aktif</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="statusDie" @if ($tksk->is_active == 0) checked @endif name="is_active" class="custom-control-input @error('is_active') is-invalid @enderror" value="0">
                                                <label class="custom-control-label" for="statusDie">Tidak Aktif</label>
                                            </div>
                                            @error('is_active')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Penilaian Tahunan</label>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="rateGood" @if ($tksk->annual_evaluation_grade == 'Baik') checked @endif name="annual_evaluation_grade" class="custom-control-input @error('annual_evaluation_grade') is-invalid @enderror" value="Baik">
                                                <label class="custom-control-label" for="rateGood">Baik</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="rateEnough" @if ($tksk->annual_evaluation_grade == 'Cukup') checked @endif name="annual_evaluation_grade" class="custom-control-input @error('annual_evaluation_grade') is-invalid @enderror" value="Cukup">
                                                <label class="custom-control-label" for="rateEnough">Cukup</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="rateBad" @if ($tksk->annual_evaluation_grade == 'Buruk') checked @endif name="annual_evaluation_grade" class="custom-control-input @error('annual_evaluation_grade') is-invalid @enderror" value="Buruk">
                                                <label class="custom-control-label" for="rateBad">Buruk</label>
                                            </div>
                                            @error('annual_evaluation_grade')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="section-title">Lokasi Tugas</div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Kabupaten / Kota</label>
                                            <select class="form-control @error('duty_address.regency') is-invalid @enderror" id="task-city" name="duty_address[regency]" required>
                                                @foreach ($regencies as $city)
                                                    <option value="{{ $city->name }}" data-id="{{ $city->id }}" @if ($tksk->duty_address['regency'] == $city->name)
                                                        selected
                                                    @endif>{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                            <small class="form-text text-muted">
                                                <li>Data saat ini : {{ $tksk->duty_address['regency'] }}</li>
                                            </small>
                                            @error('duty_address.regency')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Kecamatan</label>
                                            <select class="form-control @error('duty_address.district') is-invalid @enderror" id="task-district" name="duty_address[district]" required>
                                                <option value="{{ $tksk->duty_address['district'] }}" selected>{{ $tksk->duty_address['district'] }}</option>
                                            </select>
                                            <small class="form-text text-muted">
                                                <li>Data saat ini : {{ $tksk->duty_address['district'] }}</li>
                                            </small>
                                            @error('duty_address.district')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="section-title">Informasi Rekening</div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Bank Jatim</label>
                                            <input type="text" class="form-control @error('bank_accounts.bank_jatim') is-invalid @enderror" name="bank_accounts[bank_jatim]" placeholder="Masukkan No. Rekening Bank Jatim" value="{{ $tksk->bank_accounts['bank_jatim'] }}">
                                            @error('bank_accounts.bank_jatim')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Bank BNI</label>
                                            <input type="text" class="form-control @error('bank_accounts.bank_bni') is-invalid @enderror" name="bank_accounts[bank_bni]" placeholder="Masukkan No. Rekening Bank BNI" required="" value="{{ $tksk->bank_accounts['bank_bni'] }}">
                                            @error('bank_accounts.bank_bni')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <a type="button" href="{{ route('app.pillar.tksk.index') }}" class="btn btn-icon btn-danger" title="Batal">Batal</a>
                                        <button type="submit" class="btn btn-icon btn-success" title="Simpan">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="dataTraining" role="tabpanel" aria-labelledby="training-tab">
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-icon btn-success" data-toggle="modal" data-target="#modalAdd" title="Tambah Pelatihan" style="margin-bottom: 20px"><i class="fas fa-plus"></i> Tambah Data</button>

                                    <div class="modal fade" tabindex="-1" role="dialog" id="modalAdd">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tambah Data Pelatihan {{ $tksk->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('app.pillar.tksk.training.store', $tksk->hash) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label>Nama Pelatihan</label>
                                                                    <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" placeholder="Masukkan Nama Pelatihan" required="" value="{{ old('name') }}">
                                                                    @error('name')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label>Penyelenggara</label>
                                                                    <input type="text" class="form-control  @error('organizer') is-invalid @enderror" name="organizer" placeholder="Masukkan Penyelenggara Pelatihan" required="" value="{{ old('organizer') }}">
                                                                    @error('organizer')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label>Upload Sertifikat Pelatihan</label>
                                                                    <input type="file" class="form-control  @error('certificate') is-invalid @enderror" name="certificate" required="" accept=".pdf" aria-describedby="fileCertificate">
                                                                    <small id="fileCertificate" class="form-text text-muted">
                                                                        <li>Ekstensi file harus : PDF</li>
                                                                        <li>Maksimal 2MB</li>
                                                                    </small>
                                                                    @error('certificate')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer bg-whitesmoke br">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Tambah Pelatihan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-md">
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Pelatihan</th>
                                                <th>Penyelenggara</th>
                                                <th>Aksi</th>
                                            </tr>
                                            @forelse($tksk->trainings as $key =>  $training)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $training->name }}</td>
                                                    <td>{{ $training->organizer }}</td>
                                                    <td>
                                                        <div class="d-flex flex-row flex-wrap">
                                                            <button class="btn btn-sm btn-primary w-50" data-toggle="modal" data-target="#modalEdit{{ $loop->iteration }}" title="Edit">Edit Data</button>
                                                            <div class="w-100">
                                                                <form action="{{ route('app.pillar.tksk.training.delete', $training->hash) }}" class="formDelete" method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit" class="btn btn-sm btn-danger w-50 mt-2">Delete Data</button>
                                                                </form>
                                                            </div>
                                                        </div>

                                                        {{-- modal edit --}}
                                                        <div class="modal fade" tabindex="-1" role="dialog" id="modalEdit{{ $loop->iteration }}">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Data Pelatihan {{ $tksk->name }}</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form action="{{ route('app.pillar.tksk.training.update', $training->hash) }}" method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <label>Nama Pelatihan</label>
                                                                                        <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ $training->name }}" placeholder="Masukkan Nama Pelatihan" required="">
                                                                                        @error('name')
                                                                                            <div class="invalid-feedback">
                                                                                                {{ $message }}
                                                                                            </div>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <label>Penyelenggara</label>
                                                                                        <input type="text" class="form-control  @error('organizer') is-invalid @enderror" name="organizer" value="{{ $training->organizer }}" placeholder="Masukkan Penyelenggara Pelatihan" required="">
                                                                                        @error('organizer')
                                                                                            <div class="invalid-feedback">
                                                                                                {{ $message }}
                                                                                            </div>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <div class="form-group">
                                                                                        <label>Upload Sertifikat Pelatihan</label>
                                                                                        <div class="input-group mb-3">
                                                                                            <input type="file" class="form-control  @error('certificate') is-invalid @enderror" name="certificate" accept=".pdf" aria-describedby="fileCertificate">
                                                                                            <div class="input-group-append">
                                                                                                <a href="{{ asset('storage/'. $training->certificate) }}" target="_blank" class="btn btn-primary" type="button">File Saat ini</a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <small id="fileCertificate" class="form-text text-muted">
                                                                                            <li>Ekstensi file harus : PDF</li>
                                                                                            <li>Maksimal 10MB</li>
                                                                                        </small>
                                                                                        @error('certificate')
                                                                                            <div class="invalid-feedback">
                                                                                                {{ $message }}
                                                                                            </div>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer bg-whitesmoke br">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                            <button type="submit" class="btn btn-primary">Edit Pelatihan</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">Belum ada data pelatihan</td>
                                                </tr>
                                            @endforelse
                                        </table>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
@endpush

@push('script')
    <script>
        $(document).ready(function () {
            $('.no_ktp').mask('0000000000000000', {reverse: true});
            $('.membership_number').mask('00.00.00-0000', {reverse: true});

            $('#city').select2();
            $('#district').select2();
            $('#villages').select2();
            $('#task-city').select2();
            $('#task-district').select2();
            $('#offices').select2();


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

            $('#task-city').on('change', function() {
                var taksCityId = $("#task-city option:selected").data('id');

                if(taksCityId) {
                    $.ajax({
                        url: '/app/region/getDistricts/'+taksCityId,
                        type: "GET",
                        data : {"_token":"{{ csrf_token() }}"},
                        dataType: "json",
                        success:function(data)
                        {
                            if(data){
                                $('#task-district').empty();
                                $('#task-district').append('<option hidden>Pilih Kecamatan</option>');
                                $.each(data, function(key, city){
                                    $('#task-district').append('<option value="'+ city.name +'" data-id="'+ city.id +'">' + city.name+ '</option>');
                                });
                            }else{
                                $('#task-district').empty();
                            }
                        }
                    });
                }else{
                    $('#task-district').empty();
                }
            });

        });

        $('.formDelete').submit(function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>
@endpush
