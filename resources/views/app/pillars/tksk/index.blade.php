@extends('layouts.app')

@push('css-libraries')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
  {{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css"> --}}
@endpush

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>PSKS</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Data TKSK</div>
      </div>
    </div>
    <div class="section-body">
      <h2 class="section-title">Data TKSK</h2>
      <p class="section-lead">Tenga Kerja Sosial Kecamatan</p>
      <div class="card">
        <div class="card-header">
          <h4>Data TKSK</h4>
          <a class="btn btn-success" href="{{ route('app.pillar.tksk.create') }}" type="button">
            <i class="fas fa-plus"></i> Tambah TKSK
          </a>
          {{-- <a class="ml-2 btn btn-primary" href="{{ route('app.pillar.tksk.import') }}" type="button">
                    <i class="fas fa-file-import"></i> Import Data
                </a> --}}
        </div>
        <div class="p-0 m-4 card-body">
          <div class="table-responsive">
            <table class="table table-striped table-md" id="table-data">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>No. Induk Anggota TKSK (NIAT)</th>
                  <th>Lokasi Tugas</th>
                  <th>Nama TKSK</th>
                  <th>Nama Ibu Kandung</th>
                  <th>No. KTP / NIK</th>
                  <th>No. HP / Whatapp</th>
                  <th>Tahun Pengangkatan TKSK</th>
                  <th>Detail</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($tksks as $key => $tksk)
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $tksk->membership_number }}</td>
                    <td>{{ $tksk->duty_address ? $tksk->duty_address['regency'] : '' }} ,
                      {{ $tksk->duty_address ? $tksk->duty_address['district'] : '' }}</td>
                    <td>{{ $tksk->name }}</td>
                    <td>{{ $tksk->mother_name }}</td>
                    <td>{{ $tksk->nik }}</td>
                    <td>{{ $tksk->phone_number }}</td>
                    <td>{{ $tksk->year_of_appointment }}</td>
                    <td @if (auth()->user()->hasRole('super-admin'))  @endif>
                      <div class="flex-row flex-wrap d-flex">
                        <a href="{{ route('app.pillar.tksk.show', $tksk->hash) }}" class="btn btn-sm btn-info w-100"
                          title="Detail">Detail Data</a>
                        <a href="{{ route('app.pillar.tksk.personal.report', $tksk->hash) }}"
                          class="mt-2 btn btn-sm btn-warning w-100" title="Detail Laporan">Detail Laporan</a>
                      </div>
                    </td>
                    <td>
                      <div class="flex-row flex-wrap d-flex">
                        <a href="{{ route('app.pillar.tksk.edit', $tksk->hash) }}" class="btn btn-sm btn-primary w-100"
                          title="Edit">Edit Data</a>
                        <div class="w-100">
                          <form action="{{ route('app.pillar.tksk.delete', $tksk->hash) }}" class="formDelete"
                            method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="mt-2 btn btn-sm btn-danger w-100">Delete Data</button>
                          </form>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('js-libraries')
  <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
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
