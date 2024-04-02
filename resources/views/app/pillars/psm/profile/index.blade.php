@extends('layouts.app')

@push('css-libraries')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>PSM</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Data PSM</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Data PSM</h2>
            <p class="section-lead">Pekerja Sosial Masyarakat</p>
            <div class="card">
                <div class="card-header">
                    <h4>Data PSM</h4>
                    <a class="btn btn-success" href="{{ route('app.pillar.psm.profile.create') }}" type="button">
                        <i class="fas fa-plus"></i> Tambah PSM
                    </a>
                    <a class="btn btn-primary ml-2" href="#" type="button">
                        <i class="fas fa-file-import"></i> Import Data
                    </a>
                </div>
                <div class="card-body p-0 m-4">
                    <div class="table-responsive">
                        <table class="table table-striped table-md" id="table-data">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>NO. KTP (NIK)</th>
                                <th>Nama Lengkap</th>
                                <th>No. HP / Whatapp</th>
                                <th>Lokasi Tugas</th>
                                <th>Detail</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($psms as $key => $psm)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $psm->nik }}</td>
                                    <td>{{ $psm->name }}</td>
                                    <td>{{ $psm->phone_number }}</td>
                                    <td>{{ $psm->duty_address ? $psm->duty_address['regency'] : '' }} , {{ $psm->duty_address ? $psm->duty_address['district'] : '' }}</td>
                                    <td @if(auth()->user()->hasRole('super-admin')) @endif>
                                        <div class="d-flex flex-row flex-wrap">
                                            <a href="{{ route('app.pillar.psm.profile.show', $psm->hash) }}" class="btn btn-sm btn-info w-100" title="Detail">Detail Data</a>
                                            <a href="{{ route('app.pillar.psm.profile.report', $psm->hash) }}" class="btn btn-sm btn-warning w-100 mt-2" title="Detail Laporan">Detail Laporan</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-row flex-wrap">
                                            <a href="{{ route('app.pillar.psm.profile.edit', $psm->hash) }}" class="btn btn-sm btn-primary w-100" title="Edit">Edit Data</a>
                                            <div class="w-100">
                                                <form action="{{ route('app.pillar.psm.profile.delete', $psm->hash) }}" class="formDelete" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-danger w-100 mt-2">Delete Data</button>
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
        $(document).ready(function () {
            $('#table-data').DataTable();
        });

        $('.formDelete').submit(function (e) {
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
