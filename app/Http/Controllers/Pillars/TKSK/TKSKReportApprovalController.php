<?php

namespace App\Http\Controllers\Pillars\TKSK;

use App\Actions\Pillars\TKSK\TKSKReportApprovalAction;
use App\Http\Controllers\Controller;
use App\Models\Pillars\TKSK\TKSKReport;
use App\Models\Review;
use Illuminate\Http\Request;

/**
 * Class TKSKReportApprovalController
 * Author: Chrisdion Andrew
 * Date: 7/9/2023
 */

class TKSKReportApprovalController extends Controller
{
    public function index(TKSKReportApprovalAction $action)
    {
        $dailyReports = $action->getDailyReports();
        $monthlyReports = $action->getMonthlyReports();

        return view('app.pillars.tksk.report.approval.index', [
            'pageTitle' => 'Approval Laporan Harian',
            'dailyReports' => $dailyReports,
            'monthlyReports' => $monthlyReports,
        ]);
    }

    public function detail(TKSKReport $report)
    {
        return $this->jsonResponse($report->load('tksk'));
    }

    public function approval(Request $request, TKSKReport $TKSKReport): \Illuminate\Http\RedirectResponse
    {
        $action = new TKSKReportApprovalAction($request);
        $action->approval($TKSKReport);

        return redirect()->route('app.pillar.tksk.report.approval.index')->with('success', 'Berhasil melakukan verifikasi laporan');
    }
}
