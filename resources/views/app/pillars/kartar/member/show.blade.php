@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>PSKS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.kartar.index') }}">Data Karang Taruna</a>
                </div>
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.kartar.edit', 1) }}">Edit Data</a></div>
                <div class="breadcrumb-item">Detail Data Pengurus</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Detail Data Pengurus Karang Taruna</h2>
            <p class="section-lead">Karang Taruna</p>
            <div class="card">
                <div class="card-header">
                    <h4>Detail Data Pengurus Karang Taruna {{ $data_member->name_member }}</h4>
                </div>
                <div class="card-body">

                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="master-tab" data-toggle="tab" href="#dataMaster" role="tab"
                                aria-controls="home" aria-selected="true">Data Pengurus</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="training-tab" data-toggle="tab" href="#dataTraining" role="tab"
                                aria-controls="profile" aria-selected="false">Data Pelatihan</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent2">
                        <div class="tab-pane fade show active" id="dataMaster" role="tabpanel" aria-labelledby="master-tab">
                            <form action="" method="">
                                {{-- Kartar ID --}}
                                <input type="hidden" name="kartar_id" value="{{ $data->id }}">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nama Lengkap Pengurus</label>
                                            <input type="text"
                                                class="form-control @error('name_member') is-invalid @enderror"
                                                name="name_member" placeholder="Masukkan Nama Lengkap Pengurus"
                                                value="{{ $data_member->name_member }}" readonly>

                                            @error('name_member')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>No. KTP / NIK</label>
                                            <input type="text" class="form-control  @error('nik') is-invalid @enderror"
                                                name="nik" placeholder="Masukkan No. KTP / NIK"
                                                value="{{ $data_member->nik }}" readonly>
                                            @error('nik')
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
                                            <label>Foto KTP</label>

                                            <div class="mb-3 input-group">
                                                <input type="text" class="form-control" placeholder="Foto KTP"
                                                    aria-label="" value="{{ $data_member->photo_identity }}" readonly>
                                                <div class="input-group-append">
                                                    <a href="{{ asset('storage/image/pillars/kartar/member/' . $data_member->photo_identity) }}"
                                                        class="btn btn-primary" type="button">Lihat Foto</a>
                                                </div>
                                            </div>

                                            @error('photo_identity')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <input type="text"
                                                class="form-control  @error('gender') is-invalid @enderror" name="gender"
                                                placeholder="Masukkan Jenis Kelamin" value="{{ $data_member->gender }}"
                                                readonly>

                                            @error('gender')
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
                                            <label>Tempat Lahir</label>
                                            <input type="text"
                                                class="form-control @error('place_of_birth') is-invalid @enderror"
                                                name="place_of_birth" placeholder="Masukkan Tempat Lahir"
                                                value="{{ $data_member->place_of_birth }}" readonly>
                                            @error('place_of_birth')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="date"
                                                class="form-control @error('date_of_birth') is-invalid @enderror"
                                                name="date_of_birth" placeholder="Masukkan Tanggal Lahir"
                                                value="{{ $data_member->date_of_birth }}" readonly>
                                            @error('date_of_birth')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Nomor Telepon</label>
                                            <input type="text"
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                name="phone_number" placeholder="Masukkan Nomor Telepon"
                                                value="{{ $data_member->phone_number }}" readonly>
                                            @error('phone_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Agama</label>
                                            <input type="text"
                                                class="form-control  @error('religion') is-invalid @enderror"
                                                name="religion" placeholder="Masukkan Agama"
                                                value="{{ $data_member->religion }}" readonly>

                                            @error('religion')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Pendidikan Terakhir</label>
                                            <input type="text"
                                                class="form-control  @error('last_education') is-invalid @enderror"
                                                name="last_education" placeholder="Masukkan Agama"
                                                value="{{ $data_member->last_education }}" readonly>

                                            @error('last_education')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Pekerjaan</label>
                                            <input type="text"
                                                class="form-control @error('main_job') is-invalid @enderror"
                                                name="main_job" placeholder="Masukkan Pekerjaan"
                                                value="{{ $data_member->main_job }}" readonly>
                                            @error('main_job')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Alamat Lengkap</label>
                                            <input type="text"
                                                class="form-control @error('address') is-invalid @enderror" name="address"
                                                placeholder="Masukkan Alamat Lengkap" value="{{ $data_member->address }}"
                                                readonly>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Jabatan Dalam Karang Taruna</label>
                                            <input type="text"
                                                class="form-control  @error('position') is-invalid @enderror"
                                                name="position" placeholder="Masukkan Jabatan Dalam Karang Taruna"
                                                value="{{ $data_member->position }}" readonly>
                                            @error('position')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <a type="button" href="{{ route('app.pillar.kartar.edit', $data->id) }}"
                                            class="btn btn-icon btn-danger" title="Batal">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="dataTraining" role="tabpanel" aria-labelledby="training-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-md" id="table-data">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama Pelatihan</th>
                                                    <th>Penyelenggara</th>
                                                    <th>Tanggal</th>
                                                    <th>Sertifikat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($data_training as $data_training_member)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $data_training_member->training_name }}</td>
                                                        <td>{{ $data_training_member->organizer }}</td>
                                                        <td>{{ $data_training_member->date }}</td>
                                                        <td><a href="{{ asset('storage/image/pillars/kartar/certificate/' . $data_training_member->certificate) }}"
                                                                class="text-danger" target="_blank"><i
                                                                    class="far fa-file-pdf"
                                                                    style="font-size: 30px;"></i></a></td>
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
    </section>
@endsection

@push('css-libraries')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
@endpush
@push('script')
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table-data').DataTable();
        });
    </script>
@endpush
