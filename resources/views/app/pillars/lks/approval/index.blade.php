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
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.lks.index') }}">LKS</a></div>
                <div class="breadcrumb-item"> Verifikasi Laporan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Verifikasi Laporan LKS</h2>
            <p class="section-lead">Lembaga Kesejahteraan Sosial</p>
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
                                                    <button type="button" class="btn btn-primary btn-review" data-toggle="modal" data-target="#reviewReportDaily{{ $key }}">Verifikasi Laporan</button>

                                                    <div class="modal fade" tabindex="-1" role="dialog" id="reviewReportDaily{{ $key }}" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Laporan Harian</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('app.pillar.lks.approval.store') }}" id="dailyForm" method="post">
                                                                        @csrf

                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail1">Nama LKS</label>
                                                                                    <input type="text" class="form-control" id="niat" value="{{ $dailyReport->lks->name }}" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail1">Kota</label>
                                                                                    <input type="text" class="form-control" id="name" value="{{ $dailyReport->lks->address['regency'] }}" disabled>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail1">Tanggal Pelaporan</label>
                                                                                    <input type="date" class="form-control" id="date" value="{{ $dailyReport->date }}" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail1">Tempat Kejadian</label>
                                                                                    <input type="text" class="form-control" id="venue" value="{{ $dailyReport->venue }}" disabled>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Aktivitas</label>
                                                                            <textarea type="text" class="form-control" id="activity" style="height: 100px" disabled>{{ $dailyReport->activity }}</textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Kendala</label>
                                                                            <textarea type="text" class="form-control" id="constraint" style="height: 100px" disabled>{{ $dailyReport->constraint }}</textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Uraian / Keterangan Foto </label>
                                                                            <textarea type="text" class="form-control" id="constraint" style="height: 100px" disabled>{{ $dailyReport->description }}</textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Lampiran</label>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <img src="{{ asset('storage/pillars/lks/report/daily/'. $dailyReport->attachment) }}" id="attachment" class="img-fluid">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Verifikasi</label>
                                                                            <select name="status" id="approval" class="form-control @error('status') is-invalid @enderror">
                                                                                <option disabled selected>Pilih Aksi</option>
                                                                                <option value="approved">Terima</option>
                                                                                <option value="revision">Revisi</option>
                                                                                <option value="rejected">Tolak</option>
                                                                            </select>
                                                                            <input type="text" value="{{ $dailyReport->hash }}" name="hash" hidden>
                                                                            @error('status')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group revision-note">
                                                                            <label for="exampleInputEmail1">Catatan Revisi</label>
                                                                            <textarea style="height: 100px" class="form-control @error('revision_note') is-invalid @enderror" name="revision_note"></textarea>
                                                                            @error('revision_note')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="d-flex justify-content-end">
                                                                            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Batal</button>
                                                                            <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
                                                                        </div>
                                                                    </form>
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
                        <div class="tab-pane fade" id="monthlyReports" role="tabpanel" aria-labelledby="monthlyReports">
                            <div class="card-header p-0">
                                <h4>Data Laporan Bulanan</h4>
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
                                                    <button type="button" class="btn btn-primary btn-review" data-toggle="modal" data-target="#detailReportMonthly{{ $key }}">Verifikasi Laporan</button>
                                                </td>

                                                <div class="modal fade" id="detailReportMonthly{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Laporan Bulanan</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('app.pillar.lks.approval.store') }}" id="dailyForm" method="post">
                                                                    @csrf
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
                                                                                <embed type="application/pdf" src="{{ asset('storage/pillars/lks/report/monthly/'. $monthlyReport->attachment) }}" width="600" height="400"></embed>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Verifikasi</label>
                                                                        <select name="status" id="approvalMonthly" class="form-control @error('status') is-invalid @enderror">
                                                                            <option disabled selected>Pilih Aksi</option>
                                                                            <option value="approved">Terima</option>
                                                                            <option value="revision">Revisi</option>
                                                                            <option value="rejected">Tolak</option>
                                                                        </select>
                                                                        <input type="text" value="{{ $monthlyReport->hash }}" name="hash" hidden>
                                                                        @error('status')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group revision-note-monthly">
                                                                        <label for="exampleInputEmail1">Catatan Revisi</label>
                                                                        <textarea style="height: 100px" class="form-control @error('revision_note') is-invalid @enderror" name="revision_note"></textarea>
                                                                        @error('revision_note')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="d-flex justify-content-end">
                                                                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
                                                                    </div>
                                                                </form>
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

            $('#approval').change(function () {
                let value = $(this).val();

                if (value === 'revision') {
                    $('.revision-note').slideDown();
                } else {
                    $('.revision-note').slideUp();
                }

            });

            $('#approvalMonthly').change(function () {
                let value = $(this).val();

                if (value === 'revision') {
                    $('.revision-note-monthly').slideDown();
                } else {
                    $('.revision-note-monthly').slideUp();
                }

            });

            // $('.btn-review').click(function () {
            //     let hash = $(this).data('id');

            //     axios.get(route('app.pillar.tksk.report.approval.detail', hash))
            //         .then(function (response) {
            //             let data = response.data.payload;

            //             $('#niat').val(data.tksk.membership_number);
            //             $('#name').val(data.tksk.name);
            //             $('#date').val(data.daily_date);
            //             $('#venue').val(data.venue);
            //             $('#activity').val(data.activity);
            //             $('#constraint').val(data.constraint);
            //             $('#attachment').attr('src', data.daily_attachment);
            //             $('#approval').trigger('change');

            //             $('#reviewModal').modal('show');
            //             $('.btn-submit').data('id', hash);
            //         });
            // });

            // $('.btn-submit').click(function () {
            //     let hash = $(this).data('id');

            //     $('#dailyForm').attr('action', route('app.pillar.tksk.report.approval.store', hash));
            // })
        });
    </script>
@endpush

