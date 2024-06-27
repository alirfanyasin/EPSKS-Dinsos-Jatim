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
        <div class="breadcrumb-item">PKH</div>
        <div class="breadcrumb-item active"><a href="{{ route('app.pillar.kartar.index') }}">Laporan</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('app.pillar.kartar.report.show', 1) }}">Detail
            Laporan</a></div>
        <div class="breadcrumb-item">Tambah Laporan</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Tambah Laporan PKH</h2>
      <p class="section-lead">Program Keluarga Harapan</p>
      <div class="card">
        <div class="card-header">
          <h4>Tambah Laporan PKH</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('app.pillar.pkh.report.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="status" value="Menunggu disetujui">
            <input type="hidden" name="office_id" value="{{ Auth::user()->office_id }}">
            <div class="row">
              <div class="col-12">
                <div class="mt-0 section-title">Pilih Periode Laporan</div>
                <div class="form-group">
                  <label>Pilih salah satu</label>
                  <select class="custom-select" name="type">
                    <option disabled selected>Pilih Periode Laporan</option>
                    <option value="daily">Realtime (Harian)</option>
                    <option value="monthly">Bulanan</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label>Nama Lengkap</label>
                  <input type="text" class="form-control" name="" value="{{ auth()->user()->name }}" disabled>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>NIK</label>
                  <input type="text" class="form-control" name="" value="{{ auth()->user()->pkh->nik }}"
                    disabled>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6 type-daily" hidden>
                <div class="form-group">
                  <label>Waktu <span class="text-danger">*</span></label>
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
                  <label>Tempat Kegiatan <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('venue') is-invalid @enderror" value=""
                    name="venue" placeholder="Masukkan Tempat Kegiatan">
                  @error('venue')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-6 type-daily" hidden>
                <div class="form-group">
                  <label>Aktivitas yang dilakukan</label>
                  <textarea class="form-control @error('activity') is-invalid @enderror" name="activity"
                    placeholder="Masukkan Aktivitas yang dilakukan" style="min-height: 150px">{{ old('activity') }}</textarea>
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
                  <textarea class="form-control @error('constraint') is-invalid @enderror" name="constraint"
                    placeholder="Masukkan Kendala" style="min-height: 150px">{{ old('constraint') }}</textarea>
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
                  <label>Dokumentasi Lapangan <span class="text-danger">*</span></label>
                  <input type="file" class="form-control @error('attachment_daily') is-invalid @enderror"
                    name="attachment_daily" accept=".png, .jpg, .jpeg">
                  <small class="form-text text-muted">
                    <li>Ekstensi file harus : PNG, JPG, JPEG</li>
                  </small>
                  @error('attachment_daily')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-6 type-daily" hidden>
                <div class="form-group">
                  <label>Uraian / Keterangan Foto</label>
                  <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                    placeholder="Masukkan Uraian / Keterangan Foto" style="min-height: 100px">{{ old('description') }}</textarea>
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
                    <input type="file" class="form-control  @error('attachment_monthly') is-invalid @enderror"
                      name="attachment_monthly" accept=".pdf">
                    @error('attachment_monthly')
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
                <a type="button" href="{{ route('app.pillar.pkh.report.index') }}" class="btn btn-icon btn-danger"
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
      if ($(this).val() == 'daily') {
        $('.type-daily').attr('hidden', false);
        $('.type-monthly').attr('hidden', true);
      } else {
        $('.type-daily').attr('hidden', true);
        $('.type-monthly').attr('hidden', false);
      }
    })
  </script>
@endpush
