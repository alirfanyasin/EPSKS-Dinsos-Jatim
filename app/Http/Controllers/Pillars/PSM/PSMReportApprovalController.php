<?php

namespace App\Http\Controllers\Pillars\PSM;

use App\Actions\Pillars\PSM\PSMReportApprovalAction;
use App\Http\Controllers\Controller;
use App\Models\Pillars\PSM\PSMReport;
use Illuminate\Http\Request;

class PSMReportApprovalController extends Controller
{
    public function index(PSMReportApprovalAction $action)
    {
        $dailyReports = $action->getDailyReports();
        $monthlyReports = $action->getMonthlyReports();

        return view('app.pillars.psm.report.approval.index', [
            'pageTitle' => 'Approval Laporan Harian',
            'dailyReports' => $dailyReports,
            'monthlyReports' => $monthlyReports,
        ]);
    }

    public function detail(PSMReport $report): \Illuminate\Http\JsonResponse
    {
        return $this->jsonResponse($report->load('psm'));
    }

    public function approval(Request $request, PSMReport $report): \Illuminate\Http\RedirectResponse
    {
        $action = new PSMReportApprovalAction($request);
        $action->approval($report);

        return redirect()->route('app.pillar.psm.report.approval.index')->with('success', 'Berhasil melakukan verifikasi laporan');
    }
}
