<?php

namespace Database\Seeders;

use App\Models\Pillars\ASPD\ASPDQuota;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ASPDQuotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => 'KAB. BANGKALAN',
                'quota' => 4
            ],
            [
                'name' => 'KAB. BANYUWANGI',
                'quota' => 5
            ],
            [
                'name' => 'KAB. BLITAR',
                'quota' => 6
            ],
            [
                'name' => 'KAB. BOJONEGORO',
                'quota' => 6
            ],
            [
                'name' => 'KAB. BONDOWOSO',
                'quota' => 5
            ],
            [
                'name' => 'KAB. GRESIK',
                'quota' => 6
            ],
            [
                'name' => 'KAB. JEMBER',
                'quota' => 6
            ],
            [
                'name' => 'KAB. JOMBANG',
                'quota' => 5
            ],
            [
                'name' => 'KAB. KEDIRI',
                'quota' => 7
            ],
            [
                'name' => 'KOTA BATU',
                'quota' => 2
            ],
            [
                'name' => 'KOTA BLITAR',
                'quota' => 3
            ],
            [
                'name' => 'KOTA KEDIRI',
                'quota' => 3
            ],
            [
                'name' => 'KOTA MADIUN',
                'quota' => 3
            ],
            [
                'name' => 'KOTA MALANG',
                'quota' => 4
            ],
            [
                'name' => 'KOTA MOJOKERTO',
                'quota' => 3
            ],
            [
                'name' => 'KOTA PASURUAN',
                'quota' => 3
            ],
            [
                'name' => 'KOTA PROBOLINGGO',
                'quota' => 3
            ],
            [
                'name' => 'KOTA SURABAYA',
                'quota' => 4
            ],
            [
                'name' => 'KAB. LAMONGAN',
                'quota' => 6
            ],
            [
                'name' => 'KAB. LUMAJANG',
                'quota' => 3
            ],
            [
                'name' => 'KAB. MADIUN',
                'quota' => 6
            ],
            [
                'name' => 'KAB. MAGETAN',
                'quota' => 6
            ],
            [
                'name' => 'KAB. MALANG',
                'quota' => 6
            ],
            [
                'name' => 'KAB. MOJOKERTO',
                'quota' => 4
            ],
            [
                'name' => 'KAB. NGANJUK',
                'quota' => 4
            ],
            [
                'name' => 'KAB. NGAWI',
                'quota' => 6
            ],
            [
                'name' => 'KAB. PACITAN',
                'quota' => 6
            ],
            [
                'name' => 'KAB. PAMEKASAN',
                'quota' => 4
            ],
            [
                'name' => 'KAB. PASURUAN',
                'quota' => 5
            ],
            [
                'name' => 'KAB. PONOROGO',
                'quota' => 5
            ],
            [
                'name' => 'KAB. PROBOLINGGO',
                'quota' => 7
            ],
            [
                'name' => 'KAB. SAMPANG',
                'quota' => 6
            ],
            [
                'name' => 'KAB. SIDOARJO',
                'quota' => 4
            ],
            [
                'name' => 'KAB. SITUBONDO',
                'quota' => 4
            ],
            [
                'name' => 'KAB. SUMENEP',
                'quota' => 5
            ],
            [
                'name' => 'KAB. TRENGGALEK',
                'quota' => 6
            ],
            [
                'name' => 'KAB. TUBAN',
                'quota' => 4
            ],
            [
                'name' => 'KAB. TULUNGAGUNG',
                'quota' => 5
            ],
        ];

        foreach ($datas as $data) {
            ASPDQuota::create($data);
            dump("{$data['name']} created");
        }
    }
}
