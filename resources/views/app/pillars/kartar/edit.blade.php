@extends('layouts.app')
@push('css-libraries')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
  {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css"> --}}
@endpush
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>PSKS</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('app.pillar.kartar.index') }}">Data Karang
            Taruna</a></div>
        <div class="breadcrumb-item">Edit Data</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Edit Data Karang Taruna</h2>
      <p class="section-lead">Karang Taruna</p>
      <div class="card">
        <div class="card-header">
          <h4>Edit Data Karang Taruna {{ $data->nama_kartar }}</h4>
        </div>
        <div class="card-body">

          <ul class="nav nav-pills" id="myTab3" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="master-tab" data-toggle="tab" href="#dataMaster" role="tab"
                aria-controls="home" aria-selected="true">Data Karang Taruna</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="training-tab" data-toggle="tab" href="#dataTraining" role="tab"
                aria-controls="profile" aria-selected="false">Data Pengurus</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent2">
            <div class="tab-pane fade show active" id="dataMaster" role="tabpanel" aria-labelledby="master-tab">
              <form action="{{ route('app.pillar.kartar.update', $data->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="office_id" value="{{ $data->office_id }}">

                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label>Nama Karang Taruna <span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('nama_kartar') is-invalid @enderror"
                        name="nama_kartar" placeholder="Masukkan Karang Taruna" value="{{ $data->nama_kartar }}" required>
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
                      <input type="text" class="form-control @error('alamat_sekretariat') is-invalid @enderror"
                        name="alamat_sekretariat" placeholder="Masukkan Alamat Lengkap Sekretariat"
                        value="{{ $data->alamat_sekretariat }}" required>
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
                      <div class="mb-3 input-group">
                        <input type="text" class="form-control  @error('foto_sekretariat') is-invalid @enderror"
                          placeholder="Foto Tampak Depan Sekretariat" aria-label="" value="{{ $data->foto_sekretariat }}"
                          readonly>
                        <div class="input-group-append">
                          <a href="{{ asset('storage/image/pillars/kartar/profile/' . $data->foto_sekretariat) }}"
                            class="btn btn-primary" type="button">Lihat Foto</a>
                        </div>
                        <div class="input-group-append">
                          <input type="file" name="foto_sekretariat" class="btn btn-danger d-none"
                            id="foto_sekretariat" accept="image/png, image/jpeg, image/jpg">
                          <label type="button" for="foto_sekretariat" class="h-100 btn btn-warning">Update
                            Foto</label>
                        </div>
                        @error('foto_sekretariat')
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
                </div>
                <div class="section-title">Lokasi Tugas</div>
                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label>Kabupaten / Kota <span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('kota') is-invalid @enderror" name="kota"
                        value="{{ $data->kota }}" required>
                      @error('kota')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label>Kecamatan <span class="text-danger">*</span></label>
                      <input type="text" class="form-control  @error('kecamatan') is-invalid @enderror"
                        name="kecamatan" value="{{ $data->kecamatan }}" required>
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
                      <input type="text" class="form-control @error('desa') is-invalid @enderror" name="desa"
                        value="{{ $data->desa }}" required>
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
                      <input type="text" class="form-control @error('no_telp_sekretariat') is-invalid @enderror"
                        name="no_telp_sekretariat" value="{{ $data->no_telp_sekretariat }}">
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
                      <input type="email" class="form-control @error('email_kartar') is-invalid @enderror"
                        name="email_kartar" value="{{ $data->email_kartar }}" readonly>
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
                      <input type="text" class="form-control @error('no_sk') is-invalid @enderror" name="no_sk"
                        value="{{ $data->no_sk }}" required>
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
                        name="tanggal_sk"value="{{ $data->tanggal_sk }}" required>
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
                      <input type="text" class="form-control  @error('penandatangan_sk') is-invalid @enderror"
                        name="penandatangan_sk" value="{{ $data->penandatangan_sk }}" required>
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
                        value="{{ $data->selaku }}" required>
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
                      <label>File SK <span class="text-danger">*</span></label>
                      <div class="mb-3 input-group">
                        <input type="text" class="form-control  @error('file_sk') is-invalid @enderror"
                          placeholder="Nama File SK" aria-label="" value="{{ $data->file_sk }}" readonly>
                        <div class="input-group-append">
                          <a href="{{ asset('storage/image/pillars/kartar/profile/' . $data->file_sk) }}"
                            class="btn btn-primary" type="button">Lihat File</a>
                        </div>
                        <div class="input-group-append">
                          <input type="file" name="file_sk" class="btn btn-danger d-none" id="file_sk"
                            accept=".pdf">
                          <label type="button" for="file_sk" class="h-100 btn btn-warning">Update
                            File</label>
                        </div>
                        @error('file_sk')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      <div class="text-small">
                        <li>Ekstensi file harus : PDF</li>
                        <li>Maksimal : 2 MB</li>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="section-title">Informasi Pengurus Karang Taruna</div>
                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label>Nama Ketua Karang Taruna <span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('nama_ketua_kartar') is-invalid @enderror"
                        name="nama_ketua_kartar" value="{{ $data->nama_ketua_kartar }}" required>
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
                      <input type="text" class="form-control @error('no_telp_wa') is-invalid @enderror"
                        name="no_telp_wa" value="{{ $data->no_telp_wa }}" required>
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
                      <div class="mb-3 input-group">
                        <input type="text" class="form-control  @error('foto_ketua') is-invalid @enderror"
                          placeholder="Foto Ketua" aria-label="" value="{{ $data->foto_ketua }}" readonly>
                        <div class="input-group-append">
                          <a href="{{ asset('storage/image/pillars/kartar/profile/' . $data->foto_ketua) }}"
                            class="btn btn-primary" type="button">Lihat Foto</a>
                        </div>
                        <div class="input-group-append">
                          <input type="file" name="foto_ketua" class="btn btn-danger d-none" id="foto_ketua"
                            accept="image/png, image/jpeg, image/jpg">
                          <label type="button" for="foto_ketua" class="h-100 btn btn-warning">Update
                            Foto</label>
                        </div>
                        @error('foto_ketua')
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
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label>Jumlah Pengurus Laki-Laki</label>
                      <input type="number"
                        class="form-control @error('jumlah_pengurus_laki_laki') is-invalid @enderror"
                        name="jumlah_pengurus_laki_laki" value="{{ $data->jumlah_pengurus_laki_laki }}">
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
                      <input type="number"
                        class="form-control @error('jumlah_pengurus_perempuan') is-invalid @enderror"
                        name="jumlah_pengurus_perempuan" value="{{ $data->jumlah_pengurus_perempuan }}">
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
                      <input type="number"
                        class="form-control @error('jumlah_anggota_laki_laki') is-invalid @enderror"
                        name="jumlah_anggota_laki_laki" value="{{ $data->jumlah_anggota_laki_laki }}">
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
                      <input type="number"
                        class="form-control  @error('jumlah_anggota_perempuan') is-invalid @enderror"
                        name="jumlah_anggota_perempuan" value="{{ $data->jumlah_anggota_perempuan }}">
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
                      <select class="form-control" name="klasifikasi_kartar">
                        <option value="Tumbuh" {{ $data->klasifikasi_kartar == 'Tumbuh' ? 'selected' : '' }}>Tumbuh
                        </option>
                        <option value="Berkembang" {{ $data->klasifikasi_kartar == 'Berkembang' ? 'selected' : '' }}>
                          Berkembang
                        </option>
                        <option value="Maju" {{ $data->klasifikasi_kartar == 'Maju' ? 'selected' : '' }}>Maju
                        </option>
                        <option value="Percontohan" {{ $data->klasifikasi_kartar == 'Percontohan' ? 'selected' : '' }}>
                          Percontohan
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label>Status Kinerja</label>
                      <select class="form-control" name="status_kinerja">
                        <option value="Aktif" {{ $data->status_kinerja == 'Aktif' ? 'selected' : '' }}>
                          Aktif
                        </option>
                        <option value="Tidak Aktif" {{ $data->status_kinerja == 'Tidak Aktif' ? 'selected' : '' }}>
                          Tidak Aktif
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <a type="button" href="{{ route('app.pillar.kartar.index') }}" class="btn btn-icon btn-danger"
                      title="Kembali">Kembali</a>
                    <button type="submit" class="btn btn-icon btn-success" title="Simpan">Simpan</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="tab-pane fade" id="dataTraining" role="tabpanel" aria-labelledby="training-tab">
              <div class="row">
                <div class="col-12">
                  <a href="/app/pillar/kartar/member/create/{{ $data->id }}" class="btn btn-icon btn-success"
                    title="Tambah Pengurus" style="margin-bottom: 20px"><i class="fas fa-plus"></i>
                    Tambah Data</a>
                  <div class="table-responsive">
                    <table class="table table-striped table-md" id="table-data">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nama Pengurus</th>
                          <th>NIK</th>
                          <th>Jabatan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                          $no = 1;
                        @endphp
                        @foreach ($data_member as $member)
                          <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $member->name_member }}</td>
                            <td>{{ $member->nik }}</td>
                            <td>{{ $member->position }}</td>

                            <td>
                              <div class="flex-row d-flex">
                                <a href="{{ route('app.pillar.kartar.member.show', ['member_id' => $member->id, 'kartar_id' => $data->id]) }}"
                                  class="btn btn-icon btn-info btn-sm w-100" title="Detail">Detail</a>

                                <a href="{{ route('app.pillar.kartar.member.edit', ['member_id' => $member->id, 'kartar_id' => $data->id]) }}"
                                  class="mx-2 btn btn-icon btn-primary btn-sm w-100" title="Edit">Edit</a>

                                <div class="w-100">
                                  <form action="{{ route('app.pillar.kartar.member.delete') }}" class="formDelete"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="member_id" value="{{ $member->id }}">
                                    <input type="hidden" name="kartar_id" value="{{ $data->id }}">
                                    <button type="submit" class="btn btn-sm btn-danger w-100">Delete</button>
                                  </form>
                                </div>
                              </div>
                            </td>

                            {{-- <td>
                                                                        <a href="{{ route('app.pillar.kartar.member.show', ['member_id' => $member->id, 'kartar_id' => $data->id]) }}"
                                                                            class="btn btn-icon btn-info" title="Detail">
                                                                            <i class="fas fa-info"></i>
                                                                        </a>
                            
                                                                        <a href="{{ route('app.pillar.kartar.member.edit', ['member_id' => $member->id, 'kartar_id' => $data->id]) }}"
                                                                            class="btn btn-icon btn-primary" title="Edit"><i
                                                                                class="far fa-edit"></i></a>
                            
                                                                        <form action="{{ route('app.pillar.kartar.member.delete') }}" method="POST"
                                                                            class="d-inline">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <input type="hidden" name="member_id" value="{{ $member->id }}">
                                                                            <input type="hidden" name="kartar_id" value="{{ $data->id }}">
                                                                            <!-- Add the DELETE method for the form -->
                                                                            <button class="btn btn-icon btn-danger" title="Hapus"
                                                                                onclick="return confirm('Are you sure you want to delete?');">
                                                                                <i class="fas fa-trash"></i>
                                                                            </button>
                                                                        </form>
                                                                    </td> --}}
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
  </section>
@endsection


@push('js-libraries')
  <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush


@push('script')
  <script>
    $(document).ready(function() {
      $('#table-data').DataTable();
    });



    $('.formDelete').submit(function(e) {
      e.preventDefault();

      Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          this.submit();
        }
      })
    });
  </script>
@endpush
