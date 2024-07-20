<?php

namespace App\Http\Controllers\Pillars\ASPD;

use App\Http\Controllers\Controller;
use App\Models\Pillars\ASPD\ASPD;
use App\Models\Pillars\ASPD\ASPDReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Review;

use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ASPDReportController extends Controller
{
    public function index()
    {
        // dd(ASPDReport::all());
        return view('app.pillars.aspd.report.index', [
            'pageTitle' => 'Laporan',
            'data_report' => ASPDReport::all()
        ]);
    }

    public function create()
    {
        // dd(Auth()->user()->aspd);
        return view('app.pillars.aspd.report.create', [
            'pageTitle' => 'Laporan'
        ]);
    }


    public function exportReport($select)
    {
        return view('app.pillars.aspd.report.export', [
            'data' => ASPDReport::where('type', $select)->first()
        ]);
    }
    public function export_pdf(Request $request)
    {
        $data = [
            'type' => $request->input('type'),
            'office_id' => $request->input('office_id'),
            'name' => Auth::user()->name,
            'month' => $request->input('month'),  // Simpan month sebagai string asli
            'date' => $request->input('date'),
        ];

        // Mendapatkan tahun dan bulan dari input month
        $dateYear = date('Y', strtotime($data['month']));
        $dateMonth = date('m', strtotime($data['month']));

        // Mengambil data laporan berdasarkan tahun dan bulan
        $data_report = DB::table('pkh_reports')
            ->whereYear('date', $dateYear)
            ->whereMonth('date', $dateMonth)
            ->get();

        if ($data_report->isNotEmpty()) {
            $validStatus = [Review::STATUS_APPROVED];
            $hasValidStatus = $data_report->contains(function ($report) use ($validStatus) {
                return in_array($report->status, $validStatus);
            });

            if ($hasValidStatus) {
                PDF::setOptions(['defaultFont' => 'Nunito Sans']);
                $pdf = PDF::loadView('app.pillars.pkh.report.pdf.export-report', ['data' => $data_report, 'data_export' => $data]);
                return $pdf->download('Laporan PKH - ' . Auth::user()->name . '.pdf');
            }
        }

        return redirect()->back()->withErrors('Tidak ada data yang dapat di export');
    }

    public function store(Request $request)
    {
        // $this->rules($request);

        $data = [
            'aspd_id' => Auth::user()->aspd->id,
            'type' => $request->type,
            'date' => $request->date,
            'venue' => $request->venue,
            'activity' => $request->activity,
            'constraint' => $request->constraint,
            'description' => $request->description,
            'month' => $request->month,
            'office_id' => Auth::user()->aspd->office_id,
            'status' => Review::STATUS_WAITING_APPROVAL,
        ];

        if ($request->type == 'daily') {
            if ($request->hasFile('attachment_daily')) {
                $attachment = $request->file('attachment_daily');
                $rdmStr = Str::random(5);
                $nameAttachment = $rdmStr . '_' . $attachment->getClientOriginalName();
                $attachment->storeAs('public/image/pillars/ASPD/report/', $nameAttachment);
                $data['attachment_daily'] = $nameAttachment;
            }
        }
        if ($request->type == 'monthly') {
            if ($request->hasFile('attachment_monthly')) {
                $attachment = $request->file('attachment_monthly');
                $rdmStr = Str::random(5);
                $nameAttachment = $rdmStr . '_' . $attachment->getClientOriginalName();
                $attachment->storeAs('public/image/pillars/ASPD/report/', $nameAttachment);
                $data['attachment_monthly'] = $nameAttachment;
            }
        }

        // dd("asdasd");

        ASPDReport::create($data);
        return redirect()->route('app.pillar.aspd.report.index')->with('success', 'Tambah Laporan Berhasil');
    }
}
