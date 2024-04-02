@extends('layouts.app')

@section('content')
    <section class="section">
        {{-- Breadcrumb --}}
        <div class="section-header">
            <h1>PSKS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Profile TKSK</div>
            </div>
        </div>

        {{-- Pengantar --}}
        <div class="section-body">
            <h2 class="section-title">Tentang TKSK</h2>
            <p class="section-lead">Tenaga Kerja Sosial Kecamatan</p>
            <div class="card">
                <div class="card-header">
                    <h4>Pengertian TKSK</h4>
                </div>
                <div class="card-body p-0 mx-4 mb-4">
                    <p>TKSK adalah seseorang yang diberu tugas, fungsi, dan kewenangan oleh pemerintah untuk jangka
                        waktu
                        tertentu, untuk melaksanakan dan/atau membantu penyelenggaraan kesejahteraan sosial sesuai
                        dengan
                        wilayah penugasan di kecamatan</p>
                    <small>Permensos Nomor 24 Tahun 2013</small>

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Deskripsi TKSK</h4>
                </div>
                <div class="card-body p-0 mx-4 mb-4">
                    <p>TKSK Jawa Timur merupakan tim kerja sosial yang berfokus pada pelayanan sosial di
                        kecamatan-kecamatan di Jawa Timur. Kami bertujuan untuk memberikan bantuan, pemulihan,
                        pemberdayaan, dan perlindungan sosial kepada masyarakat di wilayah kerja kami.</p>
                </div>
            </div>


            <h2 class="section-title">Wilayah Kerja</h2>
            <div class="card">
                <div class="card-header">
                    <h4>Wilayah</h4>
                </div>
                <div class="card-body p-0 m-4">
                    <div class="table-responsive">
                        <table class="table table-striped table-md" id="table-data">
                            <thead>
                                <tr>
                                    <td>Kabupaten/Kota</td>
                                    <td>Total Kecamatan</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Bangkalan</td>
                                    <td>18 Kecamatan</td>
                                </tr>
                                <tr>
                                    <td>Banyuwangi</td>
                                    <td>25 Kecamatan</td>
                                </tr>
                                <tr>
                                    <td>Blitar</td>
                                    <td>22 Kecamatan</td>
                                </tr>
                                <tr>
                                    <td>Bojonegoro</td>
                                    <td>11 Kecamatan</td>
                                </tr>
                                <tr>
                                    <td>Banyuwangi</td>
                                    <td>25 Kecamatan</td>
                                </tr>
                                <tr>
                                    <td>Bondowoso</td>
                                    <td>23 Kecamatan</td>
                                </tr>
                                <tr>
                                    <td>Gresik</td>
                                    <td>18 Kecamatan</td>
                                </tr>
                                <tr>
                                    <td>Jember</td>
                                    <td>31 Kecamatan</td>
                                </tr>
                                <tr>
                                    <td>Jombang</td>
                                    <td>21 Kecamatan</td>
                                </tr>
                                <tr>
                                    <td>Kediri</td>
                                    <td>26 Kecamatan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <h2 class="section-title">Program dan Layanan</h2>
            <div class="card">
                <div class="card-header ">
                    <h4>Program</h4>
                </div>
                <div class="card-body p-0 mx-4 ">
                    <p>Program TKSK antara lain :</p>
                    <ul>
                        <li>Bantuan Sosial: Penyaluran bantuan sosial kepada masyarakat yang membutuhkan.</li>
                        <li>Pemberdayaan Masyarakat: Program pelatihan keterampilan, pendampingan usaha mikro, dan
                            kegiatan pemberdayaan ekonomi.</li>
                    </ul>
                </div>
                <hr>

                <div class="card-header ">
                    <h4>Layanan</h4>
                </div>
                <div class="card-body p-0 mx-4 mb-4">
                    <p>Layanan TKSK antara lain :</p>
                    <ul>
                        <li>Penyuluhan Sosial: Kegiatan penyuluhan tentang kesehatan, pendidikan, keamanan, dan masalah
                            sosial lainnya.</li>
                        <li>Pendampingan Keluarga: Bimbingan dan pendampingan dalam mengatasi masalah keluarga.</li>
                        <li>Rehabilitasi Sosial: Program rehabilitasi dan reintegrasi sosial bagi individu yang
                            mengalami kesulitan.</li>
                    </ul>
                </div>
            </div>

            <h2 class="section-title">Kontak dan Informasi tambahan</h2>
            <div class="card">
                <div class="card-header">
                    <h4>Alamat</h4>
                </div>
                <div class="card-body p-0 mx-4 mb-0">
                    <h6>Alamat Pusat</h6>
                    <p>Jl. Contoh No. 123, Surabaya, Jawa Timur</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Kontak</h4>
                </div>
                <div class="card-body p-0 mx-4 mb-0">
                    <h6>Telepon</h6>
                    <p>(031) 1234567</p>
                    <h6>Email</h6>
                    <p>info@tkskjatim.go.id</p>
                </div>

            </div>

        </div>

    </section>
@endsection
