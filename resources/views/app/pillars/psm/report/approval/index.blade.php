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
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.psm.profile.index') }}"> PSM</a></div>
                <div class="breadcrumb-item"> Verifikasi Laporan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Verifikasi Laporan PSM</h2>
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
                                <h4>Data Laporan Harian</h4>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-md" id="dailyReportsTable">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>IPSM</th>
                                        <th>Nama Lengkap</th>
                                        <th>Tempat Kejadian</th>
                                        <th>Waktu</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($dailyReports as $key => $dailyReport)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $dailyReport->psm->membership_number }}</td>
                                            <td>{{ $dailyReport->psm->name }}</td>
                                            <td>{{ $dailyReport->venue }}</td>
                                            <td>{{ $dailyReport->dailyDate }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-daily-review" data-id="{{ $dailyReport->hash }}">Verifikasi Laporan</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal fade" id="dailyReviewModal" tabindex="-1" role="dialog" aria-labelledby="dailyReviewModal" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Laporan Harian</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="#" id="dailyForm" method="post">
                                                @csrf

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">IPSM</label>
                                                            <input type="email" class="form-control ipsm" id="ipsm" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Nama Lengkap</label>
                                                            <input type="email" class="form-control name" id="name" disabled>
                                                        </div>
                                                    </div>
                                                </div>
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
                                                    <textarea type="email" class="form-control" id="activity" disabled></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Kendala</label>
                                                    <textarea type="email" class="form-control" id="constraint" disabled></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Lampiran</label>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <img alt="" id="dailyAttachment" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Verifikasi</label>
                                                    <select name="status" id="dailyApproval" class="form-control">
                                                        <option value="approved">Terima</option>
                                                        <option value="revision">Revisi</option>
                                                        <option value="rejected">Tolak</option>
                                                    </select>
                                                </div>
                                                <div class="form-group revision-note">
                                                    <label for="exampleInputEmail1">Catatan</label>
                                                    <textarea class="form-control" name="revision_note" style="min-height: 150px"></textarea>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary btn-daily-submit">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                                        <th>IPSM</th>
                                        <th>Nama Lengkap</th>
                                        <th>Bulan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($monthlyReports as $key => $monthlyReport)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $monthlyReport->psm->membership_number }}</td>
                                            <td>{{ $monthlyReport->psm->name }}</td>
                                            <td>{{ $monthlyReport->monthlyDate }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-monthly-review" data-id="{{ $monthlyReport->hash }}">Verifikasi Laporan</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal fade" id="monthlyReviewModal" tabindex="-1" role="dialog" aria-labelledby="monthlyReviewModal" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Laporan Bulanan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="#" id="monthlyForm" method="post">
                                                @csrf

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">IPSM</label>
                                                            <input type="email" class="form-control ipsm" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Nama Lengkap</label>
                                                            <input type="email" class="form-control name" id="name" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Bulan Pelaporan</label>
                                                            <input type="email" class="form-control date" id="monthlyDate" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Lampiran</label>
                                                            <a id="monthlyAttachment" class="form-control" style="background-color: #e9ecef" disabled>Lihat Lampiran</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Verifikasi</label>
                                                    <select name="status" id="monthlyApproval" class="form-control">
                                                        <option value="approved">Terima</option>
                                                        <option value="revision">Revisi</option>
                                                        <option value="rejected">Tolak</option>
                                                    </select>
                                                </div>
                                                <div class="form-group revision-note">
                                                    <label for="exampleInputEmail1">Catatan</label>
                                                    <textarea class="form-control" name="revision_note" style="min-height: 150px"></textarea>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary btn-monthly-submit">Simpan</button>
                                                </div>
                                            </form>
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
        $(document).ready(function () {
            $('#dailyReportsTable').DataTable();
            $('#monthlyReportsTable').DataTable();

            $('#dailyApproval').change(function () {
                let value = $(this).val();

                if (value === 'revision' || value === 'rejected') {
                    $('.revision-note').slideDown();
                } else {
                    $('.revision-note').slideUp();
                }
            });

            $('.btn-daily-review').click(function () {
                let hash = $(this).data('id');

                axios.get(route('app.pillar.psm.report.approval.detail', hash))
                    .then(function (response) {
                        let data = response.data.payload;

                        $('.ipsm').val(data.psm.membership_number);
                        $('.name').val(data.psm.name);
                        $('#date').val(data.daily_date);
                        $('#venue').val(data.venue);
                        $('#activity').val(data.activity);
                        $('#constraint').val(data.constraint);
                        $('#dailyAttachment').attr('src', data.attachment_path);
                        $('#dailyApproval').trigger('change');

                        $('#dailyReviewModal').modal('show');
                        $('.btn-daily-submit').data('id', hash);
                    });
            });

            $('.btn-daily-submit').click(function () {
                let hash = $(this).data('id');

                $('#dailyForm').attr('action', route('app.pillar.psm.report.approval.store', hash));
            })

            $('#monthlyApproval').change(function () {
                let value = $(this).val();

                if (value === 'revision' || value === 'rejected') {
                    $('.revision-note').slideDown();
                } else {
                    $('.revision-note').slideUp();
                }
            });

            $('.btn-monthly-review').click(function () {
                let hash = $(this).data('id');

                axios.get(route('app.pillar.psm.report.approval.detail', hash))
                    .then(function (response) {
                        let data = response.data.payload;

                        $('.ipsm').val(data.psm.membership_number);
                        $('.name').val(data.psm.name);
                        $('#monthlyDate').val(data.monthly_date);
                        $('#monthlyAttachment').attr('href', data.attachment_path);
                        $('#monthlyApproval').trigger('change');

                        $('#monthlyReviewModal').modal('show');
                        $('.btn-monthly-submit').data('id', hash);
                    });
            });

            $('.btn-monthly-submit').click(function () {
                let hash = $(this).data('id');

                $('#monthlyForm').attr('action', route('app.pillar.psm.report.approval.store', hash));
            })


        });
    </script>
@endpush
