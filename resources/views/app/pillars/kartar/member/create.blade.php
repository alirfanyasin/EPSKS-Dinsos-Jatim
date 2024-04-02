@extends('layouts.app')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>PSKS</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('app.pillar.kartar.index') }}">Data Karang Taruna</a>
        </div>
        <div class="breadcrumb-item active"><a href="{{ route('app.pillar.kartar.edit', 1) }}">Edit Data</a></div>
        <div class="breadcrumb-item">Tambah Data Pengurus</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Tambah Data Pengurus Karang Taruna</h2>
      <p class="section-lead">Karang Taruna</p>
      <div class="card">
        <div class="card-header">
          <h4>Tambah Data Pengurus Karang Taruna {{ $data->nama_kartar }}</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('app.pillar.kartar.member.store', $data->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            {{-- Kartar ID --}}
            <input type="hidden" name="kartar_id" value="{{ $data->id }}">
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label>Nama Lengkap Pengurus <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('name_member') is-invalid @enderror" name="name_member"
                    placeholder="Masukkan Nama Lengkap Pengurus" value="{{ old('name_member') }}" required>

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
                  <input type="number" class="form-control  @error('nik') is-invalid @enderror" name="nik"
                    placeholder="Masukkan No. KTP / NIK" value="{{ old('nik') }}" maxlength="16" required>
                  @error('nik')
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
                  <input type="file" class="form-control  @error('photo_identity') is-invalid @enderror"
                    name="photo_identity" value="{{ old('photo_identity') }}" required>
                  @error('photo_identity')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
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
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label>Tempat Lahir <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror"
                    name="place_of_birth" placeholder="Masukkan Tempat Lahir" value="{{ old('place_of_birth') }}"
                    required>
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
                    name="date_of_birth" placeholder="Masukkan Tanggal Lahir" value="{{ old('date_of_birth') }}"
                    required>
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
                  <input type="number" class="form-control @error('phone_number') is-invalid @enderror"
                    name="phone_number" placeholder="Masukkan Nomor Telepon" value="{{ old('phone_number') }}" required>
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
                  <select class="form-control @error('religion') is-invalid @enderror" name="religion" required>
                    <option disabled selected>Pilih Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Protestan">Protestan</option>
                    <option value="Budha">Budha</option>
                    <option value="Hindu">Hindhu</option>
                  </select>
                  @error('religion')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Pendidikan Terakhir</label>
                  <select class="form-control @error('last_education') is-invalid @enderror" name="last_education"
                    required>
                    <option disabled selected>Pilih Pendidikan Terakhir</option>
                    <option value="SMA / MA / SMK / sederajat">SMA / MA / SMK / sederajat</option>
                    <option value="Diploma I / II">Diploma I / II</option>
                    <option value="Diploma III">Diploma III</option>
                    <option value="Diploma IV / S1">Diploma IV / S1</option>
                    <option value="S2 / S3">S2 / S3</option>
                  </select>
                  @error('last_education')
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
                  <label>Pekerjaan</label>
                  <input type="text" class="form-control @error('main_job') is-invalid @enderror" name="main_job"
                    placeholder="Masukkan Pekerjaan" value="{{ old('main_job') }}">
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
                    placeholder="Masukkan Alamat Lengkap" value="{{ old('address') }}">
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
                  <input type="text" class="form-control  @error('position') is-invalid @enderror" name="position"
                    placeholder="Masukkan Jabatan Dalam Karang Taruna" value="{{ old('position') }}">
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
                <a type="button" href="{{ route('app.pillar.kartar.edit', $data->id) }}"
                  class="btn btn-icon btn-danger" title="Batal">Batal</a>
                <button type="submit" class="btn btn-icon btn-success" title="Simpan">Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    {{-- <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Data Pelatihan</h4>
                    </div>
                    <div class="card-body">
                        <form action="app/pillar/kartar/member/training/{{ $data->id }}">
                            <div class="form-group">
                                <label>Nama Pelatihan</label>
                                <input type="text" class="form-control" name="training_name"
                                    placeholder="Masukkan Nama Pelatihan" required="">
                            </div>
                            <div class="form-group">
                                <label>Penyelenggara</label>
                                <input type="text" class="form-control" name="orgnizer"
                                    placeholder="Masukkan Penyelenggara" required="">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Pelatihan</label>
                                <input type="date" class="form-control" name="date"
                                    placeholder="Masukkan Tanggal Pelatihan" required="">
                            </div>
                            <div class="form-group">
                                <label>Upload Sertifikat</label>
                                <input type="file" class="form-control" name="certificate" required="">
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
                        <h4>Data Pelatihan</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Pelatihan</th>
                                    <th>Penyelenggara</th>
                                    <th>Tanggal</th>
                                    <th>Sertifikat</th>
                                    <th>Aksi</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Teknik Mesin</td>
                                    <td>Qubisa</td>
                                    <td>12-07-2023</td>
                                    <td><a href="" class="text-danger"><i class="far fa-file-pdf"></i></a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-icon btn-primary" title="Edit"><i
                                                class="far fa-edit"></i></a>
                                        <a href="#" class="btn btn-icon btn-danger" title="Hapus"
                                            data-confirm="Realy?|Do you want to continue?"
                                            data-confirm-yes="alert('Deleted :)');"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
  </section>
@endsection
