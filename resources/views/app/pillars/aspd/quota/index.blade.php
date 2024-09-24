@extends('layouts.app')
@push('css-libraries')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
@endpush


@section('content')
  <section class="section">
    <div class="section-header">
      <h1>PSKS</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item"> Data Kuota ASPD</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Data Kuota ASPD</h2>
      <p class="section-lead">Asistensi Sosial Pendamping Disabilitas</p>
      <div class="card">
        <div class="card-header">
          <h4>Data Kuota ASPD</h4>
          {{-- @role('super-admin')
            <a class="btn btn-success" href="{{ route('app.pillar.aspd.quota.create') }}" type="button">
              <i class="fas fa-plus"></i> Tambah Data Kuota ASPD
            </a>
          @endrole --}}
        </div>
        <div class="p-0 m-4 card-body">
          <div class="table-responsive">
            <table class="table table-striped table-md" id="table-data">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Kabupaten / Kota</th>
                  <th>Kuota</th>
                  <th width="100px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $no = 1;
                  $name = Auth::user()->name;
                  preg_match('/(KOTA|KABUPATEN) [A-Z ]+/', $name, $matches);
                  $kota = isset($matches[0]) ? trim($matches[0]) : 'Not found';
                @endphp

                @foreach ($datas as $key => $data)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->quota }}</td>

                    @if (strtolower(trim($data->name)) == strtolower(trim($kota)))
                      <td>
                        <div class="flex-row flex-wrap d-flex">
                          <a href="{{ route('app.pillar.aspd.quota.edit', $data->id) }}"
                            class="btn btn-icon btn-primary btn-sm w-100" title="Edit">Edit Data</a>
                          {{-- <a href="{{ route('app.pillar.aspd.quota.reset', $data->id) }}"
                            class="mt-2 btn btn-icon btn-danger btn-sm w-100" title="Riset">Riset Data</a> --}}
                          <div class="w-100">
                            <form action="{{ route('app.pillar.aspd.quota.reset', $data->id) }}" method="POST">
                              @csrf
                              <button type="submit" class="mt-2 btn btn-sm btn-danger w-100">Reset Data</button>
                            </form>
                          </div>
                        </div>
                      </td>
                    @else
                      <td>Tidak bisa</td>
                    @endif

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
