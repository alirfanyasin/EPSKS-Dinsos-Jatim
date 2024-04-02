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
        <div class="breadcrumb-item">Karang Taruna</div>
        <div class="breadcrumb-item active"><a href="{{ route('app.pillar.kartar.index') }}">Laporan</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('app.pillar.kartar.report.show', 1) }}">Detail
            Laporan</a></div>
        <div class="breadcrumb-item">Tambah Laporan</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Tambah Laporan Karang Taruna</h2>
      <p class="section-lead">Karang Taruna</p>
      <div class="card">
        <div class="card-header">
          <h4>Tambah Laporan Karang Taruna</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('app.pillar.kartar.report.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="status" value="Menunggu disetujui">
            <input type="hidden" name="office_id" value="{{ Auth::user()->office_id }}">
            <div class="row">
              <div class="col-12">
                <div class="mt-0 section-title">Pilih Periode Laporan</div>
                <div class="form-group">
                  <label>Pilih salah satu</label>
                  <select class="custom-select" name="period">
                    <option disabled selected>Pilih Periode Laporan</option>
                    <option value="1">Realtime (Harian)</option>
                    <option value="2">Bulanan</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label>Nama Karang Taruna</label>
                  <input type="text" class="form-control @error('name_kartar') is-invalid @enderror" name="name_kartar"
                    placeholder="Masukkan Nama Karang Taruna" value="{{ auth()->user()->karang_taruna->nama_kartar }}"
                    readonly>
                  @error('name_kartar')
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
                  <label>Kabupaten / Kota</label>
                  <input type="text" class="form-control @error('regency') is-invalid @enderror" name="regency"
                    placeholder="Masukkan Kabupaten / Kota" value="{{ auth()->user()->karang_taruna->kota }}" readonly>
                  @error('regency')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Kecamatan</label>
                  <input type="text" class="form-control @error('distric') is-invalid @enderror" name="distric"
                    placeholder="Masukkan Kecamatan" value="{{ auth()->user()->karang_taruna->kecamatan }}" readonly>
                  @error('distric')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Desa / Kelurahan</label>
                  <input type="text" class="form-control @error('village') is-invalid @enderror" name="village"
                    placeholder="Masukkan Desa / Kelurahan" value="{{ auth()->user()->karang_taruna->desa }}" readonly>
                  @error('village')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6 type-daily" hidden>
                <div class="form-group">
                  <label>Waktu</label>
                  <input type="date" class="form-control @error('date') is-invalid @enderror" value=""
                    name="date" placeholder="Masukkan waktu">
                  @error('date')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-6 type-daily" hidden>
                <div class="form-group">
                  <label>Tempat Kegiatan</label>
                  <input type="text" class="form-control @error('place') is-invalid @enderror" value=""
                    name="place" placeholder="Masukkan Tempat Kegiatan">
                  @error('place')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-6 type-daily" hidden>
                <div class="form-group">
                  <label>Aktivitas yang dilakukan</label>
                  <input type="text" class="form-control @error('activity') is-invalid @enderror" value=""
                    name="activity" placeholder="Masukkan Aktifitas yang dilakukan">
                  @error('activity')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-6 type-daily" hidden>
                <div class="form-group">
                  <label>Kendala</label>
                  <input type="text" class="form-control @error('constraint') is-invalid @enderror" value=""
                    name="constraint" placeholder="Masukkan Kendala">
                  @error('constraint')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-6 type-daily" hidden>
                <div class="form-group">
                  <label>Dokumentasi Lapangan</label>
                  <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                    accept=".png, .jpg, .jpeg">
                  <small class="form-text text-muted">
                    <li>Ekstensi file harus : PNG, JPG, JPEG</li>
                  </small>
                  @error('image')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-6 type-daily" hidden>
                <div class="form-group">
                  <label>Uraian / Keterangan Foto</label>
                  <input type="text" class="form-control @error('description') is-invalid @enderror"
                    name="description" placeholder="Masukkan Uraian / Keterangan Foto"
                    value="{{ old('description') }}">
                  @error('description')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="type-monthly" hidden>
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Bulan</label>
                    <input type="month" class="form-control @error('month') is-invalid @enderror" name="month"
                      placeholder="Masukkan Bulan">
                    @error('month')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>Dokumen Laporan</label>
                    <input type="file" class="form-control  @error('attachment') is-invalid @enderror"
                      name="attachment" accept=".pdf">
                    @error('attachment')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <a type="button" href="{{ route('app.pillar.kartar.report.index') }}" class="btn btn-icon btn-danger"
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
  {{-- <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
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

  <script>
    $('.custom-select').on('change', function() {
      console.log($(this).val());
      if ($(this).val() == 1) {
        $('.type-daily').attr('hidden', false);
        $('.type-monthly').attr('hidden', true);
      } else {
        $('.type-daily').attr('hidden', true);
        $('.type-monthly').attr('hidden', false);
      }
    })
  </script>
@endpush
