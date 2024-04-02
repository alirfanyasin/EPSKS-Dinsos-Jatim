<?php

namespace App\Http\Controllers\Pillars\TKSK;

use App\Actions\Pillars\TKSK\TKSKReportAction;
use App\Http\Controllers\Controller;
use App\Models\Pillars\TKSK\TKSK;
use App\Models\Pillars\TKSK\TKSKReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

/**
 * Class TKSKReportController
 * Author: Chrisdion Andrew
 * Date: 7/4/2023
 */
class TKSKReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TKSKReportAction $action)
    {
        $dailyReports = $action->getAllDailyReports();
        $monthlyReports = $action->getAllMonthlyReports();

        return view('app.pillars.tksk.report.index', [
            'pageTitle' => 'Laporan TKSK',
            'dailyReports' => $dailyReports,
            'monthlyReports' => $monthlyReports,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(TKSK $tksk)
    {
        return view('app.pillars.tksk.report.create', [
            'pageTitle' => 'Tambah Laporan TKSK',
            'tksk' => $tksk,
        ]);
    }

    /**
     * This method is not used anymore
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'type' => 'required'
        ]);

        if ($validate) {
            redirect()->back()->with('error', 'Gagal menambahkan laporan')->withInput();
        }

        if ($request->type == 'daily') {

            $validateData = $request->validate([
                'date_daily' => 'required',
                'venue' => 'required',
                'activity' => 'required',
                'constraint' => 'required',
                'attachment_daily' => 'required|image|mimes:jpg,png,jpeg',
                'description' => 'required'
            ]);


            if ($validateData) {
                redirect()->back()->with('error', 'Gagal menambahkan laporan')->withInput();
            }

            // handle file
            $file = $request->file('attachment_daily');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move('storage/pillars/tksk/report/', $fileName);

            $tkskReport = new TKSKReport;
            $tkskReport->tksk_id = Auth::user()->tksk->id;
            $tkskReport->date = $request->date_daily;
            $tkskReport->venue = $request->venue;
            $tkskReport->activity = $request->activity;
            $tkskReport->constraint = $request->constraint;
            $tkskReport->attachment = $fileName;
            $tkskReport->description = $request->description;
            $tkskReport->type = $request->type;

            $tkskReport->save();
        } else {
            $validateData = $request->validate([
                'date_monthly' => 'required',
                'attachment_monthly' => 'required|file|mimes:pdf'
            ]);

            if ($validateData) {
                redirect()->back()->with('error', 'Gagal menambahkan laporan')->withInput();
            }

            // handle file
            $file = $request->file('attachment_monthly');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move('storage/pillars/tksk/report/', $fileName);

            $tkskReport = new TKSKReport;
            $tkskReport->tksk_id = Auth::user()->tksk->id;
            $tkskReport->date = $request->date_monthly;
            $tkskReport->attachment = $fileName;
            $tkskReport->type = $request->type;

            $tkskReport->save();
        }

        return redirect()->route('app.pillar.tksk.report.index')->with('success', 'Berhasil menambahkan laporan');
    }

    /**
     * Display the specified resource.
     */
    public function show(TKSKReport $tKSKReport)
    {
        //
    }

    /**
     *  This method is not used anymore
     * Show the form for editing the specified resource.
     */
    public function edit(TKSKReport $tKSKReport, $tksk_report_hash)
    {
        $data = TKSKReport::byHash($tksk_report_hash);
        return view('app.pillars.tksk.report.edit', [
            'pageTitle' => 'Edit Laporan TKSK',
            'tkskReport' => $data
        ]);
    }

    /**
     *  This method is not used anymore
     * Update the specified resource in storage.
     */
    public function update(Request $request, TKSKReport $tKSKReport, $tksk_report_hash)
    {
        $tkskReport = TKSKReport::byHash($tksk_report_hash);
        if ($tkskReport->type == 'daily') {

            $validateData = $request->validate([
                'date_daily' => 'required',
                'venue' => 'required',
                'activity' => 'required',
                'constraint' => 'required',
                'description' => 'required'
            ]);


            if ($validateData) {
                redirect()->back()->with('error', 'Gagal menambahkan laporan')->withInput();
            }


            if ($request->hasfile('attachment_daily')) {
                $validateFile = $request->validate([
                    'attachment_daily' => 'required|image|mimes:jpg,png,jpeg'
                ]);

                if ($validateFile) {
                    redirect()->back()->with('error', 'Gagal menambahkan laporan')->withInput();
                }

                // handle file
                $file = $request->file('attachment_daily');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move('storage/pillars/tksk/report/', $fileName);
                $destroy = public_path() . '\\storage\\pillars\\tksk\\report\\' . $tkskReport->attachment;
                unlink($destroy);

                $tkskReport->attachment = $fileName;
            }

            $tkskReport->date = $request->date_daily;
            $tkskReport->venue = $request->venue;
            $tkskReport->activity = $request->activity;
            $tkskReport->constraint = $request->constraint;
            $tkskReport->description = $request->description;

            $tkskReport->save();
        } else {

            $validateData = $request->validate([
                'date_monthly' => 'required'
            ]);


            if ($validateData) {
                redirect()->back()->with('error', 'Gagal menambahkan laporan')->withInput();
            }


            if ($request->hasfile('attachment_monthly')) {
                $validateFile = $request->validate([
                    'attachment_monthly' => 'required|file|mimes:pdf'
                ]);

                if ($validateFile) {
                    redirect()->back()->with('error', 'Gagal menambahkan laporan')->withInput();
                }

                // handle file
                $file = $request->file('attachment_monthly');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move('storage/pillars/tksk/report/', $fileName);
                $destroy = public_path() . '\\storage\\pillars\\tksk\\report\\' . $tkskReport->attachment;
                unlink($destroy);

                $tkskReport->attachment = $fileName;
            }

            $tkskReport->date = $request->date_monthly;

            $tkskReport->save();
        }

        return redirect()->route('app.pillar.tksk.report.index')->with('success', 'Berhasil mengupdate laporan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TKSKReport $tKSKReport, $tksk, $tksk_report_hash)
    {
        $tkskReport = TKSKReport::byHash($tksk_report_hash);
        // dd($tkskReport->attachment);
        File::delete('storage/pillars/tksk/report/' . $tkskReport->attachment);
        $tkskReport->delete();

        return redirect()->route('app.pillar.tksk.report.index', $tksk->hash)->with('success', 'Berhasil meghapus laporan');
    }
}
