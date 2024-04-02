<x-app-layout>
    <section class="section">
        <div class="section-header">
            <h1>PSKS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.psm.index') }}">Data PSM</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('app.pillar.psm.report', 1) }}">Detail Laporan</a></div>
                <div class="breadcrumb-item">Tambah Laporan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Tambah Laporan PSM</h2>
            <p class="section-lead">Pekerja Sosial Masyarakat</p>
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Laporan PSM</h4>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title mt-0">Pilih Jenis Laporan</div>
                                <div class="form-group">
                                    <label>Pilih salah satu</label>
                                    <select class="custom-select">
                                        <option disabled selected>Pilih Jenis Laporan</option>
                                        <option value="1">Real Time (Harian)</option>
                                        <option value="2">Bulanan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nama PSM</label>
                                    <input type="text" class="form-control" name="" placeholder="Masukkan Nama Lengkap" value="Jhon Due" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" class="form-control" name="" placeholder="Masukkan NIK" value="1234567890" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Kabupaten / Kota</label>
                                 <input type="text" class="form-control" name="" placeholder="Masukkan Kabupaten / Kota" value="Surabaya" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input type="text" class="form-control" name="" placeholder="Masukkan Kecamatan" value="Sambikerep " disabled>
                                </div>
                            </div>
                            <div class="col-4">
                               <div class="form-group">
                                    <label>Desa / Kelurahan</label>
                                    <input type="text" class="form-control" name="" placeholder="Masukkan Desa / Kelurahan" value="Berigin" disabled>
                               </div>
                            </div>
                        </div>

                        <div class="type-realtime" hidden>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Waktu</label>
                                        <input type="date" class="form-control" name="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Tempat Kegiatan</label>
                                        <input type="text" class="form-control" name="" placeholder="Masukkan Tempat Kegiatan">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Aktivitas yang dilakukan</label>
                                        <input type="text" class="form-control" name="" placeholder="Masukkan Aktivitas yang dilakukan">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Kendala</label>
                                        <input type="text" class="form-control" name="" placeholder="Masukkan Kendala">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Dokumentasi Lapangan</label>
                                        <input type="file" class="form-control" name="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Uraian / Keterangan Foto</label>
                                        <input type="text" class="form-control" name="" placeholder="Masukkan Uraian / Keterangan Foto">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="type-mouthly" hidden>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Bulan</label>
                                        <input type="month" class="form-control" name="" placeholder="Masukkan Bulan">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Dokumen Laporan</label>
                                        <input type="file" class="form-control" name="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a type="button" href="{{ route('app.pillar.psm.report', 1) }}" class="btn btn-icon btn-danger" title="Batal">Batal</a>
                                <button type="submit" class="btn btn-icon btn-success" title="Simpan">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script>
            $('.custom-select').on('change', function () {
                console.log($(this).val());
                if ($(this).val() == 1) {
                    $('.type-realtime').attr('hidden', false);
                    $('.type-mouthly').attr('hidden', true);
                } else {
                    $('.type-realtime').attr('hidden', true);
                    $('.type-mouthly').attr('hidden', false);
                }
            })
        </script>
    @endpush

</x-app-layout>
