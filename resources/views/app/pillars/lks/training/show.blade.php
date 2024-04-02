@extends('layouts.app')

@push('css-libraries')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
{{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">--}}
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>PSKS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.lks.index') }}">Data LKS</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.lks.show', $master->hash) }}">Detail Data</a></div>
                <div class="breadcrumb-item">Data Pelatihan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Data LKS</h2>
            <p class="section-lead">Lembaga Kesejahteraan Sosial</p>
            <div class="card">
                <div class="card-header" style="display: block">
                    <a href="{{ route('app.pillar.lks.show', $master->hash) }}" class="btn btn-danger mb-4">Kembali</a>
                    <h4>Data Pelatihan Pengurus {{ $management->name }} LKS {{ $master->name }}</h4>
                </div>
                <div class="card-body p-0 m-4">
                    <div class="table-responsive">
                        <table class="table table-striped table-md" id="table-data">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Pelatihan</th>
                                    <th>Penyelenggara</th>
                                    <th>Tanggal Pelatihan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataTraining as $key => $training)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $training->name }}</td>
                                        <td>{{ $training->organizer }}</td>
                                        @php
                                            $date = new DateTime($training->date);
                                        @endphp
                                        <td>{{ $date->format('d F Y') }}</td>
                                        <td>
                                            <button data-toggle="modal" data-target="#previewFileTraining{{ $loop->iteration }}" class="btn btn-sm btn-primary">Lihat Sertifikat</button>


                                            {{-- modal preview --}}
                                            <div class="modal fade" tabindex="-1" role="dialog" id="previewFileTraining{{ $loop->iteration }}">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Preview File Pelatihan</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <center>
                                                                <embed type="application/pdf" src="{{ asset('storage/pillars/lks/training/'. $training->attachment) }}" width="600" height="400"></embed>
                                                            </center>
                                                        </div>
                                                        <div class="modal-footer bg-whitesmoke br">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
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

