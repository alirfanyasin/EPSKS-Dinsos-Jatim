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
                'name' => 'KABUPATEN BANGKALAN',
                'quota' => 4
            ],
            [
                'name' => 'KABUPATEN BANYUWANGI',
                'quota' => 5
            ],
            [
                'name' => 'KABUPATEN BLITAR',
                'quota' => 6
            ],
            [
                'name' => 'KABUPATEN BOJONEGORO',
                'quota' => 6
            ],
            [
                'name' => 'KABUPATEN BONDOWOSO',
                'quota' => 5
            ],
            [
                'name' => 'KABUPATEN GRESIK',
                'quota' => 6
            ],
            [
                'name' => 'KABUPATEN JEMBER',
                'quota' => 6
            ],
            [
                'name' => 'KABUPATEN JOMBANG',
                'quota' => 5
            ],
            [
                'name' => 'KABUPATEN KEDIRI',
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
                'name' => 'KABUPATEN LAMONGAN',
                'quota' => 6
            ],
            [
                'name' => 'KABUPATEN LUMAJANG',
                'quota' => 3
            ],
            [
                'name' => 'KABUPATEN MADIUN',
                'quota' => 6
            ],
            [
                'name' => 'KABUPATEN MAGETAN',
                'quota' => 6
            ],
            [
                'name' => 'KABUPATEN MALANG',
                'quota' => 6
            ],
            [
                'name' => 'KABUPATEN MOJOKERTO',
                'quota' => 4
            ],
            [
                'name' => 'KABUPATEN NGANJUK',
                'quota' => 4
            ],
            [
                'name' => 'KABUPATEN NGAWI',
                'quota' => 6
            ],
            [
                'name' => 'KABUPATEN PACITAN',
                'quota' => 6
            ],
            [
                'name' => 'KABUPATEN PAMEKASAN',
                'quota' => 4
            ],
            [
                'name' => 'KABUPATEN PASURUAN',
                'quota' => 5
            ],
            [
                'name' => 'KABUPATEN PONOROGO',
                'quota' => 5
            ],
            [
                'name' => 'KABUPATEN PROBOLINGGO',
                'quota' => 7
            ],
            [
                'name' => 'KABUPATEN SAMPANG',
                'quota' => 6
            ],
            [
                'name' => 'KABUPATEN SIDOARJO',
                'quota' => 4
            ],
            [
                'name' => 'KABUPATEN SITUBONDO',
                'quota' => 4
            ],
            [
                'name' => 'KABUPATEN SUMENEP',
                'quota' => 5
            ],
            [
                'name' => 'KABUPATEN TRENGGALEK',
                'quota' => 6
            ],
            [
                'name' => 'KABUPATEN TUBAN',
                'quota' => 4
            ],
            [
                'name' => 'KABUPATEN TULUNGAGUNG',
                'quota' => 5
            ],
        ];

        foreach ($datas as $data) {
            ASPDQuota::create($data);
            dump("{$data['name']} created");
        }
    }
}
