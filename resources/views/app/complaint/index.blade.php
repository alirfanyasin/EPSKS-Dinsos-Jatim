@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Aduan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Aduan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Data Aduan</h2>
            <p class="section-lead">Aduan Yang Masuk</p>
            <div class="card">
                <div class="card-header">
                    <h4>Data Aduan</h4>
                    <a href="{{ route('app.complaint.create') }}" class="btn btn-icon btn-success" title="Tambah Aduan"><i
                            class="fas fa-plus"></i> Tambah Aduan</a>
                </div>
                <div class="card-body p-0 m-4">
                    <div class="table-responsive">
                        <table class="table table-striped table-md" id="table-data">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Judul</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($aduan as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->user->name }}</td>
                                        <td>{{ $data->title }}</td>
                                        <td>
                                            <a href="#" class="btn btn-icon btn-primary" title="Edit"><i
                                                    class="far fa-edit"></i></a>
                                            <a href="#" class="btn btn-icon btn-warning" title="Tanggapi"><i
                                                    class="fas fa-reply"></i></a>
                                            <a href="{{ route('app.complaint.destroy', ['id' => $data->id]) }}"
                                                class="btn btn-icon btn-danger" title="Hapus"
                                                data-confirm="Realy?|Do you want to continue?"
                                                data-confirm-yes="event.preventDefault(); document.getElementById('delete-form-{{ $data->id }}').submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                            <form id="delete-form-{{ $data->id }}"
                                                action="{{ route('app.complaint.destroy', ['id' => $data->id]) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
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
