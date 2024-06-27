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
        <div class="breadcrumb-item active"><a href="{{ route('app.pillar.kartar.index') }}">Data PKH</a></div>
        <div class="breadcrumb-item"> Detail Laporan</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Data Laporan PKH</h2>
      <p class="section-lead">Program Keluarg Harapan</p>
      <div class="card">

        {{-- <h2>{{ Auth::user()->office_id }}</h2> --}}

        <ul class="nav nav-pills" role="tablist">
          <li class="text-center nav-item w-50">
            <a class="nav-link active" id="master-tab" data-toggle="tab" href="#dailyReports" role="tab"
              aria-controls="home" aria-selected="true">Laporan Harian</a>
          </li>
          <li class="text-center nav-item w-50">
            <a class="nav-link" id="master-tab" data-toggle="tab" href="#monthlyReports" role="tab"
              aria-controls="home" aria-selected="true">Laporan Bulanan</a>
          </li>
        </ul>

        <div class="pt-0 card-body">
          <div class="tab-content">
            <div class="tab-pane fade show active" id="dailyReports" role="tabpanel" aria-labelledby="dailyReports">
              <div class="p-0 card-header">
                <h4>Data Laporan Harian</h4>
                @role('employee')
                  <a class="btn btn-success" href="{{ route('app.pillar.pkh.report.create') }}" type="button">
                    <i class="fas fa-plus"></i> Tambah Laporan
                  </a>
                  <a class="ml-3 btn btn-outline-danger"
                    href="{{ route('app.pillar.kartar.report.exportReport', ['select' => '1']) }}">
                    <i class="fas fa-file-pdf"></i> Export Laporan
                  </a>
                @endrole
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-md" id="table-data-daily">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Lengkap</th>
                      <th>Periode Laporan</th>
                      <th>Waktu</th>
                      <th>Status</th>
                      @role('employee')
                        <th>Aksi</th>
                      @endrole
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $no = 1;
                    @endphp
                    @foreach ($data_report as $key => $data)
                      @php
                        $isAdmin = false;
                        // Periksa apakah pengguna memiliki peran 'admin'
                        foreach (auth()->user()->roles as $role) {
                            // var_dump($role->name);
                            $isAdmin = false;
                            $isAdminJawaTimur = 0;
                            if ($role->name == 'admin' || $role->name == 'super-admin') {
                                // var_dump(true);
                                $isAdmin = true;
                                $isAdminJawaTimur = 1;
                                break;
                            }
                        }
                      @endphp


                      @if (auth()->user()->name == $data->pkh->name ||
                              ($isAdmin && $data->office_id == Auth::user()->office_id) ||
                              Auth::user()->office_id == $isAdminJawaTimur)
                        @if ($data->type == 'daily')
                          <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->pkh->name }}</td>
                            <td>{{ $data->type == 'daily' ? 'Harian' : 'Bulanan' }}</td>
                            <td>{{ date('d F Y', strtotime($data->date)) }}</td>
                            <td>
                              {{-- Menunggu Persetujuan dari Dinas Sosial Kabupaten/Kota --}}
                              {{ $data->status == \App\Models\Review::STATUS_WAITING_APPROVAL ? 'Menunggu Disetujui' : '' }}
                              {{ $data->status == \App\Models\Review::STATUS_APPROVED ? 'Disetujui' : '' }}
                              {{ $data->status == \App\Models\Review::STATUS_REJECTED ? 'Ditolak' : '' }}
                              {{ $data->status == \App\Models\Review::STATUS_REVISION ? 'Revisi' : '' }}
                            </td>

                            @role('employee')
                              <td>
                                @if ($data->status == 'Revisi')
                                  <a href="{{ route('app.pillar.kartar.report.revisi', $data->id) }}"
                                    class="btn btn-icon btn-warning" title="Edit">Revisi</i></a>
                                @else
                                  <button type="button" class="btn btn-primary btn-detail" data-toggle="modal"
                                    data-target="#detailReportMonthly{{ $key }}">Lihat Detail</button>

                                  {{-- <a href="{{ route('app.pillar.kartar.report.edit', $data->id) }}"
                                    class="btn btn-icon btn-primary" title="Edit">Edit</i></a>
                                  <form action="{{ route('app.pillar.kartar.report.delete', $data->id) }}"
                                    class="formDelete d-inline" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-icon btn-danger">Hapus</button>
                                  </form> --}}
                                @endif
                              </td>
                            @endrole
                          </tr>
                        @endif
                      @endif
                      {{-- Modal --}}
                      <div class="modal fade" id="detailReportMonthly{{ $key }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Detail Laporan Harian</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">

                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Tipe Pelaporan</label>
                                    <input type="text" class="form-control" id="type_report" disabled
                                      value="{{ $data->type == 'daily' ? 'Harian' : 'Bulanan' }}">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="name" disabled
                                      value="{{ $data->pkh->name }}">
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Waktu</label>
                                    <input type="text" class="form-control" id="date" disabled
                                      value="{{ $data->date }}">
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Tempat Kegiatan</label>
                                    <textarea class="form-control" name="" placeholder="Masukkan Tempat Kegiatan" style="min-height: 150px"
                                      disabled>{{ $data->venue }}</textarea>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Aktifitas yang dilakukan</label>
                                    <textarea class="form-control" name="" placeholder="Masukkan Aktivitas yang dilakukan"
                                      style="min-height: 150px" disabled>{{ $data->activity }}</textarea>

                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Kendala</label>
                                    <textarea class="form-control" name="" placeholder="Masukkan Kendala" style="min-height: 150px" disabled>{{ $data->constraint }}</textarea>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Uraian / Keterangan Foto</label>
                                    <textarea class="form-control" name="" placeholder="Masukkan Uraian / Keterangan Foto"
                                      style="min-height: 150px" disabled>{{ $data->description }}</textarea>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Dokumentasi Lapangan</label>
                                      <div class="mb-3 input-group">
                                        <a href="{{ asset('storage/image/pillars/PKH/report/' . $data->attachment_daily) }}"
                                          target="_blank">
                                          <img
                                            src="{{ asset('storage/image/pillars/PKH/report/' . $data->attachment_daily) }}"
                                            class="w-100" alt="">
                                        </a>
                                        {{-- <input type="text" class="form-control" placeholder="Document"
                                          aria-label="" value="{{ $data->document }}" readonly>
                                        <div class="input-group-append">
                                          <a href="{{ asset('storage/image/pillars/kartar/report/' . $data->document) }}"
                                            class="btn btn-primary" type="button">Lihat Dokumen</a>
                                        </div> --}}
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Status</label>
                                      <input type="text" class="form-control" id="status" disabled
                                        value="{{ $data->status == \App\Models\Review::STATUS_WAITING_APPROVAL ? 'Menunggu Disetujui' : '' }}
                              {{ $data->status == \App\Models\Review::STATUS_APPROVED ? 'Disetujui' : '' }}
                              {{ $data->status == \App\Models\Review::STATUS_REJECTED ? 'Ditolak' : '' }}
                              {{ $data->status == \App\Models\Review::STATUS_REVISION ? 'Revisi' : '' }}">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>


            <div class="tab-pane fade" id="monthlyReports" role="tabpanel" aria-labelledby="monthlyReports">
              <div class="p-0 card-header">
                <h4>Data Laporan Bulanan</h4>
                @role('employee')
                  <a class="btn btn-success" href="{{ route('app.pillar.pkh.report.create') }}" type="button">
                    <i class="fas fa-plus"></i> Tambah Laporan
                  </a>
                @endrole
              </div>

              <div class="table-responsive">
                <table class="table table-striped table-md" id="table-data-monthly">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Lengkap</th>
                      <th>Periode Laporan</th>
                      <th>Waktu</th>
                      <th>Status</th>
                      @role('employee')
                        <th width="100px">Aksi</th>
                      @endrole
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $no = 1;
                    @endphp
                    @foreach ($data_report as $key => $data)
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
                      @if (auth()->user()->name == $data->pkh->name ||
                              ($isAdmin && $data->office_id == Auth::user()->office_id) ||
                              Auth::user()->office_id == $isAdminJawaTimur)
                        @if ($data->type == 'monthly')
                          <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->pkh->name }}</td>
                            <td>{{ $data->type == 'monthly' ? 'Harian' : 'Bulanan' }}</td>
                            <td>{{ date('F Y', strtotime($data->month)) }}</td>
                            <td>{{ $data->status }}</td>
                            @role('employee')
                              <td>
                                @if ($data->status == 'Revisi')
                                  <a href="{{ route('app.pillar.kartar.report.edit', $data->id) }}"
                                    class="btn btn-icon btn-warning" title="Edit">Revisi</i></a>
                                @else
                                  <button type="button" class="btn btn-info btn-detail" data-toggle="modal"
                                    data-target="#detailReportMonthly{{ $key }}">Lihat Detail</button>
                                @endif
                              </td>
                            @endrole
                          </tr>
                        @endif
                      @endif

                      {{-- Modal --}}
                      <div class="modal fade" id="detailReportMonthly{{ $key }}" tabindex="-1"
                        role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Detail Laporan Bulanan</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">

                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Tipe Pelaporan</label>
                                    <input type="text" class="form-control" id="type_report" disabled
                                      value="{{ $data->period == 'daily' ? 'Harian' : 'Bulanan' }}">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Karang Taruna</label>
                                    <input type="text" class="form-control" id="name_kartar" disabled
                                      value="{{ $data->name_kartar }}">
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Kabupaten / Kota</label>
                                    <input type="text" class="form-control" id="regency" disabled
                                      value="{{ $data->regency }}">
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Kecamatan</label>
                                    <input type="text" class="form-control" id="distric" disabled
                                      value="{{ $data->distric }}">
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Desa / Kelurahan</label>
                                    <input type="text" class="form-control" id="village" disabled
                                      value="{{ $data->village }}">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Bulan</label>
                                    <input type="text" class="form-control" id="village" disabled
                                      value="{{ $data->month == null ? date('Y') : date('M Y', strtotime($data->month)) }}">
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Dokumen Laporan</label>
                                      <div class="mb-3 input-group">
                                        <input type="text" class="form-control" placeholder="Document"
                                          aria-label="" value="{{ $data->attachment }}" readonly>
                                        <div class="input-group-append">
                                          <a href="{{ asset('storage/image/pillars/kartar/report/' . $data->attachment) }}"
                                            class="btn btn-primary" type="button" target="_blank">Lihat Dokumen</a>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Status</label>
                                      <input type="text" class="form-control" id="status" disabled
                                        value="{{ $data->status }}">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </tbody>
                </table>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush


@push('script')
  <script>
    $(document).ready(function() {
      $('#table-data-daily').DataTable();
      $('#table-data-monthly').DataTable();
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
