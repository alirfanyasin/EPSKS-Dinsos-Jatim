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
        <div class="breadcrumb-item">Revisi Laporan</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Revisi Laporan Karang Taruna</h2>
      <p class="section-lead">Karang Taruna</p>
      <div class="card">
        <div class="card-header">
          <h4>Revisi Laporan Karang Taruna</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('app.pillar.kartar.report.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $data_report->id }}">
            <input type="hidden" name="status" value="Menunggu disetujui">
            <input type="hidden" name="office_id" value="{{ Auth::user()->office_id }}">
            <input type="hidden" name="period" value="{{ $data_report->period }}">
            <div class="row">
              <div class="col">
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                  <div style="width: 30px; height: 30px" class="mr-3">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                    </svg>
                  </div>

                  <div>

                    {{ $data_report->message }}
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="mt-0 section-title">Pilih Periode Laporan</div>
                <div class="form-group">
                  <label>Pilih salah satu</label>
                  <input type="text" name="" value="{{ $data_report->period == '1' ? 'Harian' : 'Bulanan' }}"
                    class="form-control" readonly>
                  {{-- <select class="custom-select" name="period">
                    <option value="1" {{ $data_report->period == '1' ? 'selected' : '' }}>Realtime (Harian)</option>
                    <option value="2" {{ $data_report->period == '2' ? 'selected' : '' }}>Bulanan</option>
                  </select> --}}
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
              <div class="col-6 type-daily" {{ $data_report->period == '1' ? '' : 'hidden' }}>
                <div class="form-group">
                  <label>Waktu</label>
                  <input type="date" class="form-control @error('date') is-invalid @enderror"
                    value="{{ $data_report->date }}" name="date" placeholder="Masukkan waktu">
                  @error('date')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-6 type-daily" {{ $data_report->period == '1' ? '' : 'hidden' }}>
                <div class="form-group">
                  <label>Tempat Kegiatan</label>
                  <input type="text" class="form-control @error('place') is-invalid @enderror"
                    value="{{ $data_report->place }}" name="place" placeholder="Masukkan Tempat Kegiatan">
                  @error('place')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-6 type-daily" {{ $data_report->period == '1' ? '' : 'hidden' }}>
                <div class="form-group">
                  <label>Aktivitas yang dilakukan</label>
                  <input type="text" class="form-control @error('activity') is-invalid @enderror"
                    value="{{ $data_report->activity }}" name="activity"
                    placeholder="Masukkan Aktifitas yang dilakukan">
                  @error('activity')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-6 type-daily" {{ $data_report->period == '1' ? '' : 'hidden' }}>
                <div class="form-group">
                  <label>Kendala</label>
                  <input type="text" class="form-control @error('constraint') is-invalid @enderror"
                    value="{{ $data_report->constraint }}" name="constraint" placeholder="Masukkan Kendala">
                  @error('constraint')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6 type-daily" {{ $data_report->period == '1' ? '' : 'hidden' }}>
                <div class="form-group">
                  <label>Dokumentasi Lapangan</label>
                  <div class="mb-3">
                    <img src="{{ asset('storage/image/pillars/kartar/report/' . $data_report->image) }}" class="w-100"
                      alt="">
                  </div>
                  <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                    value="{{ $data_report->image }}" accept=".png, .jpg, .jpeg">
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
              <div class="col-6 type-daily" {{ $data_report->period == '1' ? '' : 'hidden' }}>
                <div class="form-group">
                  <label>Uraian / Keterangan Foto</label>
                  <input type="text" class="form-control @error('description') is-invalid @enderror"
                    name="description" placeholder="Masukkan Uraian / Keterangan Foto"
                    value="{{ $data_report->description }}">
                  @error('description')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <a type="button" href="{{ route('app.pillar.kartar.report.index') }}" class="btn btn-icon btn-danger"
                  title="Batal">Batal</a>
                <button type="submit" class="btn btn-icon btn-success">Simpan</button>
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
