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


    public function updateStatus($id, Request $request)
    {
        $data = PKHReport::findOrFail($id);
        if ($request->status === 'revision') {
            $data->update(['message' => $request->message]);
        }
        $data->update(['status' => $request->status]);
        return redirect()->route('app.pillar.pkh.report.approval.index')->with('success', 'Berhasil update status');
    }
}
