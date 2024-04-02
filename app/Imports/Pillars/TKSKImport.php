<?php

namespace App\Imports\Pillars;

use App\Concerns\HandleIndoRegion;
use App\Models\Pillars\TKSK\TKSK;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

/**
 * Class TKSKImport
 * Author: Chrisdion Andrew
 * Date: 8/7/2023
 */

class TKSKImport implements ToModel, WithHeadingRow, WithValidation
{
    use HandleIndoRegion;

    public function __construct(
        protected int $officeId
    ) {
    }

    public function model(array $row)
    {
        return new TKSK([
            'name' => $row['nama_lengkap'],
            'mother_name' => $row['nama_ibu_kandung'],
            'nik' => $row['no_ktp_nik'],
            'membership_number' => $row['niat'],
            'place_of_birth' => $row['tempat_lahir'],
            'date_of_birth' => $row['tanggal_lahir'],
            'gender' => $this->handleGender($row['jenis_kelamin']),
            'address' => $this->handleAddress($row['alamat'], $row['kabupaten_kota'], $row['kecamatan'], $row['desa_kelurahan'], $row['rt'], $row['rw']),
            'phone_number' => $row['no_handphone'],
            'email' => $row['alamat_email'],
            'duty_address' => $this->handleDutyAddress($row['kabkota_lokasi_tugas'], $row['kecamatan_lokasi_tugas']),
            'year_of_appointment' => $row['tahun_pengangkatan'],
            'main_job' => $row['pekerjaan_utama'],
            'bank_accounts' => $this->handleBankAccounts($row['rekening_bank_jatim'], $row['rekening_bank_bni']),
            'is_active' => $row['status_kinerja'],
            'annual_evaluation_grade' => $row['penilaian_tahunan'],
            'office_id' => $this->officeId,
        ]);
    }

    private function handleAddress(?string $full_address, ?string $regency, ?string $district, ?string $village, ?string $rt, ?string $rw): array
    {
        return [
            'full_address' => $full_address,
            'regency' => $this->handleRegency($regency),
            'district' => $this->handleDistrict($district),
            'village' => $this->handleVillage($village),
            'rt' => $rt,
            'rw' => $rw,
        ];
    }

    private function handleDutyAddress(?string $regency, ?string $district): array
    {
        return [
            'regency' => $this->handleRegency($regency),
            'district' => $this->handleDistrict($district),
        ];
    }

    private function handleBankAccounts(?string $bankJatim, ?string $bankBNI): array
    {
        return [
            'bank_jatim' => $bankJatim,
            'bank_bni' => $bankBNI,
        ];
    }

    private function handleGender(string $gender): ?string
    {
        return match ($gender) {
            'L' => 'male',
            'P' => 'female',
            default => null,
        };
    }

    public function rules(): array
    {
        return [
            'nama_lengkap' => 'required|max:255',
            'nama_ibu_kandung' => 'required|max:255',
            'no_ktp_nik' => 'nullable|min:16|max:16|unique:tksks,nik',
            'niat' => 'required|unique:tksks,membership_number',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required|max:255',
            'kabupaten_kota' => 'required|max:255',
            'kecamatan' => 'required|max:255',
            'desa_kelurahan' => 'required|max:255',
            'rt' => 'required|max:255',
            'rw' => 'required|max:255',
            'no_handphone' => 'required|max:255',
            'alamat_email' => 'nullable|email|max:255',
            'kabkota_lokasi_tugas' => 'required|max:255',
            'kecamatan_lokasi_tugas' => 'required|max:255',
            'tahun_pengangkatan' => 'required|max:4',
            'pekerjaan_utama' => 'nullable|max:255',
            'rekening_bank_jatim' => 'nullable|max:255',
            'rekening_bank_bni' => 'nullable|max:255',
            'status_kinerja' => 'nullable|boolean',
            'penilaian_tahunan' => 'nullable',
        ];
    }
}
