<?php

namespace App\Http\Controllers\Pillars\PKH;

use App\Http\Controllers\Controller;
use App\Models\Utilities\Province;
use App\Models\Utilities\Regency;
use Illuminate\Http\Request;

class PKHController extends Controller
{
    public function profile()
    {
        return view('app.pillars.pkh.index', [
            'pageTitle' => 'Data PKH',
        ]);
    }

    public function create()
    {
        $filterProvince = Province::query()->where('name', 'JAWA TIMUR')->firstOrFail();
        $regencies = Regency::query()->where('province_id', $filterProvince->id)->get();
        return view('app.pillars.pkh.create', [
            'pageTitle' => 'Tambah Data PKH',
            'regencies' => $regencies
        ]);
    }
}
