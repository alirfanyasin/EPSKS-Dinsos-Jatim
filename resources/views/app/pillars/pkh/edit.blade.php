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
        <div class="breadcrumb-item">Edit Data</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Edit Data PKH</h2>
      <p class="section-lead">Program Keluarga Harapan</p>
      <div class="card">
        <div class="card-header">
          <h4>Edit Data PKH</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('app.pillar.pkh.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" value="{{ auth()->user()->office_id }}" name="office_id" hidden>
            <input type="text" value="{{ auth()->user()->id }}" name="user_id" hidden>
            <div class="row">

              <div class="col-4">
                <div class="form-group">
                  <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                  <input type="text" id="name" value="{{ $data->name }}"
                    class="form-control  @error('name') is-invalid @enderror" name="name"
                    placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}">
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
                    value="{{ $data->nik }}" required>
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
                    value="{{ $data->tmt }}" required>
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
                    <option value="Islam" {{ $data->religion == 'Islam' ? 'selected' : '' }}>Islam
                    </option>
                    <option value="Kristen" {{ $data->religion == 'Kristen' ? 'selected' : '' }}>
                      Kristen</option>
                    <option value="Katolik" {{ $data->religion == 'Katolik' ? 'selected' : '' }}>
                      Katolik</option>
                    <option value="Hindu" {{ $data->religion == 'Hindu' ? 'selected' : '' }}>Hindu
                    </option>
                    <option value="Buddha" {{ $data->religion == 'Buddha' ? 'selected' : '' }}>Buddha
                    </option>
                    <option value="Khonghucu" {{ $data->religion == 'Khonghucu' ? 'selected' : '' }}>
                      Khonghucu</option>
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
                    <option value="Laki-Laki" {{ $data->gender == 'Laki-Laki' ? 'selected' : '' }}>
                      Laki-Laki</option>
                    <option value="Perempuan" {{ $data->gender == 'Perempuan' ? 'selected' : '' }}>
                      Perempuan</option>
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
                    value="{{ $data->place_of_birth }}" placeholder="Masukkan Tempat Lahir" required>
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
                    value="{{ $data->date_of_birth }}" placeholder="Masukkan Tanggal Lahir" required>
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
                    class="form-control @error('email') is-invalid @enderror" value="{{ $data->email }}"
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
                    class="form-control @error('phone') is-invalid @enderror" value="{{ $data->phone }}"
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
                    class="form-control @error('address') is-invalid @enderror" value="{{ $data->address }}"
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
                    class="form-control @error('no_npwp') is-invalid @enderror" value="{{ $data->no_npwp }}"
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
                    placeholder="Masukkan Nomor NPWP" accept=".pdf">
                  <div class="text-small">
                    <a href="{{ asset('storage/image/pillars/PKH/profile/' . $data->appointment_letter) }}"
                      class="my-2 btn btn-primary d-block" target="_blank">Lihat File Sebelumnya</a>
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
                    class="form-control @error('clothes_size') is-invalid @enderror" value="{{ $data->clothes_size }}"
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
                    @php
                      $educationLevels = ['D3', 'S1', 'S2', 'S3'];
                    @endphp
                    @foreach ($educationLevels as $level)
                      <div class="form-check">
                        <input class="form-check-input" name="education[]" type="checkbox"
                          value="{{ $level }}" id="{{ strtolower($level) }}"
                          @if (in_array($level, $data->education)) checked @endif>
                        <label class="form-check-label" for="{{ strtolower($level) }}">{{ $level }}</label>
                      </div>
                    @endforeach
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
                    <!-- Dynamic pt_origin inputs will be displayed here -->
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
                    <!-- Dynamic major inputs will be displayed here -->
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
                    <option value="Menikah" {{ $data->marital_status == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                    <option value="Belum Menikah" {{ $data->marital_status == 'Belum Menikah' ? 'selected' : '' }}>Belum
                      Menikah</option>
                    <option value="Pernah Menikah" {{ $data->marital_status == 'Pernah Menikah' ? 'selected' : '' }}>
                      Pernah Menikah</option>
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
                    placeholder="Masukkan Jumlah Anak" value="{{ $data->number_of_children }}">
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
                    placeholder="Masukkan Nama Suami atau Istri" value="{{ $data->husband_or_wife_name }}">
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
                    placeholder="Masukkan Nomor Kartu Keluarga" value="{{ $data->mother_name }}" required>
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
                    placeholder="Masukkan Nomor Kartu Keluarga" value="{{ $data->family_card_number }}" required>
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
                    class="form-control @error('no_bpjs') is-invalid @enderror" value="{{ $data->no_bpjs }}"
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
                <a type="button" href="{{ route('app.pillar.pkh.index') }}" class="btn btn-icon btn-danger"
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
      const educationData = @json($data->education);
      const ptOriginData = {
        D3: '{{ $data->pt_origin_d3 ?? '' }}',
        S1: '{{ $data->pt_origin_s1 ?? '' }}',
        S2: '{{ $data->pt_origin_s2 ?? '' }}',
        S3: '{{ $data->pt_origin_s3 ?? '' }}'
      };
      const majorData = {
        D3: '{{ $data->major_d3 ?? '' }}',
        S1: '{{ $data->major_s1 ?? '' }}',
        S2: '{{ $data->major_s2 ?? '' }}',
        S3: '{{ $data->major_s3 ?? '' }}'
      };

      const checkboxes = document.querySelectorAll('input[name="education[]"]');
      checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
          updateFields();
        });
      });

      function updateFields() {
        const checkedCheckboxes = document.querySelectorAll('input[name="education[]"]:checked');

        document.getElementById('pt_origin_inputs').innerHTML = '';
        document.getElementById('major_inputs').innerHTML = '';

        checkedCheckboxes.forEach(checked => {
          const value = checked.value;
          const label = checked.parentElement.querySelector('.form-check-label').textContent
            .trim();

          const ptOriginValue = ptOriginData[value] || '';
          const majorValue = majorData[value] || '';

          const ptInput = document.createElement('div');
          ptInput.classList.add('form-group');
          ptInput.innerHTML = `
                    <label for="pt_${value}">${label}</label>
                    <input type="text" name="pt_origin_${value}" id="pt_${value}" class="form-control" value="${ptOriginValue}">
                `;
          document.getElementById('pt_origin_inputs').appendChild(ptInput);

          const majorInput = document.createElement('div');
          majorInput.classList.add('form-group');
          majorInput.innerHTML = `
                    <label for="major_${value}">${label}</label>
                    <input type="text" name="major_${value}" id="major_${value}" class="form-control" value="${majorValue}">
                `;
          document.getElementById('major_inputs').appendChild(majorInput);
        });
      }

      updateFields();
    });
  </script>
@endpush
