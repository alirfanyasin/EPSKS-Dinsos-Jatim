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
                <div class="breadcrumb-item">Data LKS</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Data LKS</h2>
            <p class="section-lead">Lembaga Kesejahteraan Sosial</p>
            <div class="card">
                <div class="card-header">
                    <h4>Data LKS</h4>
                    @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('super-admin'))
                        <a class="btn btn-success" href="{{ route('app.pillar.lks.create') }}" type="button">
                            <i class="fas fa-plus"></i> Tambah LKS
                        </a>
                        <a class="ml-2 btn btn-primary" href="{{ route('app.pillar.lks.import') }}" type="button">
                            <i class="fas fa-file-import"></i> Import Data
                        </a>
                    @endif
                </div>
                <div class="p-0 m-4 card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-md" id="table-data">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Lembaga</th>
                                    <th>Lokasi Lembaga</th>
                                    <th>Jenis Pelayanan</th>
                                    <th>Status Kepemilikan</th>
                                    <th>No. Telp Lembaga</th>
                                    <th>Nama Pimpinan</th>
                                    <th>No. Telp Pimpinan</th>
                                    <th>Detail</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataLKS as $key => $lks)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $lks->name }}</td>
                                        <td>{{ $lks->address['regency'] }} , {{ $lks->address['district'] }} ,
                                            {{ $lks->address['village'] }}</td>
                                        @php
                                            $services = DB::table('lks_services')
                                                ->where('lks_id', $lks->id)
                                                ->get();
                                        @endphp
                                        <td>
                                            @foreach ($services as $service)
                                                {{ $service->service }},
                                            @endforeach
                                        </td>
                                        <td>{{ $lks->owner }}</td>
                                        <td>{{ $lks->phone_number }}</td>
                                        <td>{{ $lks->leader_name }}</td>
                                        <td>{{ $lks->phone_number_leader }}</td>
                                        <td>
                                            <div class="flex-row flex-wrap d-flex">
                                                <a href="{{ route('app.pillar.lks.show', $lks->hash) }}"
                                                    class="btn btn-sm btn-info w-100" title="Detail">Detail Data</a>
                                                <a href="{{ route('app.pillar.lks.report.lks_report', $lks->hash) }}" class="mt-2 btn btn-sm btn-warning w-100"
                                                    title="Detail Laporan">Detail Laporan</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="flex-row flex-wrap d-flex">
                                                <a href="{{ route('app.pillar.lks.edit', $lks->hash) }}"
                                                    class="btn btn-sm btn-primary w-100" title="Edit">Edit Data</a>
                                                <div class="w-100">
                                                    <form action="{{ route('app.pillar.lks.destroy', $lks->hash) }}"
                                                        class="formDelete" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                            class="mt-2 btn btn-sm btn-danger w-100">Delete
                                                            Data</button>
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
