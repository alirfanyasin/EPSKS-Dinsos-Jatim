<x-app-layout>
    <section class="section">
        <div class="section-header">
            <h1>Akun</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Akun</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Data Akun</h2>
            <p class="section-lead">Akun Yang Terdaftar</p>
            <div class="card">
                <div class="card-header">
                    <h4>Data Akun</h4>
                    <a href="{{ route('app.account.create') }}" class="btn btn-icon btn-success btn-create" title="Tambah Akun"><i class="fas fa-plus"></i> Tambah Akun</a>
                </div>
                <div class="card-body p-0 m-4">
                    <div class="table-responsive">
                        <table class="table table-striped table-md" id="table-data">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>E-Mail</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>123123</td>
                                    <td>Irwansyah Saputra</td>
                                    <td>aasd@gmail.com</td>
                                    <td>
                                        <a href="{{ route('app.account.edit') }}" class="btn btn-icon btn-primary" title="Edit"><i class="far fa-edit"></i></a>
                                        <a href="#" class="btn btn-icon btn-danger" title="Hapus" data-confirm="Realy?|Do you want to continue?" data-confirm-yes="alert('Deleted :)');"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>123123</td>
                                    <td>Kusnadi</td>
                                    <td>cdd@gmail.com</td>
                                    <td>
                                        <a href="#" class="btn btn-icon btn-primary" title="Edit" data-toggle="modal" data-target="#exampleModal"><i class="far fa-edit"></i></a>
                                        <a href="#" class="btn btn-icon btn-danger" title="Hapus" data-confirm="Realy?|Do you want to continue?" data-confirm-yes="alert('Deleted :)');"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>

@push('css-libraries')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
@endpush
@push('script')
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#table-data').DataTable();
        });
    </script>
@endpush
