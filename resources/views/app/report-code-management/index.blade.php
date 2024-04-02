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
                <div class="breadcrumb-item">Generate Kode Pelaporan</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Manajemen Kode Pelaporan</h4>
                    <a class="btn btn-success" href="{{ route('app.report-code-management.create') }}" type="button">
                        <i class="fas fa-plus"></i> Generate Kode
                    </a>
                </div>
                <div class="card-body p-0 m-4">
                    <div class="table-responsive">
                        <table class="table table-striped table-md" id="table-data">
                            <thead>
                            <tr>
                                @if(auth()->user()->isDinsosJatim)
                                    <th>Kantor Dinas Sosial</th>
                                @endif
                                <th>No. Identitas Anggota</th>
                                <th>Nama Lengkap</th>
                                @if(!auth()->user()->isDinsosJatim && auth()->user()->hasRole('super-admin'))
                                    <th>Pillar</th>
                                @endif
                                <th>Kode Pelaporan</th>
                                <th>Masa Berlaku Kode</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $key => $employee)
                                <tr>
                                    @if(auth()->user()->isDinsosJatim)
                                        <td>{{ $employee->office->name }}</td>
                                    @endif
                                    <td>{{ $employee->nip }}</td>
                                    <td>{{ $employee->name }}</td>
                                    @if(!auth()->user()->isDinsosJatim && auth()->user()->hasRole('super-admin'))
                                        <td>{{ $employee->pillar->code }}</td>
                                    @endif
                                    <td>{{ $employee->employee_code }}</td>
                                    <td>{{ $employee->label_expired_date }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
            $('#table-data').DataTable();
        });
    </script>
@endpush
