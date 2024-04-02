@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>PSKS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.tksk.index') }}">Data TKSK</a></div>
                <div class="breadcrumb-item">Detail Data</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Detail Data TKSK</h2>
            <p class="section-lead">Tenaga Kesejahteraan Sosial Kecamatan</p>
            <div class="card">
                <div class="card-header">
                    <h4>Detail Data TKSK</h4>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Pas Foto</label>
                                    <div class="chocolat-parent">
                                        <a href="{{ $tksk->photo ?? asset('img/example-image.jpg') }}" class="chocolat-image" title="Just an example">
                                            <div data-crop-image="285">
                                                <img alt="image" src="{{ $tksk->photo ?? asset('img/example-image.jpg') }}" class="img-fluid">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Foto KTP</label>
                                    <div class="chocolat-parent">
                                        <a href="{{ $tksk->photoKtp ?? asset('img/example-image.jpg') }}" class="chocolat-image" title="Just an example">
                                            <div data-crop-image="285">
                                                <img alt="image" src="{{ $tksk->photoKtp ?? asset('img/example-image.jpg') }}" class="img-fluid">
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
                                    <input type="text" class="form-control" name="" placeholder="Masukkan Nama Lengkap" value="{{ $tksk->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nama Ibu Kandung</label>
                                    <input type="text" class="form-control" name="" placeholder="Masukkan Nama Ibu Kandung" required="" value="{{ $tksk->mother_name }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>NO. KTP / NIK</label>
                                    <input type="text" class="form-control" name="" placeholder="Masukkan NO. KTP / NIK" required="" value="{{ $tksk->nik }}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nomor Induk Anggota TKSK (NIAT)</label>
                                    <input type="text" class="form-control" name="" placeholder="Masukkan Nomor Induk Anggota TKSK (NIAT)" required="" value="{{ $tksk->membership_number }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" class="form-control" name="" placeholder="Masukkan Tempat Lahir" required="" value="{{ $tksk->place_of_birth }}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="text" class="form-control" name="" placeholder="Masukkan Tanggal Lahir" value="{{ date('d M Y', strtotime($tksk->date_of_birth)) }}" required="" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Umur</label>
                                    <input type="text" class="form-control" name="" placeholder="Masukkan Tanggal Lahir" value="{{ $tksk->age }}" required="" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control" name="" required disabled>
                                        <option disabled selected>Pilih Jenis Kelamin</option>
                                        <option @if ($tksk->gender == 'male') selected @endif >Laki-Laki</option>
                                        <option @if ($tksk->gender == 'female') selected @endif>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="section-title">Alamat</div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Kabupaten / Kota</label>
                                    <input type="text" class="form-control" name="" value="{{ $tksk->address['regency'] }}" required="" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input type="text" class="form-control" name="" value="{{ $tksk->address['district'] }}" required="" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Desa / Kelurahan</label>
                                    <input type="text" class="form-control" name="" value="{{ $tksk->address['village'] }}" required="" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Alamat Lengkap</label>
                                    <input type="text" class="form-control" name="" value="{{ $tksk->address['full_address'] }}" required="" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>RW</label>
                                    <input type="text" class="form-control" name="" value="{{ $tksk->address['rw'] }}" required="" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>RT</label>
                                    <input type="text" class="form-control" name="" value="{{ $tksk->address['rt'] }}" required="" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Agama</label>
                                    <select class="form-control" name="" required disabled>
                                        <option disabled selected>Pilih Agama</option>
                                        <option @if ($tksk->religion == 'Islam') selected @endif>Islam</option>
                                        <option @if ($tksk->religion == 'Kristen Katolik') selected @endif>Kristen Katolik</option>
                                        <option @if ($tksk->religion == 'Kristen Protestan') selected @endif>Kristen Protestan</option>
                                        <option @if ($tksk->religion == 'Hindu') selected @endif>Hindu</option>
                                        <option @if ($tksk->religion == 'Budha') selected @endif>Budha</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Pendidikan Terakhir</label>
                                    <input type="text" class="form-control" name="" value="{{ $tksk->last_education }}" required="" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>No. Handphone / Whatsapp</label>
                                    <input type="text" class="form-control" name="" value="{{ $tksk->phone_number }}" required="" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="" value="{{ $tksk->email }}" required="" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Pekerjaan Utama</label>
                                    <input type="text" class="form-control" name="" value="{{ $tksk->main_job }}" required="" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tahun Pengangkatan TKSK</label>
                                    <input type="text" class="form-control" name="" value="{{ $tksk->year_of_appointment }}" required="" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Status Kinerja</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="statusActive" name="status" class="custom-control-input" @if ($tksk->is_active == 1) checked @endif disabled>
                                        <label class="custom-control-label" for="statusActive">Aktif</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="statusDie" name="status" class="custom-control-input" @if ($tksk->is_active == 0) checked @endif disabled>
                                        <label class="custom-control-label" for="statusDie">Tidak Aktif</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Penilaian Tahunan</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="rateGood" name="rating" class="custom-control-input" @if ($tksk->annual_evaluation_grade == 'Baik') checked @endif disabled>
                                        <label class="custom-control-label" for="rateGood">Baik</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="rateEnough" name="rating" class="custom-control-input" @if ($tksk->annual_evaluation_grade == 'Cukup') checked @endif disabled>
                                        <label class="custom-control-label" for="rateEnough">Cukup</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="rateBad" name="rating" class="custom-control-input" @if ($tksk->annual_evaluation_grade == 'Buruk') checked @endif disabled>
                                        <label class="custom-control-label" for="rateBad">Buruk</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-title">Lokasi Tugas</div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Kabupaten / Kota</label>
                                    <input type="text" class="form-control" name="" value="{{ $tksk->duty_address['regency'] }}" required="" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input type="text" class="form-control" name="" value="{{ $tksk->address['district'] }}" required="" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="section-title">Informasi Rekening</div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Bank Jatim</label>
                                    <input type="text" class="form-control" name="" value="{{ $tksk->bank_accounts['bank_jatim'] }}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Bank BNI</label>
                                    <input type="text" class="form-control" name="" value="{{ $tksk->bank_accounts['bank_bni'] }}" required="" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a type="button" href="{{ route('app.pillar.tksk.index') }}" class="btn btn-icon btn-danger" title="Kembali">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Data Pelatihan {{ $tksk->name }}</h4>
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
                            @forelse($tksk->trainings as $key => $training)
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
