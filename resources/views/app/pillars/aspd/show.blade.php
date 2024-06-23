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
        <div class="breadcrumb-item active"><a href="{{ route('app.pillar.pkh.index') }}">Data ASPD</a></div>
        <div class="breadcrumb-item">Detail Data</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Detail Data ASPD</h2>
      <p class="section-lead">Asistensi Sosial Pendamping Disabilitas</p>
      <div class="card">
        <div class="card-header">
          <h4>Detail Data ASPD</h4>
        </div>
        <div class="card-body">
          <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" value="{{ auth()->user()->office_id }}" name="office_id" hidden>
            <input type="text" value="{{ auth()->user()->id }}" name="user_id" hidden>
            <div class="row">
              <div class="col-4">
                <div class="form-group">
                  <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                  <input type="text" id="name" class="form-control" name="name"
                    placeholder="Masukkan Nama Lengkap" value="{{ $data->aspd->name }}" readonly>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="nik">NIK <span class="text-danger">*</span></label>
                  <input type="number" name="nik" id="nik" class="form-control" placeholder="Masukkan NIK KTP"
                    value="{{ $data->aspd->nik }}" readonly>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="phone">Nomor Telepon <span class="text-danger">*</span></label>
                  <input type="number" name="phone" id="phone" class="form-control"
                    value="{{ $data->aspd->phone }}" placeholder="Masukkan Nomor Telepon" readonly>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="identity_photo">Foto KTP <span class="text-danger">*</span></label>
                  <a href="{{ asset('storage/image/pillars/ASPD/profile/KTP/' . $data->aspd->identity_photo) }}"
                    target="_blank" class="btn btn-primary d-block">Lihat Foto KTP</a>
                </div>
              </div>


              <div class="col-4">

                <div class="form-group">
                  <label for="regency">Kabupaten / Kota <span class="text-danger">*</span></label>
                  <input type="text" name="regency" id="regency" class="form-control"
                    placeholder="Masukkan Kabupaten / Kota" value="{{ $data->aspdQuota->name }}" readonly>
                </div>
              </div>


              <div class="col-md-4">
                <div class="form-group">
                  <label for="address">Alamat <span class="text-danger">*</span></label>
                  <input type="text" name="address" id="address" class="form-control"
                    value="{{ $data->aspd->address }}" placeholder="Masukkan Alamat" readonly>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="explanation">Keterangan (Unsur)</label>
                  <textarea name="explanation" id="explanation" style="height: 100px" class="form-control" disabled>{{ $data->aspd->explanation }}</textarea>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <a type="button" href="{{ route('app.pillar.aspd.index') }}" class="btn btn-icon btn-danger"
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
@endpush
