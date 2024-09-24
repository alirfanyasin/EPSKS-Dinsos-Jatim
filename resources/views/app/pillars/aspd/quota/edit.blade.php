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
        <div class="breadcrumb-item active"><a href="{{ route('app.pillar.pkh.index') }}">Data Kuota ASPD</a></div>
        <div class="breadcrumb-item">Edit Kuota Data</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Edit Kuota Data ASPD</h2>
      <p class="section-lead">Asistensi Sosial Pendamping Disabilitas</p>
      <div class="card">
        <div class="card-header">
          <h4>Edit Kuota Data ASPD</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('app.pillar.aspd.quota.update', ['id' => $data->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <input type="text" value="{{ auth()->user()->office_id }}" name="office_id" hidden>
            <input type="text" value="{{ auth()->user()->id }}" name="user_id" hidden>
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="name">Nama Kota / Kabupaten <span class="text-danger">*</span></label>
                  <input type="text" id="name" class="form-control  @error('name') is-invalid @enderror"
                    name="name" placeholder="Masukkan Nama Lengkap" value="{{ $data->name }}" readonly>
                  @error('name')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="quota">Kuota <span class="text-danger">*</span></label>
                  <input type="number" name="quota" id="quota"
                    class="form-control @error('quota') is-invalid @enderror" placeholder="Masukkan quota KTP"
                    value="{{ $data->quota }}" required>
                  @error('quota')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <a type="button" href="{{ route('app.pillar.aspd.quota.index') }}" class="btn btn-icon btn-danger"
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
