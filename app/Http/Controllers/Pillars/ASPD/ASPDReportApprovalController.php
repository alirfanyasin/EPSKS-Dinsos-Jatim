<?php

namespace App\Http\Controllers\Pillars\ASPD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pillars\ASPD\ASPDReport;

class ASPDReportApprovalController extends Controller
{
    //

    public function index()
    {
        // dd(ASPDReport::all());
        return view('app.pillars.aspd.report.approval', [
            'pageTitle' => 'Approval Laporan ASPD',
            'data_report' => ASPDReport::all()
        ]);
    }
    public function updateStatus(Request $request, $id)
    {
        $data = ASPDReport::find($id);
        $data->update([
            'status' => $request->status
        ]);
        return redirect()->route('app.pillar.aspd.report.approval.index')->with('success', 'Laporan ASPD Berhasil Update');
    }
}
