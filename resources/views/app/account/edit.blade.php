<x-app-layout>
    <section class="section">
        <div class="section-header">
            <h1>Akun</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.account.index') }}">Akun</a></div>
                <div class="breadcrumb-item">Edit Akun</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Akun</h2>
            <p class="section-lead">Perbaruhi Data Akun</p>
            <div class="card">
                <div class="card-header">
                    <h4>Data Akun Nama</h4>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control" name="" placeholder="Masukkan Nama Lengkap" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control" name="" required>
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                        <option>Option 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>E-Mail</label>
                                    <input type="email" class="form-control" name="" placeholder="Masukkan Email" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a type="button" href="{{ route('app.account.index') }}" class="btn btn-icon btn-danger" title="Batal">Batal</a>
                                <button type="submit" class="btn btn-icon btn-success" title="Simpan">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
