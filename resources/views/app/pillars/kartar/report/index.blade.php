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
        <div class="breadcrumb-item"> Detail Laporan</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Data Laporan Karang Taruna</h2>
      <p class="section-lead">Karang Taruna</p>
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
                  <a class="btn btn-success" href="{{ route('app.pillar.kartar.report.create') }}" type="button">
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
                      <th>Karang Taruna</th>
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


                      @if (auth()->user()->name == $data->name_kartar ||
                              ($isAdmin && $data->office_id == Auth::user()->office_id) ||
                              Auth::user()->office_id == $isAdminJawaTimur)
                        @if ($data->period == '1')
                          <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->name_kartar }}</td>
                            <td>{{ $data->period == '1' ? 'Harian' : 'Bulanan' }}</td>
                            <td>{{ date('d F Y', strtotime($data->date)) }}</td>
                            <td>{{ $data->status }}</td>

                            @role('employee')
                              <td>
                                @if ($data->status == 'Revisi')
                                  <a href="{{ route('app.pillar.kartar.report.revisi', $data->id) }}"
                                    class="btn btn-icon btn-warning" title="Edit">Revisi</i></a>
                                @else
                                  <button type="button" class="btn btn-info btn-detail" data-toggle="modal"
                                    data-target="#detailReportMonthly{{ $key }}">Lihat Detail</button>

                                  <a href="{{ route('app.pillar.kartar.report.edit', $data->id) }}"
                                    class="btn btn-icon btn-primary" title="Edit">Edit</i></a>
                                  <form action="{{ route('app.pillar.kartar.report.delete', $data->id) }}"
                                    class="formDelete d-inline" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-icon btn-danger">Hapus</button>
                                  </form>
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
                                      value="{{ $data->period == '1' ? 'Harian' : 'Bulanan' }}">
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
                                    <label for="exampleInputEmail1">Waktu</label>
                                    <input type="text" class="form-control" id="village" disabled
                                      value="{{ $data->date }}">
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Tempat Kegiatan</label>
                                    <input type="text" class="form-control" id="place" disabled
                                      value="{{ $data->place }}">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Aktifitas yang dilakukan</label>
                                    <input type="text" class="form-control" id="activity" disabled
                                      value="{{ $data->activity }}">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Kendala</label>
                                    <input type="text" class="form-control" id="constraint" disabled
                                      value="{{ $data->constraint }}">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Uraian / Keterangan Foto</label>
                                    <input type="text" class="form-control" id="description" disabled
                                      value="{{ $data->description }}">
                                  </div>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Dokumentasi Lapangan</label>
                                      <div class="mb-3 input-group">
                                        <a href="{{ asset('storage/image/pillars/kartar/report/' . $data->image) }}"
                                          target="_blank">
                                          <img src="{{ asset('storage/image/pillars/kartar/report/' . $data->image) }}"
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


            <div class="tab-pane fade" id="monthlyReports" role="tabpanel" aria-labelledby="monthlyReports">
              <div class="p-0 card-header">
                <h4>Data Laporan Bulanan</h4>
                @role('employee')
                  {{-- <a class="ml-3 btn btn-outline-danger"
                    href="{{ route('app.pillar.kartar.report.exportReport', ['select' => '2']) }}" type="button">
                    <i class="fas fa-file-pdf"></i> Export Laporan
                  </a> --}}
                  {{-- <div class="dropdown d-inline">
                    <button class="border btn border-danger text-danger dropdown-toggle" style="margin-left: 10px"
                      type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">
                      <i class="fas fa-file-download"></i> Export Laporan
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item has-icon"
                        href="{{ route('app.pillar.kartar.report.export_pdf', ['select' => 'bulanan', 'name' => Auth::user()->name]) }}"><i
                          class="fas fa-file-pdf"></i>
                        PDF</a>
                      <a class="dropdown-item has-icon"
                        href="{{ route('app.pillar.kartar.report.export_excel', ['select' => 'bulanan', 'name' => Auth::user()->name]) }}"><i
                          class="far fa-file-excel"></i>
                        Excel</a>
                    </div>
                  </div> --}}
                @endrole
              </div>

              <div class="table-responsive">
                <table class="table table-striped table-md" id="table-data-monthly">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Karang Taruna</th>
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
                      @if (auth()->user()->name == $data->name_kartar ||
                              ($isAdmin && $data->office_id == Auth::user()->office_id) ||
                              Auth::user()->office_id == $isAdminJawaTimur)
                        @if ($data->period == '2')
                          <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->name_kartar }}</td>
                            <td>{{ $data->period == '1' ? 'Harian' : 'Bulanan' }}</td>
                            <td>{{ date('F Y', strtotime($data->month)) }}</td>
                            <td>{{ $data->status }}</td>
                            @role('employee')
                              <td>

                                @if ($data->status == 'Revisi')
                                  <a href="{{ route('app.pillar.kartar.report.edit', $data->id) }}"
                                    class="btn btn-icon btn-warning" title="Edit">Revisi</i></a>
                                @else
                                  <button type="button" class="btn btn-info btn-detail" data-toggle="modal"
                                    data-target="#detailReportYearly{{ $key }}">Lihat Detail</button>

                                  <a href="{{ route('app.pillar.kartar.report.edit', $data->id) }}"
                                    class="btn btn-icon btn-primary" title="Edit">Edit</i></a>
                                  <form action="{{ route('app.pillar.kartar.report.delete', $data->id) }}"
                                    class="formDelete d-inline" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-icon btn-danger">Hapus</button>
                                  </form>
                                @endif
                              </td>
                            @endrole
                          </tr>
                        @endif
                      @endif

                      {{-- Modal --}}
                      <div class="modal fade" id="detailReportYearly{{ $key }}" tabindex="-1"
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
                                      value="{{ $data->period == '1' ? 'Harian' : 'Bulanan' }}">
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
{{--     

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
    @endpush --}}
