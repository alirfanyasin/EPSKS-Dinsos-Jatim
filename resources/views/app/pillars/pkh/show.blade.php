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
        <div class="breadcrumb-item">Detail Data</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Detail Data PKH</h2>
      <p class="section-lead">Program Keluarga Harapan</p>
      <div class="card">
        <div class="card-header">
          <h4>Detail Data PKH</h4>
        </div>
        <div class="card-body">
          <ul class="nav nav-pills" id="myTab3" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="master-tab" data-toggle="tab" href="#dataMaster" role="tab"
                aria-controls="home" aria-selected="true">Data Anggota PKH</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="training-tab" data-toggle="tab" href="#dataTraining" role="tab"
                aria-controls="profile" aria-selected="false">Data Pelatihan</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent2">
            {{-- Tab Content Data Start --}}
            <div class="tab-pane fade show active" id="dataMaster" role="tabpanel" aria-labelledby="master-tab">
              <form action="{{ route('app.pillar.pkh.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" value="{{ auth()->user()->office_id }}" name="office_id" hidden>
                <input type="text" value="{{ auth()->user()->id }}" name="user_id" hidden>
                <div class="row">

                  <div class="col-4">
                    <div class="form-group">
                      <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                      <input type="text" id="name" class="form-control  @error('name') is-invalid @enderror"
                        name="name" placeholder="Masukkan Nama Lengkap" value="{{ $data->name }}" readonly>
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
                        value="{{ $data->nik }}" readonly>
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
                        value="{{ $data->tmt }}" readonly>
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
                      <select name="religion" id="religion" class="form-control" disabled>
                        <option value="Islam" {{ $data->religion == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen" {{ $data->religion == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="Katolik" {{ $data->religion == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                        <option value="Hindu" {{ $data->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Buddha" {{ $data->religion == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                        <option value="Khonghucu" {{ $data->religion == 'Khonghucu' ? 'selected' : '' }}>Khonghucu
                        </option>
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
                      <select name="gender" id="gender" class="form-control" disabled>
                        <option value="Laki-Laki" {{ $data->gender == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki
                        </option>
                        <option value="Perempuan" {{ $data->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan
                        </option>
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
                        value="{{ $data->place_of_birth }}" placeholder="Masukkan Tempat Lahir" readonly>
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
                        value="{{ $data->date_of_birth }}" placeholder="Masukkan Tanggal Lahir" readonly>
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
                        placeholder="Masukkan Alamat Email" readonly>
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
                        placeholder="Masukkan Nomor Telepon" readonly>
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
                        placeholder="Masukkan Alamat" readonly>
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
                      <input type="text" class="form-control @error('province') is-invalid @enderror"
                        name="province" placeholder="Masukkan Provinsi" value="JAWA TIMUR" readonly>
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
                        placeholder="Masukkan Nomor NPWP" readonly>
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
                      <a href="{{ asset('storage/image/pillars/PKH/profile/' . $data->appointment_letter) }}"
                        class="btn btn-primary d-block" target="_blank">Lihat File</a>
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
                        class="form-control @error('clothes_size') is-invalid @enderror"
                        value="{{ $data->clothes_size }}" placeholder="Masukkan Ukuran Baju" readonly>
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
                      @foreach ($data->education as $item)
                        <input type="text" name="education" id="education"
                          class="form-control @error('education') is-invalid @enderror" value="{{ $item }}"
                          placeholder="Masukkan Pendidikan" readonly> <br>
                      @endforeach
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="pt_origin">Asal Perguruan Tinggi <span class="text-danger">*</span></label>
                      <input type="text" name="pt_origin" id="pt_origin"
                        class="form-control @error('pt_origin') is-invalid @enderror"
                        value="D3 - {{ $data->pt_origin_d3 }}" placeholder="D3 - Null" readonly> <br>
                      <input type="text" name="pt_origin" id="pt_origin"
                        class="form-control @error('pt_origin') is-invalid @enderror"
                        value="S1 - {{ $data->pt_origin_s1 }}" placeholder="S1 - Null" readonly> <br>
                      <input type="text" name="pt_origin" id="pt_origin"
                        class="form-control @error('pt_origin') is-invalid @enderror"
                        value="S2 - {{ $data->pt_origin_s2 }}" placeholder="S2 - Null" readonly> <br>
                      <input type="text" name="pt_origin" id="pt_origin"
                        class="form-control @error('pt_origin') is-invalid @enderror"
                        value="S3 - {{ $data->pt_origin_s3 }}" placeholder="S3 - Null" readonly> <br>

                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="major">Jurusan <span class="text-danger">*</span></label>
                      <input type="text" name="pt_origin" id="pt_origin" class="form-control"
                        value="D3 - {{ $data->major_d3 }}" placeholder="D3 - Null" readonly> <br>
                      <input type="text" name="pt_origin" id="pt_origin" class="form-control"
                        value="S1 - {{ $data->major_s1 }}" placeholder="S1 - Null" readonly> <br>
                      <input type="text" name="pt_origin" id="pt_origin" class="form-control"
                        value="S2 - {{ $data->major_s2 }}" placeholder="S2 - Null" readonly> <br>
                      <input type="text" name="pt_origin" id="pt_origin" class="form-control"
                        value="S3 - {{ $data->major_s3 }}" placeholder="S3 - Null" readonly> <br>

                    </div>
                  </div>
                </div>



                <div class="section-title">Keluarga</div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="marital_status">Status Pernikahan <span class="text-danger">*</span></label>
                      <select name="marital_status" id="marital_status" class="form-control" disabled>
                        <option value="Menikah" {{ $data->marital_status == 'Menikah' ? 'selected' : '' }}>Menikah
                        </option>
                        <option value="Belum Menikah" {{ $data->marital_status == 'Belum Menikah' ? 'selected' : '' }}>
                          Belum
                          Menikah</option>
                        <option value="Pernah Menikah"
                          {{ $data->marital_status == 'Pernah Menikah' ? 'selected' : '' }}>
                          Pernah Menikah</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="number_of_children">Jumlah Anak</label>
                      <input type="number" name="number_of_children" id="number_of_children" class="form-control"
                        placeholder="Tidak Ada" value="{{ $data->number_of_children }}" readonly>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="husband_or_wife_name">Nama Suami / Istri</label>
                      <input type="text" name="husband_or_wife_name" id="husband_or_wife_name" class="form-control"
                        placeholder="Tidak Ada" value="{{ $data->husband_or_wife_name }}" readonly>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="mother_name">Nomor Ibu Kandung <span class="text-danger">*</span></label>
                      <input type="text" name="mother_name" id="mother_name" class="form-control"
                        placeholder="Tidak Ada" value="{{ $data->mother_name }}" readonly>
                    </div>
                  </div>


                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="family_card_number">Nomor Kartu Keluarga <span class="text-danger">*</span></label>
                      <input type="number" name="family_card_number" id="family_card_number" class="form-control"
                        placeholder="Tidak Ada" value="{{ $data->family_card_number }}" readonly>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="no_bpjs">Nomor BPJS</label>
                      <input type="number" name="no_bpjs" id="no_bpjs" class="form-control"
                        value="{{ $data->no_bpjs }}" placeholder="Tidak Ada" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <a type="button" href="{{ route('app.pillar.pkh.index') }}" class="btn btn-icon btn-danger"
                      title="Batal">Kembali</a>
                  </div>
                </div>
              </form>
            </div>
            {{-- Tab Content Data End --}}


            {{-- Tab Content Training Start --}}
            <div class="tab-pane fade" id="dataTraining" role="tabpanel" aria-labelledby="training-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-striped table-md" id="table-data">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nama Pelatihan</th>
                          <th>Penyelenggara</th>
                          <th>Tanggal</th>
                          <th>Sertifikat</th>
                        </tr>
                      </thead>
                      <tbody>
                        {{-- @php
                          $no = 1;
                        @endphp
                        @foreach ($data_training as $data_training_member) --}}
                        <tr>
                          <td>1</td>
                          <td>Belajar Coding</td>
                          <td>Telkom University</td>
                          <td></td>
                          <td><a href="" class="text-danger" target="_blank"><i class="far fa-file-pdf"
                                style="font-size: 30px;"></i></a></td>
                        </tr>
                        {{-- @endforeach --}}

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            {{-- Tab Content Training End --}}

          </div>
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
