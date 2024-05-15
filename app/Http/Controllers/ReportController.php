<?php

namespace App\Http\Controllers;

use App\Actions\Pillars\PSM\PSMAction;
use App\Actions\Pillars\PSM\PSMReportAction;
use App\Actions\Pillars\TKSK\TKSKReportAction;
use App\Models\Pillars\Pillar;
use App\Models\Pillars\PSM\PSMReport;
use App\Models\Pillars\TKSK\TKSKReport;
use Illuminate\Http\Request;

/**
 * Class ReportController
 * Author: Chrisdion Andrew
 * Date: 7/5/2023
 */
class ReportController extends Controller
{
    public function __construct(
        protected $tkskAction = new TKSKReportAction(),
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dailyReports = match (auth()->user()->pillar->id) {
            Pillar::PILLAR_TKSK => $this->tkskAction->getDailyReportsByReporter(),
            Pillar::PILLAR_PSM => (new PSMReportAction())->getDailyReportsByReporter(),
            default => [],
        };

        $monthlyReports = match (auth()->user()->pillar->id) {
            Pillar::PILLAR_TKSK => $this->tkskAction->getMonthlyReportsByReporter(),
            Pillar::PILLAR_PSM => (new PSMReportAction())->getMonthlyReportsByReporter(),
            default => [],
        };


        return view('app.reports.index', [
            'pageTitle' => 'Laporan',
            'dailyReports' => $dailyReports,
            'monthlyReports' => $monthlyReports,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.reports.create', [
            'pageTitle' => 'Buat Laporan',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'type' => 'required|in:daily,monthly'
        ]);

        $tkskReportAction = new TKSKReportAction($request);
        $psmReportAction = new PSMReportAction($request);

        $command = match (auth()->user()?->pillar->id) {
            Pillar::PILLAR_TKSK => ($request->input('type') === TKSKReport::TYPE_DAILY) ? $tkskReportAction->createDaily() : $tkskReportAction->createMonthly(),
            Pillar::PILLAR_PSM => ($request->input('type') === PSMReport::TYPE_DAILY) ? $psmReportAction->createDaily() : $psmReportAction->createMonthly(),
            default => false,
        };

        return $command
            ? redirect()->route('app.employee.report.index')->with('success', 'Berhasil membuat laporan.')
            : back()->withInput()->withErrors(['message' => 'Gagal membuat laporan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $hash)
    {
        return match (auth()->user()->pillar->id) {
            Pillar::PILLAR_TKSK => $this->jsonResponse($this->tkskAction->getReportByHash($hash)),
            Pillar::PILLAR_PSM => $this->jsonResponse((new PSMReportAction())->getReportByHash($hash)),
            default => [],
        };
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $hash)
    {
        $payload = match (auth()->user()->pillar->id) {
            Pillar::PILLAR_TKSK => $this->tkskAction->getReportByHash($hash),
            Pillar::PILLAR_PSM => (new PSMReportAction())->getReportByHash($hash),
            default => $report = [],
        };

        return view('app.reports.edit', [
            'pageTitle' => 'Ubah Laporan',
            'report' => $payload,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $type, string $id): \Illuminate\Http\RedirectResponse
    {
        $tkskReportAction = new TKSKReportAction($request);

        if ($type === 'daily') {
            $payload = match (auth()->user()->pillar->id) {
                Pillar::PILLAR_TKSK => $tkskReportAction->updateDaily($id),
                Pillar::PILLAR_PSM => (new PSMReportAction($request))->updateDaily($id),
                default => false,
            };
        } else {
            $payload = match (auth()->user()->pillar->id) {
                Pillar::PILLAR_TKSK => $tkskReportAction->updateMonthly($id),
                Pillar::PILLAR_PSM => (new PSMReportAction($request))->updateMonthly($id),
                default => false,
            };
        }

        return $payload
            ? redirect()->route('app.employee.report.index')->with('success', 'Berhasil mengubah laporan.')
            : back()->withInput()->withErrors(['message' => 'Gagal mengubah laporan.']);
    }

    public function export()
    {
        return view('app.reports.export', [
            'pageTitle' => 'Export Laporan',
        ]);
    }

    public function doExport(Request $request)
    {
        $action = match (auth()->user()->pillar->id) {
            Pillar::PILLAR_TKSK => (new TKSKReportAction($request))->exportMonthly(),
            Pillar::PILLAR_PSM => (new PSMReportAction($request))->exportMonthly(),
            default => [],
        };

        return $action
            ? response()->download($action)->deleteFileAfterSend(true)
            : back()->withInput()->withErrors(['message' => 'Belum ada laporan yang dapat diexport!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
