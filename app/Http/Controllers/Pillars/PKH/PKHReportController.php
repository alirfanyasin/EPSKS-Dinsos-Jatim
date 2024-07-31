<?php

namespace App\Http\Controllers\Pillars\PKH;

use App\Http\Controllers\Controller;
use App\Models\Pillars\PKH\PKHReport;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\error;

class PKHReportController extends Controller
{
    public function index()
    {

        return view('app.pillars.pkh.report.index', [
            'pageTitle' => 'Laporan',
            'data_report' => PKHReport::all()
        ]);
    }



    public function create()
    {
        return view('app.pillars.pkh.report.create', [
            'pageTitle' => 'Tambah Laporan'
        ]);
    }


    public function store(Request $request)
    {
        // $this->rules($request);

        $data = [
            'pkh_id' => Auth::user()->pkh->id,
            'type' => $request->type,
            'date' => $request->date,
            'venue' => $request->venue,
            'activity' => $request->activity,
            'constraint' => $request->constraint,
            'description' => $request->description,
            'month' => $request->month,
            'office_id' => Auth::user()->pkh->office_id,
            'status' => Review::STATUS_WAITING_APPROVAL,
        ];

        if ($request->type == 'daily') {
            if ($request->hasFile('attachment_daily')) {
                $attachment = $request->file('attachment_daily');
                $rdmStr = Str::random(5);
                $nameAttachment = $rdmStr . '_' . $attachment->getClientOriginalName();
                $attachment->storeAs('public/image/pillars/PKH/report/', $nameAttachment);
                $data['attachment_daily'] = $nameAttachment;
            }
        }
        if ($request->type == 'monthly') {
            if ($request->hasFile('attachment_monthly')) {
                $attachment = $request->file('attachment_monthly');
                $rdmStr = Str::random(5);
                $nameAttachment = $rdmStr . '_' . $attachment->getClientOriginalName();
                $attachment->storeAs('public/image/pillars/PKH/report/', $nameAttachment);
                $data['attachment_monthly'] = $nameAttachment;
            }
        }

        PKHReport::create($data);
        return redirect()->route('app.pillar.pkh.report.index')->with('success', 'Tambah Laporan Berhasil');
    }


    public function revision($id)
    {
        $data = PKHReport::findOrFail($id);

        if ($data->status == 'revision') {
            $data_report = $data;
        }

        return view('app.pillars.pkh.report.revision', [
            'titlePage' => 'Revisi Laporan',
            'data' => $data_report
        ]);
    }

    public function revisionUpdate($id, Request $request)
    {

        $data = PKHReport::find($id);

        $data->update([
            'pkh_id' => Auth::user()->pkh->id,
            'type' => $request->type,
            'date' => $request->date,
            'venue' => $request->venue,
            'activity' => $request->activity,
            'constraint' => $request->constraint,
            'description' => $request->description,
            'month' => $request->month,
            'status' => Review::STATUS_WAITING_APPROVAL,
        ]);

        if ($request->type == 'daily') {
            if ($request->hasFile('attachment_daily')) {
                if ($data->attachment_daily) {
                    Storage::delete('public/image/pillars/PKH/report/' . $data->attachment_daily);
                }
                $attachment = $request->file('attachment_daily');
                $rdmStr = Str::random(5);
                $nameAttachment = $rdmStr . '_' . $attachment->getClientOriginalName();
                $attachment->storeAs('public/image/pillars/PKH/report/', $nameAttachment);
                $data['attachment_daily'] = $nameAttachment;
            }
        }

        if ($request->type == 'monthly') {
            if ($request->hasFile('attachment_monthly')) {
                if ($data->attachment_monthly) {
                    Storage::delete('public/image/pillars/PKH/report/' . $data->attachment_monthly);
                }
                $attachment = $request->file('attachment_monthly');
                $rdmStr = Str::random(5);
                $nameAttachment = $rdmStr . '_' . $attachment->getClientOriginalName();
                $attachment->storeAs('public/image/pillars/PKH/report/', $nameAttachment);
                $data['attachment_monthly'] = $nameAttachment;
            }
        }
        $data->save();

        return redirect()->route('app.pillar.pkh.report.index')->with('success', 'Revisi Laporan Berhasil');
    }

    public function exportReport($select)
    {
        return view('app.pillars.pkh.report.export', [
            'data' => PKHReport::where('type', $select)->first()
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
            ->where('pkh_id', Auth::user()->pkh->id)
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



    // public function rules($request)
    // {
    //     $request->validate([
    //         'date' => 'required',
    //         'venue' => 'required',
    //         'activity' => 'required',
    //         'constraint' => 'requried',
    //         'attachment' => 'required|file|mimes:png,jpg,jpeg|max:2048',
    //         'description' => 'required',
    //     ]);
    // }
}
