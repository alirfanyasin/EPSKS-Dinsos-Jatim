<x-guest-layout>
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="https://ui-avatars.com/api/?name=E+P" alt="logo" width="100" class="shadow-light rounded-circle">
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="card card-primary">
                        <div class="card-header"><h4>Login Pelaporan</h4></div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('employee.auth.login.authenticate') }}" class="needs-validation" novalidate="">
                                @csrf

                                <div class="form-group">
                                    <div class="d-block">
                                        <label for="password" class="control-label">Kode Pelaporan</label>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="employee_code" tabindex="2" required autocomplete="employee_code" />
                                    <div class="invalid-feedback">
                                        Mohon lengkapi isian kode pelaporan
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Masuk
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="mt-3 text-muted text-center">
                        <a href="{{ route('login') }}">Login Dengan Username</a>
                    </div>
                    <div class="simple-footer">
                        Copyright &copy; e-PSKS JATIM {{ date('Y') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
