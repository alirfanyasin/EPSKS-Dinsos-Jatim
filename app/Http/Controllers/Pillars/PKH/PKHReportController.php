<?php

namespace App\Http\Controllers\Pillars\PKH;

use App\Http\Controllers\Controller;
use App\Models\Pillars\PKH\PKHReport;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
