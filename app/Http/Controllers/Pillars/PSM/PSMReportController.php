<?php

namespace App\Http\Controllers\Pillars\PSM;

use App\Actions\Pillars\PSM\PSMReportAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PSMReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PSMReportAction $action)
    {
        $dailyReports = $action->getAllDailyReports();
        $monthlyReports = $action->getAllMonthlyReports();

        return view('app.pillars.psm.report.index', [
            'pageTitle' => 'Laporan PSM',
            'dailyReports' => $dailyReports,
            'monthlyReports' => $monthlyReports,
        ]);
    }
}
