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
      <h2 class="section-title">Data Laporan {{ auth()->user()->pillar->code }}</h2>
      <p class="section-lead">{{ auth()->user()->pillar->name }}</p>
      <div class="card">
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
                <a class="btn btn-success" href="{{ route('app.employee.report.create') }}" type="button">
                  <i class="fas fa-plus"></i> Tambah Laporan
                </a>
                <a class="ml-3 btn btn-outline-danger" href="{{ route('app.employee.report.export') }}" type="button">
                  <i class="fas fa-file-pdf"></i> Export Laporan
                </a>
              </div>

              <div class="table-responsive">
                <table class="table table-striped table-md" id="dailyReportsTable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tempat Kejadian</th>
                      <th>Waktu</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($dailyReports as $key => $dailyReport)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $dailyReport->venue }}</td>
                        <td>{{ $dailyReport->dailyDate }}</td>
                        <td>{{ $dailyReport->statusLabel }}</td>
                        <td>
                          <div class="d-flex">
                            @if ($dailyReport->status === 'revision')
                              <a href="{{ route('app.employee.report.edit', $dailyReport->hash) }}"
                                class="btn btn-warning btn-revision" data-id="{{ $dailyReport->hash }}">Revisi</a>
                            @else
                              <button type="button" class="btn btn-primary btn-daily-detail"
                                data-id="{{ $dailyReport->hash }}">Lihat Detail</button>
                            @endif
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="modal fade" id="detailDailyModal" tabindex="-1" role="dialog"
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
                            <label for="exampleInputEmail1">Tanggal Pelaporan</label>
                            <input type="email" class="form-control" id="date" disabled>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Tempat Kejadian</label>
                            <input type="email" class="form-control" id="venue" disabled>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Aktivitas</label>
                        <textarea type="email" class="form-control" id="activity" style="min-height: 100px;" disabled></textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Kendala</label>
                        <textarea type="email" class="form-control" id="constraint" style="min-height: 100px" disabled></textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Lampiran</label>
                        <div class="row">
                          <div class="col-md-4">
                            <img alt="" id="attachment" class="img-fluid">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="monthlyReports" role="tabpanel" aria-labelledby="monthlyReports">
              <div class="p-0 card-header">
                <h4>Data Laporan Bulanan</h4>
                <a class="btn btn-success" href="{{ route('app.employee.report.create') }}" type="button">
                  <i class="fas fa-plus"></i> Tambah Laporan
                </a>
              </div>

              <div class="table-responsive">
                <table class="table table-striped table-md" id="monthlyReportsTable">
                  <thead>
                    <tr>
                      <th>No</th>
                      {{--                                        <th>NIAT</th> --}}
                      <th>Nama Lengkap</th>
                      <th>Bulan</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($monthlyReports as $key => $monthlyReport)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        {{--                                            <td>{{ $monthlyReport->tksk->membership_number }}</td> --}}
                        @if (auth()->user()->pillar->id === \App\Models\Pillars\Pillar::PILLAR_TKSK)
                          <td>{{ $monthlyReport->tksk->name }}</td>
                        @else
                          <td>{{ $monthlyReport->psm->name }}</td>
                        @endif
                        <td>{{ $monthlyReport->monthlyDate }}</td>
                        <td>{{ $monthlyReport->statusLabel }}</td>
                        <td>
                          <div class="d-flex">
                            @if ($monthlyReport->status === 'revision')
                              <a href="{{ route('app.employee.report.edit', $monthlyReport->hash) }}"
                                class="btn btn-warning btn-revision" data-id="{{ $dailyReport->hash }}">Revisi</a>
                            @else
                              <button type="button" class="btn btn-primary btn-monthly-detail"
                                data-id="{{ $monthlyReport->hash }}">Lihat Detail</button>
                            @endif
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="modal fade" id="detailMonthlyModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Detail Laporan Bulanan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Bulan Pelaporan</label>
                        <input type="email" class="form-control date" id="monthlyDate" disabled>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Lampiran</label>
                        <a id="monthlyAttachment" class="form-control" style="background-color: #e9ecef" disabled>Lihat
                          Lampiran</a>
                      </div>
                    </div>
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
      $('#dailyReportsTable').DataTable();
      $('#monthlyReportsTable').DataTable();

      $('.btn-daily-detail').click(function() {
        let hash = $(this).data('id');

        axios.get(route('app.employee.report.show', hash))
          .then(function(response) {
            let data = response.data.payload;

            $('#date').val(data.daily_date);
            $('#venue').val(data.venue);
            $('#activity').val(data.activity);
            $('#constraint').val(data.constraint);
            $('#attachment').attr('src', data.attachment_path);

            $('#detailDailyModal').modal('show');
          })
      })

      $('.btn-monthly-detail').click(function() {
        let hash = $(this).data('id');

        axios.get(route('app.employee.report.show', hash))
          .then(function(response) {
            let data = response.data.payload;

            $('#monthlyDate').val(data.monthly_date);
            $('#monthlyAttachment').attr('href', data.attachment_path);

            $('#detailMonthlyModal').modal('show');
          })
      })
    });
  </script>
@endpush
