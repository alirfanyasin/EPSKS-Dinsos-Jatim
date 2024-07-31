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
      <p class="section-lead">Data Profil Saya</p>

      <div class="row">
        <div class="col-md-4">
          <div class="p-4 card">
            <img alt="image" src="{{ 'https://ui-avatars.com/api/?name=' . auth()->user()->name }}"
              class="mx-auto mr-1 rounded-circle" width="200px" height="200px">

            <div class="mt-3 text-center">
              <h6 class="fw-semibold">{{ auth()->user()->name }}</h6>
              <div class="fw-semibold">{{ auth()->user()->username }}</d>
                <div class="fw-semibold">{{ auth()->user()->email }}</d>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="p-4 card">
            <form action="">
              <div class="mb-3">
                <label for="email" class="form-label">Nama Kantor</label>
                <input type="email" class="form-control" id="email" placeholder="name@example.com"
                  value="{{ auth()->user()->name }}" disabled>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Username</label>
                <input type="email" class="form-control" id="email" placeholder="name@example.com"
                  value="{{ auth()->user()->username }}" disabled>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="name@example.com"
                  value="{{ auth()->user()->email }}" disabled>
              </div>
              @role('super-admin|admin')
                <div class="d-flex justify-content-end">
                  <a href="{{ route('app.profile.change-password') }}" class="btn btn-primary">Ubah Password</a>
                </div>
              @endrole
            </form>
          </div>
        </div>
      </div>

  </section>
@endsection
