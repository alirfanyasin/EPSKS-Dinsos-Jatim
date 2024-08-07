@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>PSKS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.pkh.index') }}">Data PKH</a>
                </div>
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.pkh.edit', 1) }}">Edit Data</a></div>
                <div class="breadcrumb-item">Tambah Data Pelatihan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Tambah Data Pelatihan PKH</h2>
            <p class="section-lead">PKH</p>
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Data Pelatihan PKH {{ $data->name }}</h4>
                </div>
                <div class="card-body">


                    <div class="row">

                        <div class="col-4">
                            <form action="{{ route('app.pillar.pkh.training.store', $data->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                {{-- Kartar ID --}}
                                <input type="hidden" name="pkh_id" value="{{ $data->id }}">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Tambah Data Pelatihan</h4>
                                    </div>
                                    <div class="card-body">
                                        {{-- Member id --}}
                                        <input type="hidden" name="pkh_id" value="{{ $data->id }}">

                                        <div class="form-group">
                                            <label>Nama Pelatihan <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('training_name') is-invalid @enderror"
                                                name="training_name" placeholder="Masukkan Nama Pelatihan" required>

                                            @error('training_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Penyelenggara <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('organizer') is-invalid @enderror"
                                                name="organizer" placeholder="Masukkan Penyelenggara" required>
                                            @error('organizer')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Pelatihan <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control @error('date') is-invalid @enderror"
                                                name="date" placeholder="Masukkan Tanggal Pelatihan" required>
                                            @error('date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Sertifikat <span class="text-danger">*</span></label>
                                            <input type="file"
                                                class="form-control @error('certificate') is-invalid @enderror"
                                                name="certificate" accept=".pdf" required>
                                            @error('certificate')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-icon btn-success btn-block"
                                                title="Tambah">Tambah</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Pelatihan {{ $data->name_member }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md" id="table-data">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Pelatihan</th>
                                                <th>Penyelenggara</th>
                                                <th>date</th>
                                                <th>Sertifikat</th>
                                                <th width="100px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            @foreach ($data_training as $data_training_member)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $data_training_member->training_name }}</td>
                                                    <td>{{ $data_training_member->organizer }}</td>
                                                    <td>{{ $data_training_member->date }}</td>
                                                    <td>
                                                        <a href="{{ asset('storage/image/pillars/kartar/certificate/' . $data_training_member->certificate) }}"
                                                            class="text-danger" target="_blank">
                                                            <i class="far fa-file-pdf" style="font-size: 30px;"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <form
                                                            action="{{ route('app.pillar.pkh.training.delete') }}"
                                                            class="d-inline" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="training_id"
                                                                value="{{ $data_training_member->id }}">
                                                            <input type="hidden" name="pkh_id"
                                                                value="{{ $data->id }}">
                                                            {{-- <input type="hidden" name="kartar_id" value="{{ $data_kartar->id }}"> --}}
                                                            <button class="btn btn-icon btn-danger" type="submit"
                                                                title="Hapus"
                                                                onclick="return confirm('Are you sure you want to delete?');">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        {{-- <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Data Pelatihan</h4>
                    </div>
                    <div class="card-body">
                        <form action="app/pillar/kartar/member/training/{{ $data->id }}">
                            <div class="form-group">
                                <label>Nama Pelatihan</label>
                                <input type="text" class="form-control" name="training_name"
                                    placeholder="Masukkan Nama Pelatihan" required="">
                            </div>
                            <div class="form-group">
                                <label>Penyelenggara</label>
                                <input type="text" class="form-control" name="orgnizer"
                                    placeholder="Masukkan Penyelenggara" required="">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Pelatihan</label>
                                <input type="date" class="form-control" name="date"
                                    placeholder="Masukkan Tanggal Pelatihan" required="">
                            </div>
                            <div class="form-group">
                                <label>Upload Sertifikat</label>
                                <input type="file" class="form-control" name="certificate" required="">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-icon btn-success btn-block"
                                    title="Tambah">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Pelatihan</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Pelatihan</th>
                                    <th>Penyelenggara</th>
                                    <th>Tanggal</th>
                                    <th>Sertifikat</th>
                                    <th>Aksi</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Teknik Mesin</td>
                                    <td>Qubisa</td>
                                    <td>12-07-2023</td>
                                    <td><a href="" class="text-danger"><i class="far fa-file-pdf"></i></a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-icon btn-primary" title="Edit"><i
                                                class="far fa-edit"></i></a>
                                        <a href="#" class="btn btn-icon btn-danger" title="Hapus"
                                            data-confirm="Realy?|Do you want to continue?"
                                            data-confirm-yes="alert('Deleted :)');"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </section>
@endsection
