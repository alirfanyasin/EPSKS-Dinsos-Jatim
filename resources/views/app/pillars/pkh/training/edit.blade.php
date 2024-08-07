@extends('layouts.app')
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>PSKS</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('app.pillar.pkh.index') }}">Data Karang
            Taruna</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('app.pillar.pkh.edit', 1) }}">Edit Data</a></div>
        <div class="breadcrumb-item">Edit Data Pengurus</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Edit Data Pengurus Karang Taruna</h2>
      <p class="section-lead">Karang Taruna</p>
      <div class="card">
        <div class="card-header">
          <h4>Edit Data Pengurus Karang Taruna {{ $data_member->name_member }}</h4>
        </div>
        <div class="card-body">

          <ul class="nav nav-pills" id="myTab3" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="master-tab" data-toggle="tab" href="#dataMaster" role="tab"
                aria-controls="home" aria-selected="true">Data Pengurus</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="training-tab" data-toggle="tab" href="#dataTraining" role="tab"
                aria-controls="profile" aria-selected="false">Data Pelatihan</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent2">
            <div class="tab-pane fade show active" id="dataMaster" role="tabpanel" aria-labelledby="master-tab">
              <form
                action="{{ route('app.pillar.pkh.member.update', ['member_id' => $data_member->id, 'pkh_id' => $data_pkh->id]) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label>Nama Lengkap Pengurus <span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('name_member') is-invalid @enderror"
                        name="name_member" placeholder="Masukkan Nama Lengkap Pengurus"
                        value="{{ $data_member->name_member }}" required>
                      @error('name_member')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label>No. KTP / NIK <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="nik" placeholder="Masukkan No. KTP / NIK"
                        value="{{ $data_member->nik }}" maxlength="16" required>
                      @error('name_member')
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
                      <label>Foto KTP <span class="text-danger">*</span></label>

                      <div class="mb-3 input-group">
                        <input type="text" class="form-control  @error('photo_identity') is-invalid @enderror"
                          placeholder="Foto KTP" aria-label="" value="{{ $data_member->photo_identity }}" readonly>
                        <div class="input-group-append">
                          <a href="{{ asset('storage/image/pillars/pkh/member/' . $data_member->photo_identity) }}"
                            class="btn btn-primary" type="button">Lihat Foto</a>
                        </div>
                        <div class="input-group-append">
                          <input type="file" name="photo_identity" class="btn btn-danger d-none" id="photo_identity"
                            accept="image/png, image/jpeg, image/jpg">
                          <label type="button" for="photo_identity" class="h-100 btn btn-warning">Update
                            Foto</label>
                        </div>
                        @error('photo_identity')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      <div class="text-small">
                        <li>Ekstensi file harus : PNG, JPG, JPEG</li>
                        <li>Maksimal : 2 MB</li>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label>Jenis Kelamin <span class="text-danger">*</span></label>
                      <select class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                        <option disabled selected>Pilih Jenis Kelamin</option>
                        <option value="Laki-Laki" {{ $data_member->gender == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki
                        </option>
                        <option value="Perempuan" {{ $data_member->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan
                        </option>
                      </select>

                      @error('gender')
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
                      <label>Tempat Lahir <span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror"
                        name="place_of_birth" placeholder="Masukkan Tempat Lahir"
                        value="{{ $data_member->place_of_birth }}" required>
                      @error('place_of_birth')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label>Tanggal Lahir <span class="text-danger">*</span></label>
                      <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                        name="date_of_birth" placeholder="Masukkan Tanggal Lahir"
                        value="{{ $data_member->date_of_birth }}" required>

                      @error('date_of_birth')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label>Nomor Telepon <span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                        name="phone_number" placeholder="Masukkan Nomor Telepon"
                        value="{{ $data_member->phone_number }}" required>

                      @error('phone_number')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label>Agama <span class="text-danger">*</span></label>
                      <select class="form-control" name="religion" required>
                        <option disabled selected>Pilih Agama</option>
                        <option value="Islam" {{ $data_member->religion == 'Islam' ? 'selected' : '' }}>
                          Islam</option>
                        <option value="Katolik" {{ $data_member->religion == 'Katolik' ? 'selected' : '' }}>Katolik
                        </option>
                        <option value="Protestan" {{ $data_member->religion == 'Protestan' ? 'selected' : '' }}>
                          Protestan
                        </option>
                        <option value="Budha" {{ $data_member->religion == 'Budha' ? 'selected' : '' }}>
                          Budha</option>
                        <option value="Hindu" {{ $data_member->religion == 'Hindu' ? 'selected' : '' }}>
                          Hindhu</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label>Pendidikan Terakhir</label>
                      <select class="form-control" name="last_education" required>
                        <option disabled selected>Pilih Pendidikan Terakhir</option>
                        <option value="SMA / MA / SMK / sederajat"
                          {{ $data_member->last_education == 'SMA / MA / SMK / sederajat' ? 'selected' : '' }}>
                          SMA / MA / SMK / sederajat</option>
                        <option value="Diploma I / II"
                          {{ $data_member->last_education == 'Diploma I / II' ? 'selected' : '' }}>
                          Diploma I /
                          II</option>
                        <option value="Diploma III"
                          {{ $data_member->last_education == 'Diploma III' ? 'selected' : '' }}>
                          Diploma
                          III
                        </option>
                        <option value="Diploma IV / S1"
                          {{ $data_member->last_education == 'Diploma IV / S1' ? 'selected' : '' }}>
                          Diploma IV
                          / S1</option>
                        <option value="S2 / S3" {{ $data_member->last_education == 'S2 / S3' ? 'selected' : '' }}>S2 /
                          S3
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label>Pekerjaan</label>
                      <input type="text" class="form-control @error('main_job') is-invalid @enderror"
                        name="main_job" placeholder="Masukkan Pekerjaan" value="{{ $data_member->main_job }}">

                      @error('main_job')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label>Alamat Lengkap</label>
                      <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                        placeholder="Masukkan Alamat Lengkap" value="{{ $data_member->address }}">
                      @error('address')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label>Jabatan Dalam Karang Taruna</label>
                      <input type="text" class="form-control @error('position') is-invalid @enderror"
                        name="position" placeholder="Masukkan Jabatan Dalam Karang Taruna"
                        value="{{ $data_member->position }}">

                      @error('position')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <a type="button" href="{{ route('app.pillar.pkh.edit', $data_pkh->id) }}"
                      class="btn btn-icon btn-danger" title="Batal">Batal</a>
                    <button type="submit" class="btn btn-icon btn-success" title="Simpan">Simpan</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="tab-pane fade" id="dataTraining" role="tabpanel" aria-labelledby="training-tab">
              <div class="row">
                <div class="col-4">
                  <div class="card">
                    <div class="card-header">
                      <h4>Tambah Data Pelatihan</h4>
                    </div>
                    <div class="card-body">
                      <form
                        action="/app/pillar/pkh/member/training/store/{{ $data_member->id }}/{{ $data_pkh->id }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- Member id --}}
                        <input type="hidden" name="member_id" value="{{ $data_member->id }}">

                        <div class="form-group">
                          <label>Nama Pelatihan <span class="text-danger">*</span></label>
                          <input type="text" class="form-control @error('training_name') is-invalid @enderror"
                            name="training_name" placeholder="Masukkan Nama Pelatihan" required>

                          @error('training_name')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>Penyelenggara <span class="text-danger">*</span></label>
                          <input type="text" class="form-control @error('organizer') is-invalid @enderror"
                            name="organizer" placeholder="Masukkan Penyelenggara" required>
                          @error('organizer')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>Tanggal Pelatihan <span class="text-danger">*</span></label>
                          <input type="date" class="form-control @error('date') is-invalid @enderror"
                            name="date" placeholder="Masukkan Tanggal Pelatihan" required>
                          @error('date')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>Upload Sertifikat <span class="text-danger">*</span></label>
                          <input type="file" class="form-control @error('certificate') is-invalid @enderror"
                            name="certificate" accept=".pdf" required>
                          @error('certificate')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="col-12">
                          <button type="submit" class="btn btn-icon btn-success btn-block"
                            title="Tambah">Tambah</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-8">
                  <div class="card">
                    <div class="card-header">
                      <h4>Data Pelatihan {{ $data_member->name_member }}</h4>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-striped table-md" id="table-data">
                          <thead>
                            <tr>
                              <th>No.</th>
                              <th>Nama Pelatihan</th>
                              <th>Penyelenggara</th>
                              <th>date</th>
                              <th>Sertifikat</th>
                              <th width="100px">Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php
                              $no = 1;
                            @endphp
                            @foreach ($data_training as $data_training_member)
                              <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data_training_member->training_name }}</td>
                                <td>{{ $data_training_member->organizer }}</td>
                                <td>{{ $data_training_member->date }}</td>
                                <td><a
                                    href="{{ asset('storage/image/pillars/pkh/certificate/' . $data_training_member->certificate) }}"
                                    class="text-danger" target="_blank"><i class="far fa-file-pdf"
                                      style="font-size: 30px;"></i></a>
                                </td>
                                <td>
                                  <form action="{{ route('app.pillar.pkh.member.training.delete') }}"
                                    class="d-inline" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <input type="hidden" name="training_id" value="{{ $data_training_member->id }}">
                                    <input type="hidden" name="member_id" value="{{ $data_member->id }}">
                                    <input type="hidden" name="pkh_id" value="{{ $data_pkh->id }}">

                                    <button class="btn btn-icon btn-danger" type="submit" title="Hapus"
                                      onclick="return confirm('Are you sure you want to delete?');">
                                      <i class="fas fa-trash"></i>
                                    </button>
                                  </form>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


        </div>
      </div>

    </div>
  </section>
@endsection
@push('css-libraries')
  <style>
    #table-data td {
      white-space: nowrap;
    }
  </style>
@endpush
