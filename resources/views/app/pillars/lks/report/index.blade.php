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
                <div class="breadcrumb-item">Data Pelaporan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Data Laporan LKS</h2>
            <p class="section-lead">Lembaga Kesejateraan Sosial</p>
            <div class="card">
                <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item w-50 text-center">
                        <a class="nav-link active" id="master-tab" data-toggle="tab" href="#dailyReports" role="tab" aria-controls="home" aria-selected="true">Laporan Harian</a>
                    </li>
                    <li class="nav-item w-50 text-center">
                        <a class="nav-link" id="master-tab" data-toggle="tab" href="#monthlyReports" role="tab" aria-controls="home" aria-selected="true">Laporan Bulanan</a>
                    </li>
                </ul>
                <div class="card-body pt-0">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="dailyReports" role="tabpanel" aria-labelledby="dailyReports">
                            <div class="card-header p-0">
                                <h4>Data Laporan Harian</h4>
                                @if (Auth::user()->is_employee == 1)
                                    <a class="btn btn-success" href="{{ route('app.pillar.lks.report.create') }}" type="button">
                                        <i class="fas fa-plus"></i> Tambah Laporan
                                    </a>
                                    <a class="btn btn-outline-danger ml-3" href="{{ route('app.pillar.lks.report.exportReport') }}" type="button">
                                        <i class="fas fa-file-pdf"></i> Export Laporan
                                    </a>
                                @endif
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-md" id="dailyReportsTable">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        @if (auth()->user()->is_employee == 0)
                                            <th>Nama LKS</th>
                                        @endif
                                        @if (auth()->user()->hasRole('super-admin'))
                                            <th>Kota</th>
                                        @endif
                                        <th>Tempat Kegiatan</th>
                                        <th>Waktu</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($dailyReports as $key => $dailyReport)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            @if (auth()->user()->is_employee == 0)
                                                <td>{{ $dailyReport->lks->name }}</td>
                                            @endif
                                            @if (auth()->user()->hasRole('super-admin'))
                                                <td>{{ $dailyReport->lks->address['regency'] }}</td>
                                            @endif
                                            <td>{{ $dailyReport->venue }}</td>
                                            <td>{{ date("d M Y", strtotime($dailyReport->date)) }}</td>
                                            <td>{{ $dailyReport->statusLabel }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    {{-- @if($dailyReport->status === 'revision' and auth()->user()->hasRole('employee')) --}}
                                                        <a href="{{ route('app.pillar.lks.report.edit', $dailyReport->hash) }}" style="margin-right: 10px" class="btn btn-info btn-revision" data-id="{{ $dailyReport->hash }}">Edit</a>
                                                    {{-- @else --}}
                                                        <button type="button" class="btn btn-primary btn-detail" data-toggle="modal" data-target="#detailReportDaily{{ $key }}">Lihat Detail</button>
                                                    {{-- @endif --}}
                                                </div>
                                            </td>

                                            <div class="modal fade" id="detailReportDaily{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                                        <label for="exampleInputEmail1">Tanggal Pelaporan</label>
                                                                        <input type="text" class="form-control" id="date" disabled value="{{ date("d M Y", strtotime($dailyReport->date)) }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Tempat Kejadian</label>
                                                                        <input type="text" class="form-control" id="venue" disabled value="{{ $dailyReport->venue }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Aktivitas</label>
                                                                <textarea type="text" style="height: 100px" class="form-control" id="activity" disabled>{{ $dailyReport->activity }}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Kendala</label>
                                                                <textarea type="text" style="height: 100px" class="form-control" id="constraint" disabled>{{ $dailyReport->constraint }}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Uraian / Keterangan Foto</label>
                                                                <textarea type="text" style="height: 100px" class="form-control" id="desc" disabled>{{ $dailyReport->description }}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Lampiran</label>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <img alt="image-daily" src="{{ asset('storage/pillars/lks/report/daily/'. $dailyReport->attachment) }}" id="attachment" class="img-fluid">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="monthlyReports" role="tabpanel" aria-labelledby="monthlyReports">
                            <div class="card-header p-0">
                                <h4>Data Laporan Bulanan</h4>
                                @if (Auth::user()->is_employee == 1)
                                    <a class="btn btn-success" href="{{ route('app.pillar.lks.report.create') }}" type="button">
                                        <i class="fas fa-plus"></i> Tambah Laporan
                                    </a>
                                @endif
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-md" id="monthlyReportsTable">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        @if (auth()->user()->is_employee == 0)
                                            <th>Nama LKS</th>
                                        @endif
                                        @if (auth()->user()->hasRole('super-admin'))
                                            <th>Kota</th>
                                        @endif
                                        <th>Bulan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($monthlyReports as $key => $monthlyReport)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            @if (auth()->user()->is_employee == 0)
                                                <td>{{ $monthlyReport->lks->name }}</td>
                                            @endif
                                            @if (auth()->user()->hasRole('super-admin'))
                                                <td>{{ $monthlyReport->lks->address['regency'] }}</td>
                                            @endif
                                            <td>{{ date("M Y", strtotime($monthlyReport->date)) }}</td>
                                            <td>{{ $monthlyReport->statusLabel }}</td>
                                           <td>
                                                <div class="d-flex">
                                                    @if($monthlyReport->status === 'revision' and auth()->user()->hasRole('employee'))
                                                        <a href="{{ route('app.pillar.lks.report.edit', $monthlyReport->hash) }}" class="btn btn-warning btn-revision" data-id="{{ $monthlyReport->hash }}">Revisi</a>
                                                    @else
                                                        <button type="button" class="btn btn-primary btn-detail" data-toggle="modal" data-target="#detailReportMonthly{{ $key }}">Lihat Detail</button>
                                                    @endif
                                                </div>
                                            </td>

                                            <div class="modal fade" id="detailReportMonthly{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Tanggal Pelaporan</label>
                                                                        <input type="text" class="form-control" id="date" disabled value="{{ date("M Y", strtotime($monthlyReport->date)) }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Lampiran</label>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <embed type="application/pdf" src="{{ asset('storage/pillars/lks/report/monthly/'. $monthlyReport->attachment) }}" width="600" height="400"></embed>>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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
    </section>
@endsection

@push('js-libraries')
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
@endpush

@push('script')
    <script>
        $(document).ready(function () {
            $('#dailyReportsTable').DataTable();
            $('#monthlyReportsTable').DataTable();

            // $('.btn-detail').click(function () {
            //     let hash = $(this).data('id');

            //     axios.get(route('app.employee.report.show', hash))
            //         .then(function (response) {
            //             let data = response.data.payload;

            //             console.log(data)

            //             $('#date').val(data.daily_date);
            //             $('#venue').val(data.venue);
            //             $('#activity').val(data.activity);
            //             $('#constraint').val(data.constraint);
            //             $('#attachment').attr('src', data.daily_attachment);

            //             $('#detailModal').modal('show');
            //         })
            // })
        });
    </script>
@endpush

