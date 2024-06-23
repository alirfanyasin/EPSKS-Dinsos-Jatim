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
        <div class="breadcrumb-item active"><a href="{{ route('app.pillar.pkh.index') }}">Data PKH</a></div>
        <div class="breadcrumb-item">Tambah Data</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Tambah Data PKH</h2>
      <p class="section-lead">Program Keluarga Harapan</p>
      <div class="card">
        <div class="card-header">
          <h4>Tambah Data PKH</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('app.pillar.pkh.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" value="{{ auth()->user()->office_id }}" name="office_id" hidden>
            <input type="text" value="{{ auth()->user()->id }}" name="user_id" hidden>
            <div class="row">

              <div class="col-4">
                <div class="form-group">
                  <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                  <input type="text" id="name" class="form-control  @error('name') is-invalid @enderror"
                    name="name" placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}">
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
                  <label for="tmt">TMT <span class="text-danger">*</span></label>
                  <input type="text" name="tmt" id="tmt"
                    class="form-control @error('tmt') is-invalid @enderror" placeholder="Masukkan TMT"
                    value="{{ old('tmt') }}" required>
                  @error('tmt')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="religion">Agama <span class="text-danger">*</span></label>
                  <select name="religion" id="religion" class="form-control">
                    <option disabled selected>Pilih Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Khonghucu">Khonghucu</option>
                  </select>
                  @error('religion')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="gender">Jenis Kelamin <span class="text-danger">*</span></label>
                  <select name="gender" id="gender" class="form-control">
                    <option disabled selected>Pilih Jenis Kelamin</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                  @error('gender')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="place_of_birth">Tempat Lahir <span class="text-danger">*</span></label>
                  <input type="text" name="place_of_birth" id="place_of_birth"
                    class="form-control @error('place_of_birth') is-invalid @enderror"
                    value="{{ old('place_of_birth') }}" placeholder="Masukkan Tempat Lahir" required>
                  @error('place_of_birth')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="date_of_birth">Tanggal Lahir <span class="text-danger">*</span></label>
                  <input type="date" name="date_of_birth" id="date_of_birth"
                    class="form-control @error('date_of_birth') is-invalid @enderror"
                    value="{{ old('date_of_birth') }}" placeholder="Masukkan Tanggal Lahir" required>
                  @error('date_of_birth')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>



              <div class="col-md-4">
                <div class="form-group">
                  <label for="email">Email <span class="text-danger">*</span></label>
                  <input type="email" name="email" id="email"
                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                    placeholder="Masukkan Alamat Email" required>
                  @error('email')
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

              <div class="col-4">
                <div class="form-group">
                  <label>Provinsi <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('province') is-invalid @enderror" name="province"
                    placeholder="Masukkan Provinsi" value="JAWA TIMUR" readonly>
                  @error('province')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-4">
                @php
                  $name = Auth::user()->name;
                  $nameWithoutLastWord = preg_replace('/\b\w+\s*$/', '', $name);
                  preg_match('/(KOTA|KABUPATEN) [A-Z ]+/', $nameWithoutLastWord, $matches);
                  $kota = $matches[0] ?? 'Not found';
                @endphp
                <div class="form-group">
                  <label>Kabupaten / Kota <span class="text-danger">*</span></label>
                  <input type="text" class="form-control  @error('city') is-invalid @enderror" name="city"
                    placeholder="Masukkan Kabupaten / Kota" value="{{ $kota }}" readonly>
                  @error('city')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="no_npwp">Nomor NPWP <span class="text-danger">*</span></label>
                  <input type="number" name="no_npwp" id="no_npwp"
                    class="form-control @error('no_npwp') is-invalid @enderror" value="{{ old('no_npwp') }}"
                    placeholder="Masukkan Nomor NPWP" required>
                  @error('no_npwp')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="appointment_letter">SK Pengangkatan <span class="text-danger">*</span></label>
                  <input type="file" name="appointment_letter" id="appointment_letter"
                    class="form-control @error('appointment_letter') is-invalid @enderror"
                    placeholder="Masukkan Nomor NPWP" accept=".pdf" required>
                  <div class="text-small">
                    <li>Ekstensi file harus : PDF</li>
                    <li>Maksimal : 2 MB</li>
                  </div>
                  @error('appointment_letter')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="clothes_size">Ukuran Baju <span class="text-danger">*</span></label>
                  <input type="text" name="clothes_size" id="clothes_size"
                    class="form-control @error('clothes_size') is-invalid @enderror" value="{{ old('clothes_size') }}"
                    placeholder="Masukkan Ukuran Baju" required>
                  @error('clothes_size')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>





            <div class="section-title">Pendidikan</div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="education">Pendidikan <span class="text-danger">*</span></label>

                  <div>
                    <div class="form-check">
                      <input class="form-check-input" name="education[]" type="checkbox" value="D3"
                        id="d3">
                      <label class="form-check-label" for="d3">D3</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" name="education[]" type="checkbox" value="S1"
                        id="s1_div">
                      <label class="form-check-label" for="s1_div">S1</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" name="education[]" type="checkbox" value="S2"
                        id="s2">
                      <label class="form-check-label" for="s2">S2</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" name="education[]" type="checkbox" value="S3"
                        id="s3">
                      <label class="form-check-label" for="s3">S3</label>
                    </div>
                  </div>
                  @error('education')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="pt_origin">Asal Perguruan Tinggi <span class="text-danger">*</span></label>
                  <div id="pt_origin_inputs">
                    <!-- Tempat untuk menampilkan input -->
                  </div>
                  @error('pt_origin')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="major">Jurusan <span class="text-danger">*</span></label>
                  <div id="major_inputs">
                    <!-- Tempat untuk menampilkan input -->
                  </div>
                  @error('major')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>



            <div class="section-title">Keluarga</div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="marital_status">Status Pernikahan <span class="text-danger">*</span></label>
                  <select name="marital_status" id="marital_status" class="form-control">
                    <option disabled selected>Pilih Status</option>
                    <option value="Menikah">Menikah</option>
                    <option value="Belum Menikah">Belum Menikah</option>
                    <option value="Pernah Menikah">Pernah Menikah</option>
                  </select>
                  @error('marital_status')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="number_of_children">Jumlah Anak</label>
                  <input type="number" name="number_of_children" id="number_of_children"
                    class="form-control @error('number_of_children') is-invalid @enderror"
                    placeholder="Masukkan Jumlah Anak" value="{{ old('number_of_children') }}">
                  @error('number_of_children')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="husband_or_wife_name">Nama Suami / Istri</label>
                  <input type="text" name="husband_or_wife_name" id="husband_or_wife_name"
                    class="form-control @error('husband_or_wife_name') is-invalid @enderror"
                    placeholder="Masukkan Nama Suami atau Istri" value="{{ old('husband_or_wife_name') }}">
                  @error('husband_or_wife_name')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="mother_name">Nomor Ibu Kandung <span class="text-danger">*</span></label>
                  <input type="text" name="mother_name" id="mother_name"
                    class="form-control @error('mother_name') is-invalid @enderror"
                    placeholder="Masukkan Nomor Kartu Keluarga" value="{{ old('mother_name') }}" required>
                  @error('mother_name')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>


              <div class="col-md-4">
                <div class="form-group">
                  <label for="family_card_number">Nomor Kartu Keluarga <span class="text-danger">*</span></label>
                  <input type="number" name="family_card_number" id="family_card_number"
                    class="form-control @error('family_card_number') is-invalid @enderror"
                    placeholder="Masukkan Nomor Kartu Keluarga" value="{{ old('family_card_number') }}" required>
                  @error('family_card_number')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="no_bpjs">Nomor BPJS</label>
                  <input type="number" name="no_bpjs" id="no_bpjs"
                    class="form-control @error('no_bpjs') is-invalid @enderror" value="{{ old('no_bpjs') }}"
                    placeholder="Masukkan Nomor BPJS">
                  @error('no_bpjs')
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



  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // JavaScript untuk menangani perubahan pada checkbox
      const checkboxes = document.querySelectorAll('input[name="education[]"]');
      checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
          const checkedCheckboxes = document.querySelectorAll('input[name="education[]"]:checked');

          // Hapus semua input sebelum menambahkan yang baru
          document.getElementById('pt_origin_inputs').innerHTML = '';
          document.getElementById('major_inputs').innerHTML = '';

          // Tambahkan input sesuai dengan checkbox yang dicek
          checkedCheckboxes.forEach(checked => {
            const value = checked.value;
            const label = checked.parentElement.querySelector('.form-check-label').textContent.trim();

            // Buat elemen input untuk asal perguruan tinggi
            const ptInput = document.createElement('div');
            ptInput.classList.add('form-group');
            ptInput.innerHTML = `
            <label for="pt_${value}">${label}</label>
            <input type="text" name="pt_origin_${value}" id="pt_${value}" class="form-control">
          `;
            document.getElementById('pt_origin_inputs').appendChild(ptInput);

            // Buat elemen input untuk jurusan
            const majorInput = document.createElement('div');
            majorInput.classList.add('form-group');
            majorInput.innerHTML = `
            <label for="major_${value}">${label}</label>
            <input type="text" name="major_${value}" id="major_${value}" class="form-control">
          `;
            document.getElementById('major_inputs').appendChild(majorInput);
          });
        });
      });
    });
  </script>
@endpush
