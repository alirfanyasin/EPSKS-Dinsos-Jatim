<?php

namespace App\Http\Controllers\Pillars\ASPD;

use App\Http\Controllers\Controller;
use App\Models\Pillars\ASPD\ASPDQuota;
use App\Models\Utilities\Province;
use App\Models\Utilities\Regency;
use Illuminate\Http\Request;

class QuotaController extends Controller
{
    public function index()
    {
        return view('app.pillars.aspd.quota.index', [
            'pageTitle' => 'Data Kuota ASPD',
            'datas' => ASPDQuota::all()
        ]);
    }

    public function create()
    {
        $filterProvince = Province::query()->where('name', 'JAWA TIMUR')->firstOrFail();
        $regencies = Regency::query()->where('province_id', $filterProvince->id)->get();
        return view('app.pillars.aspd.quota.create', [
            'regencies' => $regencies
        ]);
    }

    public function edit($id)
    {
        return view('app.pillars.aspd.quota.edit', [
            'pageTitle' => 'Edit Kuota ASPD',
            'data' => ASPDQuota::find($id)
        ]);
    }

    public function update($id, Request $request)
    {
        $data = ASPDQuota::find($id);
        $data->update(['quota' => $request->quota]);
        return redirect()->route('app.pillar.aspd.quota.index')->with('success', 'Berhasil mengupdate data');
    }

    public function reset($id)
    {
        $data = ASPDQuota::find($id);
        $data->update(['quota' => 0]);
        return redirect()->route('app.pillar.aspd.quota.index')->with('success', 'Berhasil mereset data');
    }
}
