<?php

namespace App\Http\Controllers;

use App\Actions\ReportCodeManagementAction;
use App\Models\Office;
use App\Models\Pillars\Pillar;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class ReportCodeController
 * Author: Chrisdion Andrew
 * Date: 6/29/2023
 */

class ReportCodeManagementController extends Controller
{
    public function index(ReportCodeManagementAction $action)
    {
        $employees = auth()->user()->pillar_id === null
            ? $action->getEmployeeByOffice()
            : $action->getEmployeeByPillar();

        return view('app.report-code-management.index', [
            'pageTitle' => 'Kode Laporan',
            'employees' => $employees,
        ]);
    }

    public function create()
    {
        $pillars = Pillar::query()->get();
        $offices = Office::query()->whereNot('id', 1)->get(); // except Dinsos Jatim

        return view('app.report-code-management.create', [
            'pageTitle' => 'Generate Kode Laporan',
            'pillars' => $pillars,
            'offices' => $offices,
        ]);
    }

    /**
     * @throws \Exception
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        if ($request->input('expired_date') < now()->format('Y-m-d')) {
            return redirect()->back()->withErrors([
                'code_expired_date' => 'Tanggal kadaluarsa tidak boleh kurang dari hari ini',
            ])->withInput();
        }

        $command = (new ReportCodeManagementAction($request))->generateCode();

        return $command
            ? redirect()->route('app.report-code-management.index')->with('success', 'Berhasil membuat kode laporan')
            : redirect()->back()->with('error', 'Gagal membuat kode laporan')->withInput();
    }
}
