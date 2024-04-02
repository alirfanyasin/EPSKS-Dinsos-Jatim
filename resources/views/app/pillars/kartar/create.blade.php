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
        <div class="breadcrumb-item active"><a href="{{ route('app.pillar.kartar.index') }}">Data Karang
            Taruna</a></div>
        <div class="breadcrumb-item">Tambah Data</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Tambah Data Karang Taruna</h2>
      <p class="section-lead">Karang Taruna</p>
      <div class="card">
        <div class="card-header">
          <h4>Tambah Data Karang Taruna</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('app.pillar.kartar.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" value="{{ auth()->user()->office_id }}" name="office_id" hidden>
            <div class="row">
              <div class="col-4">
                <div class="form-group">
                  <label>Nama Karang Taruna <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('nama_kartar') is-invalid @enderror" name="nama_kartar"
                    placeholder="Masukkan Karang Taruna" value="{{ old('nama_kartar') }}" required>
                  @error('nama_kartar')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Alamat Lengkap Sekretariat <span class="text-danger">*</span></label>
                  <input type="text" class="form-control  @error('alamat_sekretariat') is-invalid @enderror"
                    name="alamat_sekretariat" placeholder="Masukkan Alamat Lengkap Sekretariat"
                    value="{{ old('alamat_sekretariat') }}" required>
                  @error('alamat_sekretariat')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Foto Tampak Depan Sekretariat</label>
                  <input type="file" class="form-control @error('foto_sekretariat') is-invalid @enderror"
                    name="foto_sekretariat" value="{{ old('foto_sekretariat') }}"
                    accept="image/png, image/jpg, image/jpeg">
                  <div class="text-small">
                    <li>Ekstensi file harus : PNG, JPG, JPEG</li>
                    <li>Maksimal : 2 MB</li>
                  </div>
                  @error('foto_sekretariat')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="section-title">Lokasi Tugas</div>
            <div class="row">
              <div class="col-4">
                <div class="form-group">
                  <label>Kabupaten / Kota <span class="text-danger">*</span></label>
                  <select class="form-control @error('kota') is-invalid @enderror" name="kota" id="city" required>
                    <option disabled selected>Pilih Kabupaten / Kota</option>
                    @foreach ($regencies as $city)
                      <option value="{{ $city->name }}" data-id="{{ $city->id }}">
                        {{ $city->name }}</option>
                    @endforeach
                    @error('kota')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </select>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Kecamatan <span class="text-danger">*</span></label>
                  <select class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" id="district"
                    required>

                  </select>
                  @error('kecamatan')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Desa / Kelurahan <span class="text-danger">*</span></label>
                  <select class="form-control @error('desa') is-invalid @enderror" name="desa" id="villages" required>
                  </select>
                  @error('desa')
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
                  <label>No. Telp Sekretariat</label>
                  <input type="number" class="form-control @error('no_telp_sekretariat') is-invalid @enderror"
                    name="no_telp_sekretariat" placeholder="Masukkan Nomor Telpon Sekretariat"
                    value="{{ old('no_telp_sekretariat') }}">
                  @error('no_telp_sekretariat')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Alamat Email Karang Taruna <span class="text-danger">*</span></label>
                  <input type="email" class="form-control  @error('email_kartar') is-invalid @enderror"
                    name="email_kartar" placeholder="Masukkan Alamat Email Karang Taruna"
                    value="{{ old('email_kartar') }}" required>
                  @error('email_kartar')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="section-title">Surat Keterangan Karang Taruna</div>
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label>Nomor SK <span class="text-danger">*</span></label>
                  <input type="number" class="form-control  @error('no_sk') is-invalid @enderror" name="no_sk"
                    placeholder="Masukkan No. SK" value="{{ old('no_sk') }}" required>
                  @error('no_sk')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Tanggal SK <span class="text-danger">*</span></label>
                  <input type="date" class="form-control @error('tanggal_sk') is-invalid @enderror"
                    name="tanggal_sk" placeholder="Masukkan Tanggal SK" value="{{ old('tanggal_sk') }}" required>
                  @error('tanggal_sk')
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
                  <label>Penandatangan SK <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('penandatangan_sk') is-invalid @enderror"
                    name="penandatangan_sk" placeholder="Masukkan Penandatangan SK"
                    value="{{ old('penandatangan_sk') }}" required>
                  @error('penandatangan_sk')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Selaku <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('selaku') is-invalid @enderror" name="selaku"
                    placeholder="Masukkan Jabatan Penandatangan SK" value="{{ old('selaku') }}" required>
                  @error('selaku')
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
                  <label>Upload SK <span class="text-danger">*</span></label>
                  <input type="file" class="form-control @error('file_sk') is-invalid @enderror" name="file_sk"
                    accept=".pdf" required>
                  <div class="text-small">
                    <li>Ekstensi file harus : PDF</li>
                    <li>Maksimal : 2 MB</li>
                  </div>
                  @error('file_sk')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="section-title">Informasi Pengurus Karang Taruna</div>
            <div class="row">
              <div class="col-4">
                <div class="form-group">
                  <label>Nama Ketua Karang Taruna <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('nama_ketua_kartar') is-invalid @enderror"
                    name="nama_ketua_kartar" placeholder="Masukkan Nama Ketua Karang Taruna"
                    value="{{ old('nama_ketua_kartar') }}" required>
                  @error('nama_ketua_kartar')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>No. Telp / Whatsapp Ketua <span class="text-danger">*</span></label>
                  <input type="number" class="form-control @error('no_telp_wa') is-invalid @enderror"
                    name="no_telp_wa" placeholder="Masukkan No. Telp / Whatsapp Ketua" value="{{ old('no_telp_wa') }}"
                    required>
                  @error('no_telp_wa')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Foto Ketua <span class="text-danger">*</span></label>
                  <input type="file" class="form-control  @error('foto_ketua') is-invalid @enderror"
                    name="foto_ketua" accept="image/png, image/jpg, image/jpeg" required>
                  <div class="text-small">
                    <li>Ekstensi file harus : PNG, JPG, JPEG</li>
                    <li>Maksimal : 2 MB</li>
                  </div>
                  @error('foto_ketua')
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
                  <label>Jumlah Pengurus Laki-Laki</label>
                  <input type="number" class="form-control @error('jumlah_pengurus_laki_laki') is-invalid @enderror"
                    name="jumlah_pengurus_laki_laki" placeholder="Masukkan Jumlah Pengurus Laki-Laki"
                    value="{{ old('jumlah_pengurus_laki_laki') }}">
                  @error('jumlah_pengurus_laki_laki')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Jumlah Pengurus Perempuan</label>
                  <input type="number" class="form-control @error('jumlah_pengurus_perempuan') is-invalid @enderror"
                    name="jumlah_pengurus_perempuan" placeholder="Masukkan Jumlah Pengurus Perempuan"
                    value="{{ old('jumlah_pengurus_perempuan') }}">
                  @error('jumlah_pengurus_perempuan')
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
                  <label>Jumlah Anggota Laki-Laki</label>
                  <input type="number" class="form-control  @error('jumlah_anggota_laki_laki') is-invalid @enderror"
                    name="jumlah_anggota_laki_laki" placeholder="Masukkan Jumlah Anggota Laki-Laki"
                    value="{{ old('jumlah_anggota_laki_laki') }}">
                  @error('jumlah_anggota_laki_laki')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Jumlah Anggota Perempuan</label>
                  <input type="number" class="form-control @error('jumlah_anggota_perempuan') is-invalid @enderror"
                    name="jumlah_anggota_perempuan" placeholder="Masukkan Jumlah Anggota Perempuan"
                    value="{{ old('jumlah_anggota_perempuan') }}">
                  @error('jumlah_anggota_perempuan')
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
                  <label>Klasifikasi Karang Taruna</label>
                  <select class="form-control @error('klasifikasi_kartar') is-invalid @enderror"
                    name="klasifikasi_kartar">
                    <option disabled selected>Pilih Klasifikasi Karang Taruna</option>
                    <option value="Tumbuh">Tumbuh</option>
                    <option value="Berkembang">Berkembang</option>
                    <option value="Maju">Maju</option>
                    <option value="Percontohan">Percontohan</option>
                  </select>
                  @error('klasifikasi_kartar')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Status Kinerja</label>
                  <select class="form-control @error('status_kinerja') is-invalid @enderror" name="status_kinerja">
                    <option disabled selected>Pilih Status</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                  </select>
                  @error('status_kinerja')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <a type="button" href="{{ route('app.pillar.kartar.index') }}" class="btn btn-icon btn-danger"
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
