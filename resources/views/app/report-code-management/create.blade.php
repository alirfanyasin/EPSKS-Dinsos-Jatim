@extends('layouts.app')

@push('css-libraries')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>PSKS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.report-code-management.index') }}">Kode
                        Pelaporan</a></div>
                <div class="breadcrumb-item">Generate Kode Pelaporan</div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Generate Kode Pelaporan</h4>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        {{$errors->first()}}
                    </div>
                @endif

                <form action="{{ route('app.report-code-management.store') }}" method="post">
                    @csrf

                    @if (auth()->user()->hasRole('super-admin'))
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Pillar</label>
                                    <select class="form-control @error('pillar') is-invalid @enderror" name="pillar"
                                        required>
                                        <option disabled selected>Pilih Pillar</option>
                                        @foreach ($pillars as $pillar)
                                            <option value="{{ $pillar->id }}">
                                                {{ $pillar->name . ' (' . $pillar->code . ')' }}</option>
                                        @endforeach
                                    </select>
                                    @error('pillar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @elseif(auth()->user()->isDinsosJatim && auth()->user()->pillar_id !== null)
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Pilih Kantor Dinas Sosial</label>
                                    <select name="office_id" id="offices" class="form-control @error('office_id') is-invalid @enderror" required>
                                        <option value="" selected>Pilih Kantor Dinas Sosial</option>
                                        @foreach ($offices as $office)
                                            <option value="{{ $office->id }}">{{ $office->name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">
                                        <li>Kode pelaporan akan digenerate untuk Dinas Sosial yang dipilih</li>
                                    </small>
                                    @error('office_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Berlaku Sampai</label>
                                <input type="date" class="form-control @error('code_expired_date') is-invalid @enderror"
                                    value="{{ old('code_expired_date') }}" name="expired_date" required>
                                @error('code_expired_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a type="button" href="{{ route('app.report-code-management.index') }}"
                                class="mr-2 btn btn-icon btn-danger">Batal</a>
                            <button type="submit" class="btn btn-icon btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('js-libraries')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            $('#offices').select2();
        });
    </script>
@endpush
