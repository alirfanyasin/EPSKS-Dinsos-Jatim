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
        <div class="breadcrumb-item"> Data PKH</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Data PKH</h2>
      <p class="section-lead">Program Keluarga Harapan</p>
      <div class="card">
        <div class="card-header">
          <h4>Data PKH</h4>
          <a class="btn btn-success" href="{{ route('app.pillar.pkh.create') }}" type="button">
            <i class="fas fa-plus"></i> Tambah Data PKH
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
                  <th>Nama Lengkap</th>
                  <th>Jenis Kelamin</th>
                  <th>Email</th>
                  <th>Telepon</th>
                  <th>Kabupaten / Kota</th>
                  <th width="100px">Detail</th>
                  @role('admin')
                    <th width="100px">Aksi</th>
                  @endrole
                </tr>
              </thead>
              <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach ($datas as $key => $data)
                  @php
                    $isAdmin = false;
                    $isAdminJawaTimur = 0;

                    // Periksa apakah pengguna memiliki peran 'admin'
                    foreach (auth()->user()->roles as $role) {
                        if ($role->name == 'admin' || $role->name == 'super-admin') {
                            $isAdmin = true;
                            $isAdminJawaTimur = 1;
                            break;
                        }
                    }

                  @endphp
                  @if (auth()->user()->id == $data->id ||
                          ($isAdmin && $data->office_id == Auth::user()->office_id) ||
                          Auth::user()->office_id == $isAdminJawaTimur)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $data->name }}</td>
                      <td>{{ $data->gender }}</td>
                      <td>{{ $data->email }}</td>
                      <td>{{ $data->phone }}</td>
                      <td>{{ $data->city }}</td>
                      <td>
                        <div class="flex-row flex-wrap d-flex">
                          <a href="{{ route('app.pillar.pkh.show', $data->id) }}"
                            class="mb-2 btn btn-sm btn-icon btn-info w-100" title="Detail">Detail
                            Data</a>
                          <a href="" class="btn btn-sm btn-icon btn-warning w-100" title="Detail Laporan">Detail
                            Laporan</a>
                        </div>
                      </td>
                      @role('admin')
                        <td>
                          <div class="flex-row flex-wrap d-flex">
                            <a href="" class="btn btn-icon btn-primary btn-sm w-100" title="Edit">Edit
                              Data</a>

                            <div class="w-100">
                              <form action="" class="formDelete" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="mt-2 btn btn-sm btn-danger w-100">Delete
                                  Data</button>
                              </form>
                            </div>
                          </div>
                        </td>
                      @endrole
                    </tr>
                  @endif
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
