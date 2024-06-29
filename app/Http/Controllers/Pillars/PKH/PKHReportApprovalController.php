<?php

namespace App\Http\Controllers\Pillars\PKH;

use App\Http\Controllers\Controller;
use App\Models\Pillars\PKH\PKHReport;
use Illuminate\Http\Request;

class PKHReportApprovalController extends Controller
{
    public function index()
    {
        return view('app.pillars.pkh.report.approval', [
            'pageTitle' => 'Approval Laporan PKH',
            'data_report' => PKHReport::all()
        ]);
    }
}
