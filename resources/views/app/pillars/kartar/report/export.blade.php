@extends('layouts.app')

@push('css-libraries')
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
  <style>
    .kbw-signature {
      width: 100%;
      height: 200px;
    }

    #sig canvas {
      width: 100% !important;
      height: auto;
    }

    #clear {
      margin-left: 20px
    }
  </style>
@endpush

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>PSKS</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('app.pillar.lks.report.index') }}">Data Pelaporan</a></div>
        <div class="breadcrumb-item">Export Laporan</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Export Laporan {{ auth()->user()->pillar->code }}</h2>
      <p class="section-lead">{{ auth()->user()->pillar->name }}</p>
      <div class="card">
        <div class="card-header">
          <h4>Form Export Laporan</h4>
        </div>

        <h1>{{ $data['date'] }}</h1>

        <div class="card-body">
          <form action="{{ route('app.pillar.kartar.report.export_pdf', ['name' => Auth::user()->name]) }}"
            method="POST">
            @csrf
            <input type="hidden" name="office_id" value="{{ Auth::user()->office_id }}">
            <input type="hidden" name="period" value="{{ $data['period'] }}">
            <input type="hidden" name="date" value="{{ $data['date'] }}">
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label>Nama Karang Taruna</label>
                  <input type="text" class="form-control" name="name_kartar" value="{{ auth()->user()->name }}"
                    readonly>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>No. Indetitas {{ auth()->user()->pillar->code }}</label>
                  <input type="text" class="form-control" name="no_id" value="{{ auth()->user()->nip }}" readonly>
                </div>
              </div>
            </div>
            <div class="mt-0 section-title">Lokasi Tugas</div>
            <div class="row">
              <div class="col-4">
                <div class="form-group">
                  <label>Kabupaten / Kota</label>
                  <input type="text" class="form-control" name="regency" placeholder="Masukkan Kabupaten / Kota"
                    value="{{ auth()->user()->karang_taruna->kota }}" readonly>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Kecamatan</label>
                  <input type="text" class="form-control" name="distric" placeholder="Masukkan Kecamatan"
                    value="{{ auth()->user()->karang_taruna->kecamatan }}" readonly>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Kelurahan</label>
                  <input type="text" class="form-control" name="village" placeholder="Masukkan kelurahan"
                    value="{{ auth()->user()->karang_taruna->desa }}" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="">Pilih Bulan Laporan</label>
                  <input type="month" class="form-control @error('month') is-invalid @enderror" name="month" required>
                  @error('month')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="mt-0 section-title">Karang Taruna</div>
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label>Nama Ketua Karang Taruna</label>
                  <input type="text" class="form-control" placeholder="Masukkan Nama Ketua" name="head_kartar"
                    value="{{ old('headman') }}" required>
                </div>
              </div>
            </div>
            <div class="mt-0 section-title">Desa</div>
            <div class="row">
              <div class="col-4">
                <div class="form-group">
                  <label>Nama Kepala Desa</label>
                  <input type="text" class="form-control" placeholder="Masukkan Nama Kepala Desa" name="head_village"
                    value="{{ old('head_village') }}" required>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Jabatan</label>
                  <input type="text" class="form-control" name="position_village" placeholder="Masukkan Jabatan"
                    value="{{ old('position_village') }}" required>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>NIP</label>
                  <input type="number" class="form-control" placeholder="Masukkan NIP" name="nip_village"
                    value="{{ old('nip_village') }}">
                </div>
              </div>
            </div>
            <div class="mt-0 section-title">Kabupaten / Kota</div>
            <div class="row">
              <div class="col-3">
                <div class="form-group">
                  <label>Nama Kepala Dinas</label>
                  <input type="text" class="form-control" name="head_dinas"
                    placeholder="Masukkan Nama Kepala Dinas" value="{{ old('head_dinas') }}" required>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label>Jabatan</label>
                  <input type="text" class="form-control" name="position_dinas" placeholder="Masukkan Jabatan"
                    value="{{ old('position_dinas') }}" required>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label>Pangkat Golongan</label>
                  <input type="text" class="form-control" name="class_dinas"
                    placeholder="Masukkan Pangkat Golongan"value="{{ old('class_dinas') }}" required>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label>NIP</label>
                  <input type="number" class="form-control" name="nip_dinas" placeholder="Masukkan NIP"
                    value="{{ old('nip_dinas') }}" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <a type="button" href="{{ route('app.pillar.kartar.report.index') }}" class="btn btn-icon btn-danger"
                  title="Batal">Batal</a>
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
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
@endpush

@push('script')
  <script type="text/javascript">
    var sig = $('#sig').signature({
      syncField: '#signature',
      syncFormat: 'PNG'
    });
    $('#clear').click(function(e) {
      e.preventDefault();
      sig.signature('clear');
      $("#signature").val('');
    });
  </script>
@endpush
