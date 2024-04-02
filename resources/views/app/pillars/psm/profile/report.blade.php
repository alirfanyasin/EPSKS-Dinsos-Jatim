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
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.psm.profile.index') }}">Data PSM</a></div>
                <div class="breadcrumb-item"> Detail Laporan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Data Laporan PSM</h2>
            <p class="section-lead">Pekerja Sosial Masyarakat</p>
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
                                <h4>Data Laporan Harian {{ $psm->name }}</h4>
                                <div class="dropdown d-inline">
                                    <button class="btn btn-info dropdown-toggle" style="margin-left: 10px" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-file-download"></i> Download Data
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item has-icon" href="#"><i class="fas fa-file-pdf"></i> PDF</a>
                                        <a class="dropdown-item has-icon" href="#"><i class="far fa-file-excel"></i> Excel</a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-md" id="dailyReportsTable">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tempat Kejadian</th>
                                        <th>Waktu</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($dailyReports as $key => $dailyReport)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $dailyReport->venue }}</td>
                                            <td>{{ $dailyReport->dailyDate }}</td>
                                            <td>{{ $dailyReport->statusLabel }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="monthlyReports" role="tabpanel" aria-labelledby="monthlyReports">
                            <div class="card-header p-0">
                                <h4>Data Laporan Bulanan {{ $psm->name }}</h4>
                                <div class="dropdown d-inline">
                                    <button class="btn btn-info dropdown-toggle" style="margin-left: 10px" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-file-download"></i> Download Data
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item has-icon" href="#"><i class="fas fa-file-pdf"></i> PDF</a>
                                        <a class="dropdown-item has-icon" href="#"><i class="far fa-file-excel"></i> Excel</a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-md" id="monthlyReportsTable">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIAT</th>
                                        <th>Nama Lengkap</th>
                                        <th>Bulan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($monthlyReports as $key => $monthlyReport)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $monthlyReport->psm->membership_number }}</td>
                                            <td>{{ $monthlyReport->psm->name }}</td>
                                            <td>{{ $monthlyReport->monthlyDate }}</td>
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
        });
    </script>
@endpush

