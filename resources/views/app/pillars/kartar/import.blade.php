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
        <div class="breadcrumb-item active"><a href="{{ route('app.pillar.tksk.index') }}">Data Karang Taruna</a></div>
        <div class="breadcrumb-item">Import Data Karang Taruna</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Import Data Karang Taruna</h2>
      <p class="section-lead">Karang Taruna</p>
      <div class="card">
        <div class="card-header">
          <h4>Import Data Karang Taruna</h4>
          <a class="btn btn-info" href="{{ asset('dummy/FORMAT_PEDATAAN_KARANG_TARUNA.xlsx') }}"
            download="FORMAT_PENDATAAN_KARANG_TARUNA.xlsx" type="button">
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
          <div class="section-title">Persyratan Import Data Karang Taruna</div>
          <div class="row">
            <ol>
              <li>Template yang digunakan untuk import harus sesuai dengan ketentuan, silahkan download template yang
                telah disediakan.</li>
              <li>Kolom klasifikasi karang taruna harus sesuai dengan database, silahkan sesuaikan dengan status kinerja
                dibawah:
                <ul>
                  <li>Tumbuh</li>
                  <li>Berkembang</li>
                  <li>Maju</li>
                  <li>Percontohan</li>
                </ul>
              </li>
              <li>Kolom status kinerja harus sesuai dengan database, silahkan sesuaikan dengan status kinerja dibawah:
                <ul>
                  <li>Aktif</li>
                  <li>Tidak Aktif</li>
                </ul>
              </li>
              <li>Format tanggal dd-mm-yyyy</li>
              <li>Mohon sesuikan dengan benar, jika ada kesalahan inputan berpotensi menyebabkan error pada sistem</li>
            </ol>
          </div>
          <form action="{{ route('app.pillar.kartar.import-excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label>Import Data</label>
                  <input type="file" class="form-control"accept=".xlsx" name="file" required="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button class="btn btn-success">Import</button>
              </div>
            </div>
          </form>
          {{-- <div class="section-title">Kode Lokasi Tugas</div> --}}
          {{-- <div class="row">
            <div class="col-4">
              <div class="form-group">
                <label>Kabupaten / Kota</label>
                <select class="form-control" name="" id="city">
                  <option disabled selected>Pilih Kecamatan</option>
                  <option>1. Surabaya</option>
                  <option>2. Gresik</option>
                </select>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label>Kecamatan</label>
                <select class="form-control" name="" id="subdistrict">
                  <option disabled selected>Pilih Kecamatan</option>
                  <option>1. Surabaya</option>
                  <option>2. Gresik</option>
                </select>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label>Desa / Kelurahan</label>
                <select class="form-control" name="" id="ward">
                  <option disabled selected>Pilih Desa / Kelurahan</option>
                  <option>1. Surabaya</option>
                  <option>2. Gresik</option>
                </select>
              </div>
            </div>
          </div> --}}
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
    $(document).ready(function() {
      $('#city').select2();
      $('#subdistrict').select2();
      $('#ward').select2();
    });
  </script>
@endpush
