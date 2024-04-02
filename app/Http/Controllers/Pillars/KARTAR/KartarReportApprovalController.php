<?php

namespace App\Http\Controllers\Pillars\KARTAR;

use App\Http\Controllers\Controller;
use App\Models\Pillars\Kartar\KarangTarunaReport;
use Illuminate\Http\Request;

class KartarReportApprovalController extends Controller
{
    public function index()
    {
        return view('app.pillars.kartar.report.approval', [
            'data_report' => KarangTarunaReport::all(),
        ]);
    }

    public function verification($id, Request $request)
    {
        $data = KarangTarunaReport::findOrFail($id);
        $data->update(['status' => $request->status, 'message' => $request->message]);
        return redirect()->route('app.pillar.kartar.report.approval.index')->with('success', 'Data berhasil di verifikasi.');
    }
}
