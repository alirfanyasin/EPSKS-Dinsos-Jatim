@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>PSM</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.psm.profile.index') }}">Data PSM</a></div>
                <div class="breadcrumb-item">Detail Data</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Data PSM</h2>
            <p class="section-lead">Pekerja Sosial Masyarakat</p>
            <div class="card">
                <div class="card-header">
                    <h4>Detail Data PSM</h4>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Foto KTP</label>
                                    <div class="chocolat-parent">
                                        <a href="{{ $psm->photoKtp ?? asset('img/example-image.jpg') }}" class="chocolat-image" title="Just an example">
                                            <div data-crop-image="285">
                                                <img alt="image" src="{{ $psm->photoKtp ?? asset('img/example-image.jpg') }}" class="img-fluid">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Pas Foto</label>
                                        <div class="chocolat-parent">
                                            <a href="{{ $psm->photo ?? asset('img/example-image.jpg') }}" class="chocolat-image" title="Just an example">
                                                <div data-crop-image="285">
                                                    <img alt="image" src="{{ $psm->photo ?? asset('img/example-image.jpg') }}" class="img-fluid">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" class="form-control" value="{{ $psm->name }}" name="name" placeholder="Masukkan Nama Lengkap" readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nomor Induk Anggota IPSM</label>
                                        <input type="text" class="form-control" name="membership_number" placeholder="Masukkan Nomor Induk Anggota PSM (IPSM)" value="{{ $psm->membership_number }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>NO. KTP / NIK</label>
                                        <input type="text" class="form-control" name="nik" placeholder="Masukkan NO. KTP / NIK" value="{{ $psm->nik }}" readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Tempat Lahir</label>
                                        <input type="text" class="form-control" name="place_of_birth" placeholder="Masukkan Tempat Lahir" value="{{ $psm->place_of_birth }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="date_of_birth" placeholder="Masukkan Tanggal Lahir" value="{{ $psm->date_of_birth }}" readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <input type="text" class="form-control" name="" value="{{ $psm->gender === 'male' ? 'Laki-Laki' : 'Perempuan' }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Agama</label>
                                        <input type="text" class="form-control" name="" value="{{ $psm->religion }}" readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Pekerjaan Utama</label>
                                        <input type="text" class="form-control" name="main_job" value="{{ $psm->main_job }}" placeholder="Masukkan Pekerjaan Utama" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>No. Handphone / Whatsapp</label>
                                        <input type="text" class="form-control" name="phone_number" value="{{ $psm->phone_number }}" placeholder="Masukkan No. Handphone / Whatsapp" readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ $psm->email }}" placeholder="Masukkan Email" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="section-title">Alamat</div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Kabupaten / Kota</label>
                                        <input type="text" class="form-control" name="" value="{{ $psm->address['regency'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Kecamatan</label>
                                        <input type="text" class="form-control" name="" value="{{ $psm->address['district'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Desa / Kelurahan</label>
                                        <input type="text" class="form-control" name="" value="{{ $psm->address['village'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Alamat Lengkap</label>
                                        <input type="text" class="form-control" name="address[full_address]" placeholder="Masukkan Alamat Lengkap" value="{{ $psm->address['full_address'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>RW</label>
                                        <input type="text" class="form-control" name="address[rw]" placeholder="Masukkan RW" value="{{ $psm->address['rw'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>RT</label>
                                        <input type="text" class="form-control" name="address[rt]" placeholder="Masukkan RT" value="{{ $psm->address['rt'] }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="section-title">Lokasi Tugas</div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Kabupaten / Kota</label>
                                        <input type="text" class="form-control" name="" value="{{ $psm->duty_address['regency'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Kecamatan</label>
                                        <input type="text" class="form-control" name="" value="{{ $psm->duty_address['district'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Desa / Kelurahan</label>
                                        <input type="text" class="form-control" name="" value="{{ $psm->duty_address['village'] }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Pendidikan Terakhir</label>
                                        <input type="text" class="form-control" name="" value="{{ $psm->last_education }}" readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Tahun Pengangkatan PSM</label>
                                        <input type="text" class="form-control" name="year_of_appointment" value="{{ $psm->year_of_appointment }}" placeholder="Massukan Tahun Pengangkatan PSM" maxlength="4" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="section-title">Bimbingan Teknis Dasar PSM</div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>No. Sertifikat Bimtek Dasar</label>
                                        <input type="text" class="form-control" name="technical_guidance[certificate_number]" value="{{ $psm->technical_guidance['certificate_number'] }}" placeholder="Masukkan No. Sertifikat Bimtek Dasar" readonly="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Penyelenggara Bimtek Dasar</label>
                                        <input type="text" class="form-control" name="technical_guidance[organizer]" value="{{ $psm->technical_guidance['organizer'] }}" placeholder="Masukkan Penyelenggara Bimtek Dasar" readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Tanggal Sertifikat</label>
                                        <input type="date" class="form-control" name="technical_guidance[certificate_date]" value="{{ $psm->technical_guidance['certificate_date'] }}" placeholder="Masukkan Tanggal Sertifikat" readonly="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Sertifikat</label>
                                        <div class="input-group mb-3">
                                            <a href="{{ $psm->technicalGuidanceCertificatePath }}" class="btn btn-primary">File Saat ini</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Status Kinerja</label>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="statusActive" name="status" class="custom-control-input" @if ($psm->is_active == 1) checked @endif disabled>
                                            <label class="custom-control-label" for="statusActive">Aktif</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="statusDie" name="status" class="custom-control-input" @if ($psm->is_active == 0) checked @endif disabled>
                                            <label class="custom-control-label" for="statusDie">Tidak Aktif</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Data Pelatihan {{ $psm->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tr>
                                <th>No.</th>
                                <th>Nama Pelatihan</th>
                                <th>Penyelenggara</th>
                                <th>Aksi</th>
                            </tr>
                            @forelse($psm->trainings as $key => $training)
                            <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $training->name }}</td>
                                    <td>{{ $training->organizer }}</td>
                                    <td>
                                        <a href="{{ $training->certificate_path }}" class="btn btn-icon btn-primary" title="Lihat Sertifikat">Lihat Sertifikat</a>
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
    </section>
@endsection
