@extends('layouts.app')
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>PSKS</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">Dashboard</div>
        <div class="breadcrumb-item active"><a href="{{ route('app.profile.index') }}">Profile Saya</a></div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Profil Saya</h2>
      <p class="section-lead">Ubah Password</p>

      @if ($errors->has('error'))
        <div class="alert alert-danger">
          {{ $errors->first('error') }}
        </div>
      @endif

      <div class="row">
        <div class="col-md-12">
          <div class="p-4 card">
            <form action="{{ route('app.profile.change-password-action') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="current_password" class="form-label">Password</label>
                <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                  name="current_password" id="current_password" autocomplete="none">
                @error('current_password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="new_password" class="form-label">Password Baru</label>
                <input type="password" class="form-control  @error('new_password') is-invalid @enderror"
                  name="new_password" id="new_password">
                @error('new_password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control @error('confirm_password') is-invalid @enderror"
                  name="confirm_password" id="confirm_password">
                @error('confirm_password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="d-flex justify-content-end">
                <div class="row">
                  <div class="col-12">
                    <a type="button" href="{{ route('app.profile.index') }}" class="btn btn-icon btn-danger"
                      title="Batal">Batal</a>
                    <button type="submit" class="btn btn-icon btn-success" title="Simpan">Simpan</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

  </section>
@endsection
