@extends('layouts.app')

@push('css-libraries')
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
  <style>
    .kbw-signature {
      width: 100%;
      height: 200px;
    }

    #sig canvas {
      width: 100% !important;
      height: auto;
    }

    #clear {
      margin-left: 20px
    }
  </style>
@endpush

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>PSKS</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('app.pillar.lks.report.index') }}">Data Pelaporan</a></div>
        <div class="breadcrumb-item">Export Laporan</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Export Laporan {{ auth()->user()->pillar->code }}</h2>
      <p class="section-lead">{{ auth()->user()->pillar->name }}</p>
      @if ($errors->any())
        <div class="row">
          <div class="col">
            <div class="alert alert-warning d-flex align-items-center" role="alert">
              <div style="width: 30px; height: 30px" class="mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                </svg>
              </div>
              <div class="fw-bold">
                Gagal Export Laporan <br>
                <p>{{ $errors->first() }}</p>
              </div>
            </div>
          </div>
        </div>
      @endif
      <div class="card">
        <div class="card-header">
          <h4>Form Export Laporan</h4>
        </div>

        {{-- <h1>{{ $data['date'] }}</h1> --}}

        <div class="card-body">
          <form action="{{ route('app.pillar.pkh.report.export_pdf', ['nip' => Auth::user()->nip]) }}" method="POST">
            @csrf
            <input type="hidden" name="office_id" value="{{ Auth::user()->office_id }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="type" value="{{ $data['type'] }}">
            <input type="hidden" name="date" value="{{ $data['date'] }}">
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label>Nama Lengkap</label>
                  <input type="text" class="form-control" name="name_kartar" value="{{ auth()->user()->name }}"
                    readonly>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>No. Indetitas {{ auth()->user()->pillar->code }}</label>
                  <input type="text" class="form-control" name="no_id" value="{{ auth()->user()->nip }}" readonly>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="">Pilih Bulan Laporan</label>
                  <input type="month" class="form-control @error('month') is-invalid @enderror" name="month" required>
                  @error('month')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <a type="button" href="{{ route('app.pillar.pkh.report.index') }}" class="btn btn-icon btn-danger"
                  title="Batal">Batal</a>
                <button type="submit" class="btn btn-icon btn-success" title="Simpan">Export</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('js-libraries')
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
@endpush

@push('script')
  <script type="text/javascript">
    var sig = $('#sig').signature({
      syncField: '#signature',
      syncFormat: 'PNG'
    });
    $('#clear').click(function(e) {
      e.preventDefault();
      sig.signature('clear');
      $("#signature").val('');
    });
  </script>
@endpush
