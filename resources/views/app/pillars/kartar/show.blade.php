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
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.kartar.index') }}">Data Karang
                        Taruna</a></div>
                <div class="breadcrumb-item">Detail Data</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Detail Data Karang Taruna</h2>
            <p class="section-lead">Karang Taruna</p>
            <div class="card">
                <div class="card-header">
                    <h4>Detail Data Karang Taruna {{ $data->nama_kartar }}</h4>
                </div>
                <div class="card-body">

                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="master-tab" data-toggle="tab" href="#dataMaster" role="tab"
                                aria-controls="home" aria-selected="true">Data Karang Taruna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="training-tab" data-toggle="tab" href="#dataTraining" role="tab"
                                aria-controls="profile" aria-selected="false">Data Pengurus</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent2">
                        <div class="tab-pane fade show active" id="dataMaster" role="tabpanel" aria-labelledby="master-tab">
                            <form action="">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Nama Karang Taruna</label>
                                            <input type="text" class="form-control" name=""
                                                placeholder="Masukkan Karang Taruna" value="{{ $data->nama_kartar }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Alamat Lengkap Sekretariat</label>
                                            <input type="text" class="form-control" name=""
                                                placeholder="Masukkan Alamat Lengkap Sekretariat"
                                                value="{{ $data->alamat_sekretariat }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Foto Tampak Depan Sekretariat</label>
                                            <div class="mb-3 input-group">
                                                <input type="text" class="form-control"
                                                    placeholder="Foto tampak depan sekretariat" aria-label=""
                                                    value="{{ $data->foto_sekretariat }}" readonly>
                                                <div class="input-group-append">
                                                    <a href="{{ asset('storage/image/pillars/kartar/profile/' . $data->foto_sekretariat) }}"
                                                        class="btn btn-primary" type="button">Lihat Foto</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="section-title">Lokasi Tugas</div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Kabupaten / Kota</label>
                                            <input type="text" class="form-control" name=""
                                                value="{{ $data->kota }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Kecamatan</label>
                                            <input type="text" class="form-control" name=""
                                                value="{{ $data->kecamatan }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Desa / Kelurahan</label>
                                            <input type="text" class="form-control" name=""
                                                value="{{ $data->desa }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>No. Telp Sekretariat</label>
                                            <input type="text" class="form-control" name=""
                                                value="{{ $data->no_telp_sekretariat }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Alamat Email Karang Taruna</label>
                                            <input type="email" class="form-control" name=""
                                                value="{{ $data->email_kartar }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="section-title">Surat Keterangan Karang Taruna</div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nomor SK</label>
                                            <input type="text" class="form-control" name=""
                                                value="{{ $data->no_sk }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Tanggal SK</label>
                                            <input type="date" class="form-control"
                                                name=""value="{{ $data->tanggal_sk }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Penandatangan SK</label>
                                            <input type="text" class="form-control" name=""
                                                value="{{ $data->penandatangan_sk }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Selaku</label>
                                            <input type="text" class="form-control" name=""
                                                value="{{ $data->selaku }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>File SK</label>
                                            <div class="mb-3 input-group">
                                                <input type="text" class="form-control" placeholder="Nama File SK"
                                                    aria-label="" value="{{ $data->file_sk }}" readonly>
                                                <div class="input-group-append">
                                                    <a href="{{ asset('storage/image/pillars/kartar/profile/' . $data->file_sk) }}"
                                                        class="btn btn-primary" type="button">Lihat File</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="section-title">Informasi Pengurus Karang Taruna</div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Nama Ketua Karang Taruna</label>
                                            <input type="text" class="form-control" name=""
                                                value="{{ $data->nama_ketua_kartar }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>No. Telp / Whatsapp Ketua</label>
                                            <input type="number" class="form-control" name=""
                                                value="{{ $data->no_telp_wa }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Foto Ketua</label>

                                            <div class="mb-3 input-group">
                                                <input type="text" class="form-control" placeholder="Foto ketua"
                                                    aria-label="" value="{{ $data->foto_ketua }}" readonly>
                                                <div class="input-group-append">
                                                    <a href="{{ asset('storage/image/pillars/kartar/profile/' . $data->foto_ketua) }}"
                                                        class="btn btn-primary" type="button">Lihat Foto</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Jumlah Pengurus Laki-Laki</label>
                                            <input type="text" class="form-control" name=""
                                                value="{{ $data->jumlah_pengurus_laki_laki }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Jumlah Pengurus Perempuan</label>
                                            <input type="text" class="form-control" name=""
                                                value="{{ $data->jumlah_pengurus_perempuan }} "readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Jumlah Anggota Laki-Laki</label>
                                            <input type="text" class="form-control" name=""
                                                value="{{ $data->jumlah_anggota_laki_laki }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Jumlah Anggota Perempuan</label>
                                            <input type="text" class="form-control" name=""
                                                value="{{ $data->jumlah_anggota_perempuan }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Klasifikasi Karang Taruna</label>
                                            <select class="form-control" name="klasifikasi_kartar" required disabled>
                                                <option {{ $data->klasifikasi_kartar == 'Tumbuh' ? 'selected' : '' }}>
                                                    Tumbuh
                                                </option>
                                                <option {{ $data->klasifikasi_kartar == 'Berkembang' ? 'selected' : '' }}>
                                                    Berkembang
                                                </option>
                                                <option {{ $data->klasifikasi_kartar == 'Maju' ? 'selected' : '' }}>Maju
                                                </option>
                                                <option {{ $data->klasifikasi_kartar == 'Percontohan' ? 'selected' : '' }}>
                                                    Percontohan
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Status Kinerja</label>
                                            <select class="form-control" name="status_kinerja" required disabled>
                                                <option {{ $data->status_kinerja == 'Aktif' ? 'selected' : '' }}>Aktif
                                                </option>
                                                <option {{ $data->status_kinerja == 'Tidak Aktif' ? 'selected' : '' }}>
                                                    Tidak Aktif
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <a type="button" href="{{ route('app.pillar.kartar.index') }}"
                                            class="btn btn-icon btn-danger" title="Kembali">Kembali</a>
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
                                                    <th>Nama Pengurus</th>
                                                    <th>NIK</th>
                                                    <th>Jabatan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($data_member as $member)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $member->name_member }}</td>
                                                        <td>{{ $member->nik }}</td>
                                                        <td>{{ $member->position }}</td>
                                                        <td>
                                                            <div class="flex-row d-flex">
                                                                <a href="{{ route('app.pillar.kartar.member.show', ['member_id' => $member->id, 'kartar_id' => $data->id]) }}"
                                                                    class="btn btn-icon btn-info btn-sm w-100"
                                                                    title="Detail">Detail</a>
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
    </script>
@endpush
