<?php

namespace App\Http\Controllers\Pillars\PSM;

use App\Actions\Pillars\PSM\PSMAction;
use App\Http\Controllers\Controller;
use App\Models\Office;
use App\Models\Pillars\PSM\PSM;
use App\Models\Pillars\PSM\PSMReport;
use App\Models\Utilities\Province;
use App\Models\Utilities\Regency;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class PSMProfileController
 * Author: Chrisdion Andrew
 * Date: 8/9/2023
 */

class PSMProfileController extends Controller
{
    public function index()
    {
        return view('app.pillars.psm.profile.index', [
            'pageTitle' => 'Data PSM',
            'psms' => (new PSMAction())->getQuery()->get(),
        ]);
    }

    public function show(PSM $psm)
    {
        return view('app.pillars.psm.profile.show', [
            'pageTitle' => 'Detail Data PSM',
            'psm' => $psm
        ]);
    }

    public function create()
    {
        $filterProvince = Province::query()->where('name', 'JAWA TIMUR')->firstOrFail();
        $regencies = Regency::query()->where('province_id', $filterProvince->id)->get();
        $offices = Office::query()->whereNot('id', 1)->get(); // except Dinsos Jatim

        return view('app.pillars.psm.profile.create', [
            'pageTitle' => 'Tambah Data PSM',
            'regencies' => $regencies,
            'offices' => $offices,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $command = (new PSMAction($request))->create();

        return $command
            ? redirect()->route('app.pillar.psm.profile.index')->with('success', 'Berhasil menambahkan data')
            : redirect()->back()->with('error', 'Gagal menambahkan data')->withInput();
    }

    public function edit(PSM $psm)
    {
        $filterProvince = Province::query()->where('name', 'JAWA TIMUR')->firstOrFail();
        $regencies = Regency::query()->where('province_id', $filterProvince->id)->get();
        $offices = Office::query()->whereNot('id', 1)->get(); // except Dinsos Jatim

        return view('app.pillars.psm.profile.edit', [
            'pageTitle' => 'Edit Data PSM',
            'psm' => $psm,
            'regencies' => $regencies,
            'offices' => $offices,
        ]);
    }

    public function update(Request $request, PSM $psm): RedirectResponse
    {
        $command = (new PSMAction($request))->update($psm);

        return $command
            ? redirect()->route('app.pillar.psm.profile.index')->with('success', 'Berhasil mengubah data')
            : redirect()->back()->with('error', 'Gagal mengubah data')->withInput();
    }

    public function delete(PSM $psm): RedirectResponse
    {
        $command = (new PSMAction())->delete($psm);

        return $command
            ? redirect()->route('app.pillar.psm.profile.index')->with('success', 'Berhasil menghapus data')
            : redirect()->back()->with('error', 'Gagal menghapus data');
    }

    public function report(PSM $psm, PSMAction $action)
    {
        $dailyReports = $action->getReports($psm, PSMReport::TYPE_DAILY);
        $monthlyReports = $action->getReports($psm, PSMReport::TYPE_MONTHLY);

        return view('app.pillars.psm.profile.report', [
            'pageTitle' => 'Laporan PSM',
            'psm' => $psm,
            'dailyReports' => $dailyReports,
            'monthlyReports' => $monthlyReports,
        ]);
    }
}
