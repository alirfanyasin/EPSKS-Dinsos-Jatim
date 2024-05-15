<?php

namespace App\Imports;

use App\Models\Pillars\Kartar\KarangTaruna;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KartarImport implements ToModel, WithHeadingRow
{
    public function __construct(
        protected int $officeId
    ) {
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new KarangTaruna([
            'nama_kartar' => $row['nama_karang_taruna'],
            'alamat_sekretariat' => $row['alamat_lengkap_sekretariat'],
            'foto_sekretariat' => '',
            'kota' => $row['kabupaten'],
            'kecamatan' => $row['kecamatan'],
            'desa' => $row['desa'],
            'no_telp_sekretariat' => $row['nomor_telepon_sekretariat'],
            'email_kartar' => $row['alamat_email_karang_taruna'],
            'no_sk' => $row['nomor_sk'],
            'tanggal_sk' => date('Y-m-d', strtotime($row['tanggal_bulan_tahun_sk'])),
            // 'tanggal_sk' => $row['tanggal_bulan_tahun_sk'],
            'penandatangan_sk' => $row['penandatangan_sk'],
            'selaku' => $row['selaku'],
            'file_sk' => '',
            'nama_ketua_kartar' => $row['nama_ketua_karang_taruna'],
            'no_telp_wa' => $row['nomor_telepon_ketua'],
            'foto_ketua' => '',
            'jumlah_anggota_laki_laki' => $row['jumlah_pengurus_laki_laki'],
            'jumlah_anggota_perempuan' => $row['jumlah_pengurus_perempuan'],
            'jumlah_pengurus_laki_laki' => $row['jumlah_anggota_laki_laki'],
            'jumlah_pengurus_perempuan' => $row['jumlah_anggota_perempuan'],
            'klasifikasi_kartar' => $row['klasifikasi_karang_taruna'],
            'status_kinerja' => $row['status_kinerja'],
            'status' => '',
            'office_id' => $this->officeId,
            // 'office_id' => Auth::user()->office_id,
        ]);
    }
}
