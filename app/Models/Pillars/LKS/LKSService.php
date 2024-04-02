<?php

namespace App\Models\Pillars\LKS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Veelasky\LaravelHashId\Eloquent\HashableId;

class LKSService extends Model
{
    use HasFactory;
    use HashableId;

    public const SERVICE_ANAK_DALAMPANTI = 'LKS Anak Dalam Panti';
    public const SERVICE_ANAK_LUARPANTI = 'LKS Anak Luar Panti';
    public const SERVICE_ABH = 'LKS Anak yang Berhadapan dengan Hukum (ABH)';
    public const SERVICE_DISABILITAS_DALAMPANTI = 'LKS Disabilitas Dalam Panti';
    public const SERVICE_DISABILITAS_LUARPANTI = 'LKS Disabilitas Luar Panti';
    public const SERVICE_GELANDANGAN_DANPENGEMIS = 'LKS Gelandangan dan Pengemis';
    public const SERVICE_KORBAN_NAPZA = 'LKS Korban Penyalahgunaan NAPZA';
    public const SERVICE_LANSIA_DALAMPANTI = 'LKS Lanjut Usia Dalam Panti';
    public const SERVICE_LANSIA_LUARPANTI = 'LKS Lanjut Usia Luar Panti';
    public const SERVICE_AMPK = 'LKS Anak Membutuhkan Perlindungan Khusus (AMPK)';
    public const SERVICE_ODHA = 'LKS Orang dengan HIV/AIDS (ODHA)';
    public const SERVICE_TAMAN_ANAKSEJAHTERA = 'LKS Taman Anak Sejahtera';
    public const SERVICE_TUNA_SOSIAL_DANKORBAN_PERDAGANGAN = 'LKS Tuna Sosial dan Korban Perdagangan Orang';
    public const SERVICE_BWBP_EKSNAPITER = 'LKS BWBP Eks Napiter';

    protected $table = 'lks_services';

    protected $fillable = [
        'lks_id',
        'service',
    ];
}
