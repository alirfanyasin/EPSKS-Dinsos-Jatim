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
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.lks.index') }}">Data LKS</a></div>
                <div class="breadcrumb-item">Import Data LKS</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Import Data LKS</h2>
            <p class="section-lead">Lembaga Kesejahteraan Sosial</p>
            <div class="card">
                <div class="card-header">
                    <h4>Import Data LKS</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('app.pillar.lks.importBnba') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Import Data</label>
                                    <input type="file" class="form-control" name="data" accept=".xlsx" name="" required="">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
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
                    <div class="alert alert-warning alert-has-icon mt-4">
                      <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                      <div class="alert-body">
                        <div class="alert-title">Info</div>
                        <p style="font-size: 15px">Mohon Perhatikan Persyaratan Berikut Untuk Dapat Menggunakan Fitur Import!</p>
                      </div>
                    </div>
                    <div class="section-title">Persyaratan Import Data LKS</div>
                    <div class="row">
                        <ol>
                            <li>Template yang digunakan untuk import harus sesuai dengan ketentuan, silahkan download template
                                <a class="btn btn-info" href="{{ route('app.pillar.lks.exportBnba') }}" type="button">
                                    <i class="fas fa-download"></i> Download Template EXCEL
                                </a>
                            </li>
                            <li>Kolom alamat kota lembaga, alamat kecamatan lembaga, alamat desa lembaga harus sesuai dengan database, silahkan sesuaikan dengan lokasi lembaga</li>
                            <li>Kolom status kepemilikan harus sesuai dengan database, silahkan sesuaikan dengan status kepemilikan dibawah:
                                <ul>
                                    <li>Pemerintah Pusat / Kemensos</li>
                                    <li>Pemerintah Daerah / Dinas Sosial Provinsi</li>
                                    <li>Pemerintah Daerah / Dinas Sosial Kabupaten/Kota</li>
                                    <li>Masyarakat</li>
                                </ul>
                            </li>
                            <li>Atur format sel pada kolom nomor telepon lembaga dan nomor telepon pimpinan menjadi teks</li>
                            <li>Kolom status kinerja harus sesuai dengan database, silahkan sesuaikan dengan status kinerja dibawah:
                                <ul>
                                    <li>0 = Tidak Aktif</li>
                                    <li>1 = Aktif</li>
                                </ul>
                            </li>
                            <li>Atur format sel pada kolom Tanggal SK, Tanggal Akta, Tanggal STP/STPU Provinsi, dan Tanggal STP/STPU Kota menjadi teks, format tanggal yyyy-mm-dd</li>
                            <li>Mohon sesuikan dengan benar, jika ada kesalahan inputan berpotensi menyebabkan error pada sistem</li>
                        </ol>
                    </div>
                    <div class="section-title">Lokasi Lembaga</div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Kabupaten / Kota</label>
                                <select class="form-control" name="" id="city">
                                    <option disabled selected>Pilih Kabupaten / Kota</option>
                                    @foreach ($regencies as $city)
                                        <option value="{{ $city->name }}" data-id="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select class="form-control" name="" id="district">
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Desa / Kelurahan</label>
                                <select class="form-control" name="" id="villages">
                                </select>
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
@endpush

@push('script')
    <script>
        $(document).ready(function () {
            $('#city').select2();
            $('#district').select2();
            $('#villages').select2();

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
        });
    </script>
@endpush

