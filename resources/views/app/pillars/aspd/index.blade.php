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
        <div class="breadcrumb-item"> Data ASPD</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Data ASPD</h2>
      <p class="section-lead">Asistensi Social Pendamping Disabilitas</p>
      <div class="card">
        <div class="card-header">
          <h4>Data ASPD</h4>
          <a class="btn btn-success" href="{{ route('app.pillar.aspd.create') }}" type="button">
            <i class="fas fa-plus"></i> Tambah Data ASPD
          </a>
          {{-- <a class="btn btn-primary" style="margin-left: 10px" href="{{ route('app.pillar.kartar.import') }}"
            type="button">
            <i class="fas fa-file-import"></i> Import Data
          </a> --}}

        </div>
        <div class="p-0 m-4 card-body">
          <div class="table-responsive">
            <table class="table table-striped table-md" id="table-data">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Karang Taruna</th>
                  <th>Alamat Sekretariat</th>
                  <th>Lokasi Tugas</th>
                  <th>No. Telp</th>
                  <th width="100px">Detail</th>
                  {{-- @role('admin') --}}
                  <th width="100px">Aksi</th>
                  {{-- @endrole --}}
                </tr>
              </thead>
              <tbody>

                <tr>
                  <td>1</td>
                  <td>hELLO</td>
                  <td>DASDSA</td>
                  <td>DASDAS</td>
                  <td>DASDAS</td>

                  <td>DASDSA</td>
                  <td>
                    <div class="flex-row flex-wrap d-flex">
                      <a href="" class="mb-2 btn btn-sm btn-icon btn-info w-100" title="Detail">Detail
                        Data</a>
                      <a href="" class="btn btn-sm btn-icon btn-warning w-100" title="Detail Laporan">Detail
                        Laporan</a>
                    </div>
                  </td>
                </tr>
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