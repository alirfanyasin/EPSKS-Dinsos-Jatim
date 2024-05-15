<?php

namespace App\Http\Controllers\Pillars\TKSK;

use App\Actions\Pillars\TKSK\TKSKAction;
use App\Http\Controllers\Controller;
use App\Imports\Pillars\TKSKImport;
use App\Models\Office;
use App\Models\Pillars\TKSK\TKSK;
use App\Models\Pillars\TKSK\TKSKReport;
use App\Models\User;
use App\Models\Utilities\Province;
use App\Models\Utilities\Regency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class TKSKController extends Controller
{
    private User $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            if (!Gate::allows('manage-tksk')) {
                abort(403, 'Anda tidak memiliki akses ke halaman ini');
            }

            return $next($request);
        });
    }

    public function index(TKSKAction $action)
    {
        return view('app.pillars.tksk.index', [
            'pageTitle' => 'Data TKSK',
            'tksks' => $action->getQuery()->get(),
        ]);
    }

    public function show(TKSK $tksk)
    {
        return view('app.pillars.tksk.show', [
            'pageTitle' => 'Detail Data TKSK',
            'tksk' => $tksk
        ]);
    }

    public function create()
    {
        $filterProvince = Province::query()->where('name', 'JAWA TIMUR')->firstOrFail();
        $regencies = Regency::query()->where('province_id', $filterProvince->id)->get();
        $offices = Office::query()->whereNot('id', 1)->get(); // except Dinsos Jatim

        return view('app.pillars.tksk.create', [
            'pageTitle' => 'Tambah Data TKSK',
            'regencies' => $regencies,
            'offices' => $offices,
        ]);
    }

    public function store(TKSKAction $action): RedirectResponse
    {
        $command = $action->create();

        return $command
            ? redirect()->route('app.pillar.tksk.index')->with('success', 'Berhasil menambahkan data')
            : redirect()->back()->with('error', 'Gagal menambahkan data')->withInput();
    }

    public function edit(TKSK $tksk)
    {
        $filterProvince = Province::query()->where('name', 'JAWA TIMUR')->firstOrFail();
        $regencies = Regency::query()->where('province_id', $filterProvince->id)->get();
        $offices = Office::query()->whereNot('id', 1)->get(); // except Dinsos Jatim

        return view('app.pillars.tksk.edit', [
            'pageTitle' => 'Edit Data TKSK',
            'tksk' => $tksk,
            'regencies' => $regencies,
            'offices' => $offices,
        ]);
    }

    public function update(TKSK $tksk, TKSKAction $action)
    {
        $command = $action->update($tksk);

        return $command
            ? redirect()->route('app.pillar.tksk.index')->with('success', 'Berhasil mengubah data')
            : redirect()->back()->with('error', 'Gagal mengubah data');
    }

    public function delete(Request $request, TKSK $tksk): RedirectResponse
    {
        $command = (new TKSKAction($request))->delete($tksk);

        return $command
            ? redirect()->route('app.pillar.tksk.index')->with('success', 'Berhasil menghapus data')
            : redirect()->back()->with('error', 'Gagal menghapus data');
    }

    public function report(TKSK $tksk, TKSKAction $action)
    {
        $dailyReports = $action->getReports($tksk, TKSKReport::TYPE_DAILY);
        $monthlyReports = $action->getReports($tksk, TKSKReport::TYPE_MONTHLY);

        return view('app.pillars.tksk.report.detail', [
            'pageTitle' => 'Laporan TKSK',
            'tksk' => $tksk,
            'dailyReports' => $dailyReports,
            'monthlyReports' => $monthlyReports,
        ]);
    }

    public function addReport($id)
    {
        return view('app.pillars.tksk.report.create', [
            'pageTitle' => 'Tambah Laporan TKSK',
        ]);
    }

    public function import()
    {
        return view('app.pillars.tksk.import', [
            'pageTitle' => 'Import Data TKSK',
        ]);
    }

    public function doImport(Request $request)
    {
        $attachment = Storage::disk('local')->put('local/pillars/tksk/data', $request->file('attachment'));

        $command = Excel::import(new TKSKImport(auth()->user()->office->id), $attachment);

        Storage::disk('local')->delete($attachment);

        return $command
            ? redirect()->route('app.pillar.tksk.index')->with('success', 'Berhasil mengimport data')
            : redirect()->back()->with('error', 'Gagal mengimport data');
    }

    public function profile()
    {
        return view('app.pillars.tksk.profile', ['pageTitle' => 'Profile TKSK']);
    }
}
