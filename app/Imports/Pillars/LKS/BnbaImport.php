<?php

namespace App\Imports\Pillars\LKS;

use App\Models\Pillars\LKS\LKS;
use App\Models\Office;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;
use Auth;

class BnbaImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $owner = null;

        if (Auth::user()->office_id == 1) {
            $office = Office::where('name', 'like', '%'. $row["alamat_kota_lembaga"])->first();
        } else {
            $office = Office::where('id', Auth::user()->office_id)->first();
        }

        if ($row['status_kepemilikan'] == "Pemerintah Pusat / Kemensos") {
            $owner = LKS::OWNER_KEMENSOS;
        }
        else if ($row['status_kepemilikan'] == "Pemerintah Daerah / Dinas Sosial Provinsi") {
            $owner = LKS::OWNER_DINSOSPROV;
        }
        else if ($row['status_kepemilikan'] == "Pemerintah Daerah / Dinas Sosial Kabupaten/Kota") {
            $owner = LKS::OWNER_DINSOSKOTA;
        }
        else if ($row['status_kepemilikan'] == "Masyarakat") {
            $owner = LKS::OWNER_MASYARAKAT;
        }

        $status = 0;

        if ($row['status_kinerja'] == "1") {
            $status = 1;
        }

        $post = new LKS([
            'name' => $row["nama_lembaga"],
            'npwp' => $row["npwp"],
            'since' => $row["tahun_berdiri"],
            'address' => array(
                            'regency' => $row["alamat_kota_lembaga"],
                            'district' => $row["alamat_kecamatan_lembaga"],
                            'village' => $row["alamat_desa_lembaga"],
                            'full_address' => $row["alamat_lengkap_lembaga"],
                            'rw' => $row["alamat_rw_lembaga"],
                            'rt' => $row["alamat_rt_lembaga"],
                        ),
            'owner' => $owner,
            'phone_number' => $row["no_telp_lembaga"],
            'email' => $row["email_lembaga"],
            'leader_name' => $row["nama_pimpinan"],
            'phone_number_leader' => $row["no_hp_pimpinan"],
            'clients' => array(
                                'man' => $row["jumlah_klien_pria"],
                                'girl' => $row["jumlah_klien_perempuan"],
                        ),
            'is_active' => $status,
            'kemenkumham_number' => $row["no_sk_kemenkumham"],
            'sk_date' => $row["tanggal_sk"],
            'notary_name' => $row["nama_notaris"],
            'number_akta' => $row["nomor_akta"],
            'akta_date' => $row["tanggal_akta"],
            'prov_siop_number' => $row["nomor_STP/STPU_provinsi"],
            'prov_siop_date' => $row["tanggal_STP/STPU_provinsi"],
            'regency_siop_number' => $row["nomor_STP/STPU_kota"],
            'regency_siop_date' => $row["tanggal_STP/STPU_kota"],
            'office_id' => $office->id,
        ]);

        return $post;

    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function rules(): array
    {
        return [
            'nama_lembaga' => 'required|max:255',
            'tahun_berdiri' => 'required|max:255',
            'npwp' => 'required|unique:lks,npwp',
            'alamat_kota_lembaga' => 'required',
            'alamat_kecamatan_lembaga' => 'required',
            'alamat_desa_lembaga' => 'required',
            'alamat_lengkap_lembaga' => 'required',
            'alamat_rw_lembaga' => 'required',
            'alamat_rt_lembaga' => 'required',
            'status_kepemilikan' => 'required',
            'no_telp_lembaga' => 'required',
            'email_lembaga' => 'required|unique:lks,email',
            'nama_pimpinan' => 'required|max:255',
            'no_hp_pimpinan' => 'required|max:255',
            'jumlah_klien_pria' => 'required',
            'jumlah_klien_perempuan' => 'required',
            'status_kinerja' => 'required',
            'no_sk_kemenkumham' => 'required',
            'tanggal_sk' => 'required',
            'nama_notaris' => 'required',
            'nomor_akta' => 'required',
            'tanggal_akta' => 'required',
            'nomor_STP/STPU_provinsi' => 'nullable',
            'tanggal_STP/STPU_provinsi' => 'nullable',
            'nomor_STP/STPU_kota' => 'nullable',
            'tanggal_STP/STPU_kota' => 'nullable',
        ];
    }
}
