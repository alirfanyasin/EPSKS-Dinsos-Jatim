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
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.lks.edit', $master->hash) }}">Edit Data</a></div>
                <div class="breadcrumb-item">Data Pelatihan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Data LKS</h2>
            <p class="section-lead">Lembaga Kesejahteraan Sosial</p>
            <div class="card">
                <div class="card-header" style="display: block">
                    <a href="{{ route('app.pillar.lks.edit', $master->hash) }}" class="btn btn-danger mb-4">Kembali</a>
                    <h4>Data Pelatihan Pengurus {{ $management->name }} LKS {{ $master->name }}</h4>
                    <button class="btn btn-success mt-2" data-toggle="modal" data-target="#modalsAddtraining" type="button">
                        <i class="fas fa-plus"></i> Tambah Pelatihan
                    </button>

                    <div class="modal fade" tabindex="-1" role="dialog" id="modalsAddtraining">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Pelatihan {{ $management->name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('app.pillar.lks.management.training.store', ['lks_hash' => $master->hash, 'lks_management' => $management->hash]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Nama Pelatihan</label>
                                                    <input type="text" name="hash" value="{{ $management->hash }}" readonly hidden>
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Masukkan Nama Pelatihan" value="{{ old('name') }}">
                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Penyelenggara</label>
                                                    <input type="text" class="form-control @error('organizer') is-invalid @enderror" name="organizer" placeholder="Masukkan Penyelenggara" value="{{ old('organizer') }}">
                                                    @error('organizer')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Tanggal Pelatihan</label>
                                                    <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}">
                                                    @error('date')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Upload Sertifikat</label>
                                                    <input type="file" class="form-control @error('attachment') is-invalid @enderror" name="attachment" accept=".pdf">
                                                    <small id="photoKTPHelp" class="form-text text-muted">
                                                        <li>Ekstensi file harus : PDF</li>
                                                    </small>
                                                    @error('attachment')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-whitesmoke br">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
                                            <div class="d-flex flex-row flex-wrap">
                                                <button data-toggle="modal" data-target="#modalsEdittraining{{ $loop->iteration }}" class="btn btn-sm btn-primary w-100" title="Edit">Edit Data</button>
                                                <div class="w-100">
                                                    <form action="{{ route('app.pillar.lks.management.training.destroy', ['lks_hash' => $master->hash, 'lks_management' => $management->hash, 'lks_training_hash' => $training->hash]) }}" class="formDelete" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-sm btn-danger w-100 mt-2">Delete Data</button>
                                                    </form>
                                                </div>
                                            </div>

                                            {{-- modal edit --}}
                                            <div class="modal fade" tabindex="-1" role="dialog" id="modalsEdittraining{{ $loop->iteration }}">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Pelatihan {{ $management->name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('app.pillar.lks.management.training.update', ['lks_hash' => $master->hash, 'lks_management' => $management->hash, 'lks_training_hash' => $training->hash]) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Nama Pelatihan</label>
                                                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Masukkan Nama Pelatihan" value="{{ $training->name }}">
                                                                            @error('name')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Penyelenggara</label>
                                                                            <input type="text" class="form-control @error('organizer') is-invalid @enderror" name="organizer" placeholder="Masukkan Penyelenggara" value="{{ $training->organizer }}">
                                                                            @error('organizer')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Tanggal Pelatihan</label>
                                                                            <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ $training->date }}">
                                                                            @error('date')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Upload Sertifikat</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="file" class="form-control @error('attachment') is-invalid @enderror" name="attachment" accept=".pdf">
                                                                                <div class="input-group-append">
                                                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#previewFileSK" type="button">File Saat Ini</button>
                                                                                </div>

                                                                                <div class="modal fade" tabindex="-1" role="dialog" id="previewFileSK">
                                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title">Preview File Sertifikat Pelatihan</h5>
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
                                                                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <small id="photoKTPHelp" class="form-text text-muted">
                                                                                <li>Ekstensi file harus : PDF</li>
                                                                            </small>
                                                                            @error('attachment')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer bg-whitesmoke br">
                                                                <button type="submit" class="btn btn-success">Simpan</button>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                            </div>
                                                        </form>
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

