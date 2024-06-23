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
        <div class="breadcrumb-item">Tambah Data</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Tambah Data ASPD</h2>
      <p class="section-lead">Asistensi Sosial Pendamping Disabilitas</p>
      <div class="card">
        <div class="card-header">
          <h4>Tambah Data ASPD</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('app.pillar.aspd.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" value="{{ auth()->user()->office_id }}" name="office_id" hidden>
            <input type="text" value="{{ auth()->user()->id }}" name="user_id" hidden>
            <div class="row">
              <div class="col-4">
                <div class="form-group">
                  <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                  <input type="text" id="name" class="form-control  @error('name') is-invalid @enderror"
                    name="name" placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}" required>
                  @error('name')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="nik">NIK <span class="text-danger">*</span></label>
                  <input type="number" name="nik" id="nik"
                    class="form-control @error('nik') is-invalid @enderror" placeholder="Masukkan NIK KTP"
                    value="{{ old('nik') }}" required>
                  @error('nik')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="phone">Nomor Telepon <span class="text-danger">*</span></label>
                  <input type="number" name="phone" id="phone"
                    class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                    placeholder="Masukkan Nomor Telepon" required>
                  @error('phone')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="identity_photo">Foto KTP <span class="text-danger">*</span></label>
                  <input type="file" name="identity_photo" id="identity_photo"
                    class="form-control @error('identity_photo') is-invalid @enderror" placeholder="Masukkan Foto KTP"
                    accept=".jpg, .png, .jpeg" required>
                  <div class="text-small">
                    <li>Ekstensi file harus : JPG, PNG, JPEG</li>
                    <li>Maksimal : 2 MB</li>
                  </div>
                  @error('identity_photo')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>


              <div class="col-4">

                <div class="form-group">
                  <label for="regency">Kabupaten / Kota <span class="text-danger">*</span></label>
                  <select name="regency" id="regency" class="form-control" required>
                    <option disabled selected>Pilih Kabupaten / Kota</option>
                    @foreach ($regencies as $regency)
                      <option value="{{ $regency->id }}">{{ $regency->name }}</option>
                    @endforeach
                  </select>
                  @error('regency')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>


              <div class="col-md-4">
                <div class="form-group">
                  <label for="address">Alamat <span class="text-danger">*</span></label>
                  <input type="text" name="address" id="address"
                    class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}"
                    placeholder="Masukkan Alamat" required>
                  @error('address')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="explanation">Keterangan (Unsur)</label>
                  <textarea name="explanation" id="explanation" style="height: 100px"
                    class="form-control @error('explanation') is-invalid @enderror"></textarea>
                  @error('explanation')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
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
