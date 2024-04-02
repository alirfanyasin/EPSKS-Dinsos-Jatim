@extends('layouts.app')

@push('css-libraries')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>PSKS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.tksk.index') }}">Data TKSK</a></div>
                <div class="breadcrumb-item">Tambah Data</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Tambah Data TKSK</h2>
            <p class="section-lead">Tenaga Kesejahteraan Sosial Kecamatan</p>
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Data TKSK</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('app.pillar.tksk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if(auth()->user()->isDinsosJatim)
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Pilih Kantor Dinas Sosial</label>
                                        <select name="office_id" id="offices" class="form-control">
                                            <option value="" selected>Pilih Kantor Dinas Sosial</option>
                                            @foreach ($offices as $office)
                                                <option value="{{ $office->id }}">{{ $office->name }}</option>
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
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" placeholder="Masukkan Nama Lengkap" required>
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
                                    <input type="file" class="form-control @error('attachments.photo') is-invalid @enderror" name="attachments[photo]" value="" accept=".png, .jpg, .jpeg" aria-describedby="photoHelp" required>
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
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Nama Ibu Kandung</label>
                                    <input type="text" class="form-control @error('mother_name') is-invalid @enderror " name="mother_name" value="{{ old('mother_name') }}" placeholder="Masukkan Nama Ibu Kandung" required>
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
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror no_ktp" name="nik" placeholder="Masukkan NO. KTP / NIK" value="{{ old('nik') }}" required>
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
                                    <input type="text" class="form-control @error('membership_number') is-invalid @enderror membership_number" name="membership_number" placeholder="Masukkan Nomor Induk Anggota TKSK (NIAT)" value="{{ old('membership_number') }}" required>
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
                                    <input type="file" class="form-control @error('attachments.ktp') is-invalid @enderror" name="attachments[ktp]" accept=".png, .jpg, .jpeg" aria-describedby="photoKTPHelp" required>
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
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" name="place_of_birth" placeholder="Masukkan Tempat Lahir" value="{{ old('place_of_birth') }}" required>
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
                                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" placeholder="Masukkan Tanggal Lahir" value="{{ old('date_of_birth') }}" required>
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
                                        <option disabled selected>Pilih Jenis Kelamin</option>
                                        <option @if ( old('gender') == 'male' ) selected @endif value="male">Laki-Laki</option>
                                        <option @if ( old('gender') == 'female' ) selected @endif value="female">Perempuan</option>
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
                                        <option disabled selected>Pilih Kabupaten / Kota</option>
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
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <select class="form-control @error('address.district') is-invalid @enderror" id="district" name="address[district]" required>
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
                                    <label>Desa / Kelurahan</label>
                                    <select class="form-control @error('address.village') is-invalid @enderror" id="villages" name="address[village]" required>
                                    </select>
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
                                    <input type="text" class="form-control @error('address.full_address') is-invalid @enderror" name="address[full_address]" placeholder="Masukkan Alamat Lengkap" value="{{ old("address.full_address") }}" required>
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
                                    <input type="text" class="form-control @error('address.rw') is-invalid @enderror" name="address[rw]" placeholder="Masukkan RW" value="{{ old('address.rw') }}" required>
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
                                    <input type="text" class="form-control @error('address.rt') is-invalid @enderror" name="address[rt]" placeholder="Masukkan RT" value="{{ old('address.rw') }}" required>
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
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Pendidikan Terakhir</label>
                                    <select class="form-control @error('last_education') is-invalid @enderror" name="last_education" required>
                                        <option disabled selected>Pilih Pendidikan Terakhir</option>
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
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>No. Handphone / Whatsapp</label>
                                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" placeholder="Masukkan No. Handphone / Whatsapp" required>
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
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Masukkan Email">
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
                                    <input type="text" class="form-control @error('main_job') is-invalid @enderror" name="main_job" value="{{ old('main_job') }}" placeholder="Masukkan Pekerjaan Utama">
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
                                    <input type="text" class="form-control @error('year_of_appointment') is-invalid @enderror" name="year_of_appointment" value="{{ old('year_of_appointment') }}" placeholder="Massukan Tahun Pengangkatan TKSK" maxlength="4" required>
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
                                        <input type="radio" id="statusActive" name="is_active" class="custom-control-input @error('is_active') is-invalid @enderror" @if ( old('is_active') == 1 ) checked @endif value="1">
                                        <label class="custom-control-label" for="statusActive">Aktif</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="statusDie" name="is_active" class="custom-control-input @error('is_active') is-invalid @enderror" @if ( old('is_active') == 0 ) checked @endif value="0">
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
                                        <input type="radio" id="rateGood" name="annual_evaluation_grade" class="custom-control-input @error('annual_evaluation_grade') is-invalid @enderror" @if ( old('annual_evaluation_grade') == 'Baik' ) checked @endif value="Baik">
                                        <label class="custom-control-label" for="rateGood">Baik</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="rateEnough" name="annual_evaluation_grade" class="custom-control-input @error('annual_evaluation_grade') is-invalid @enderror" @if ( old('annual_evaluation_grade') == 'Cukup' ) checked @endif value="Cukup">
                                        <label class="custom-control-label" for="rateEnough">Cukup</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="rateBad" name="annual_evaluation_grade" class="custom-control-input @error('annual_evaluation_grade') is-invalid @enderror" @if ( old('annual_evaluation_grade') == 'Buruk' ) checked @endif value="Buruk">
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
                                        <option disabled selected>Pilih Kabupaten / Kota</option>
                                        @foreach ($regencies as $city)
                                            <option value="{{ $city->name }}" data-id="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
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
                                    <select class="form-control @error('duty_address.district') is-invalid @enderror" id="task-district" name="duty_address[district]" required></select>
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
                                    <input type="number" class="form-control @error('bank_accounts.bank_jatim') is-invalid @enderror" name="bank_accounts[bank_jatim]" value="{{ old('bank_accounts.bank_jatim') }}" placeholder="Masukkan No. Rekening Bank Jatim">
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
                                    <input type="number" class="form-control @error('bank_accounts.bank_bni') is-invalid @enderror" name="bank_accounts[bank_bni]" value="{{ old('bank_accounts.bank_bni') }}" placeholder="Masukkan No. Rekening Bank BNI">
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
        $('.no_ktp').mask('0000000000000000', {reverse: true});
        $('.membership_number').mask('00.00.00-0000', {reverse: true});

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
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
    </script>
@endpush

