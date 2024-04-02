<?php

namespace App\Http\Controllers\Pillars\LKS;

use App\Http\Controllers\Controller;
use App\Models\Pillars\LKS\LKSReport;
use App\Models\Pillars\LKS\LKSReviewReport;
use App\Models\Pillars\LKS\LKS;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Auth;
use Validator;
use PDF;

class LKSReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->is_employee == 1) {
            $dataDaily = LKSReport::where('lks_id', Auth::user()->lks->id)->where('type', 'daily')->get();
            $dataMonthly = LKSReport::where('lks_id', Auth::user()->lks->id)->where('type', 'monthly')->get();
        }
        else if(auth()->user()->office_id != 1){
            $dataDaily = LKSReport::where('office_id', Auth::user()->office_id)->where('type', 'daily')->get();
            $dataMonthly = LKSReport::where('office_id', Auth::user()->office_id)->where('type', 'monthly')->get();
        }
        else{
            $dataDaily = LKSReport::where('type', 'daily')->get();
            $dataMonthly = LKSReport::where('type', 'monthly')->get();
        }
        return view('app.pillars.lks.report.index', [
            'dailyReports' => $dataDaily,
            'monthlyReports' => $dataMonthly,
            'pageTitle' => "Laporan"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.pillars.lks.report.create', [
            'pageTitle' => "Tambah Laporan"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->type == 'daily') {
            $validationData = Validator::make($request->all(), [
                'date_daily' => 'required',
                'venue' => 'required',
                'activity' => 'required',
                'constraint' => 'required',
                'description' => 'required',
                'attachment_daily' => 'required|file|mimes:jpg,jpeg,png'
            ]);

            if ($validationData->fails()) {
                return redirect()->back()->withErrors($validationData)->withInput();
            }

            $file = $request->file('attachment_daily');
            $resizedPhoto = Image::make($file)->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode($file->getClientOriginalExtension(), 80);

            $fileName = $file->hashName();
            $pathFile = 'pillars/lks/report/daily/'.$fileName;

            Storage::disk('public')->put($pathFile, $resizedPhoto);

            $post = new LKSReport;

            $post->lks_id = Auth::user()->lks->id;
            $post->office_id = Auth::user()->office_id;
            $post->type = $request->type;
            $post->status = LKSReport::STATUS_APPROVE;
            $post->date = $request->date_daily;
            $post->venue = $request->venue;
            $post->activity = $request->activity;
            $post->constraint = $request->constraint;
            $post->description = $request->description;
            $post->attachment = $fileName;

            $post->save();

        } else {
            $validationData = Validator::make($request->all(), [
                'date_monthly' => 'required',
                'attachment_monthly' => 'required|file|mimes:pdf'
            ]);

            if ($validationData->fails()) {
                return redirect()->back()->withErrors($validationData)->withInput();
            }

            $file = $request->file('attachment_monthly');
            $nameFile = time().'_'.$file->getClientOriginalName();
            $file->move('storage/pillars/lks/report/monthly/', $nameFile);

            $post = new LKSReport;

            $post->lks_id = Auth::user()->lks->id;
            $post->office_id = Auth::user()->office_id;
            $post->status = LKSReport::STATUS_WAITING_APPROVAL;
            $post->type = $request->type;
            $post->date = $request->date_monthly;
            $post->attachment = $nameFile;

            $post->save();

        }

        return redirect()->route('app.pillar.lks.report.index')->with('success', 'Berhasil menambahkan data laporan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($lks_report_hash)
    {
        $report = LKSReport::byHash($lks_report_hash);
        // dd($report->id);
        $reportNotes = LKSReviewReport::where('lks_report_id', $report->id)->get();

        return view('app.pillars.lks.report.edit', [
            'pageTitle' => 'Revisi Laporan',
            'report' => $report,
            'reportNotes' => $reportNotes
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $lks_report_hash, $type)
    {
        $report = LKSReport::byHash($lks_report_hash);
        if ($type === "daily") {
            $request->validate([
                'date_daily' => 'required',
                'venue' => 'required',
                'activity' => 'required',
                'constraint' => 'required',
                'description' => 'required'
            ]);

            if ($request->hasfile('attachment_daily')) {
                $request->validate([
                    'attachment_daily' => 'required|image|mimes:jpg,png,jpeg'
                ]);

                $file = $request->file('attachment_daily');
                $resizedPhoto = Image::make($file)->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode($file->getClientOriginalExtension(), 80);

                $fileName = $file->hashName();
                $pathFile = 'pillars/lks/report/daily/'.$fileName;

                Storage::disk('public')->put($pathFile, $resizedPhoto);

                $destroy = public_path().'\\storage\\pillars\\lks\\report\\daily\\'. $report->attachment;
                unlink($destroy);

                $report->attachment = $fileName;
            }

            $report->status = LKSReport::STATUS_APPROVE;
            $report->type = $request->type;
            $report->date = $request->date_daily;
            $report->description = $request->description;
            $report->venue = $request->venue;
            $report->activity = $request->activity;
            $report->constraint = $request->constraint;
            $report->save();
        } else {
            $request->validate([
                'date_monthly' => 'required'
            ]);

            if ($request->hasfile('attachment_monthly')) {
                $request->validate([
                    'attachment_monthly' => 'required|file|mimes:pdf'
                ]);

                $file = $request->file('attachment_monthly');
                $nameFile = time().'_'.$file->getClientOriginalName();
                $file->move('storage/pillars/lks/report/monthly/', $nameFile);

                $destroy = public_path().'\\storage\\pillars\\lks\\report\\monthly\\'. $report->attachment;
                unlink($destroy);

                $report->attachment = $nameFile;
            }

            $report->status = LKSReport::STATUS_WAITING_APPROVAL;
            $report->date = $request->date_monthly;
            $report->save();
        }

        return redirect()->route('app.pillar.lks.report.index')->with('success', 'Berhasil mengubah data laporan');

    }

    public function lks_report($lks_hash){
        $dataLKS = LKS::byHash($lks_hash);
        // dd($dataLKS);
        $dataDaily = LKSReport::where('lks_id', $dataLKS->id)->where('type', 'daily')->get();
        $dataMonthly = LKSReport::where('lks_id', $dataLKS->id)->where('type', 'monthly')->get();

        return view('app.pillars.lks.report.index', [
            'dailyReports' => $dataDaily,
            'monthlyReports' => $dataMonthly,
            'pageTitle' => "Laporan"
        ]);
    }

    public function exportReport(){
        return view('app.pillars.lks.report.export', [
            'pageTitle' => "Export Laporan"
        ]);
    }

    public function export(Request $request){
        $request->validate([
            'month' => 'required'
        ]);

        $patch = new Filesystem;
        $patch->cleanDirectory('storage/pillars/lks/signature');

        $date = date('Y-m', strtotime($request->month));
        $reports = LKSReport::where('created_at', 'like' ,"%".$date."%")->where('type', 'daily')->where('status', LKSReport::STATUS_APPROVE)->get();
        $institute = Auth::user()->name;

        // $image_parts = explode(";base64,", $request->signed);
        // $image_type_aux = explode("image/", $image_parts[0]);
        // $image_type = $image_type_aux[1];
        // $image_base64 = base64_decode($image_parts[1]);
        // $fileName = uniqid() . '.' . $image_type;
        // $file = "pillars/lks/signature/" . $fileName;
        // Storage::disk('public')->put($file, $image_base64);

        // return view('app.pillars.lks.report.resultExport', [
        //     'reports' => $reports,
        //     'date' => $request->month,
        //     'positionHeadman' => $request->headman
        // ]);

        $pdf = PDF::loadView('app.pillars.lks.report.resultExport', [
            'reports' => $reports,
            'date' => $request->month,
            'headman' => $request->headman,
            'positionHeadman' => $request->position,
            'nip' => $request->nip,
            'positionDepartement' => $request->positionDepartement,
            'grade' => $request->grade,
            'headOfDepartement' => $request->headOfDepartement,
            "nipDepartement" => $request->nipDepartement
        ]);

        return $pdf->download('Laporan LKS '. $institute . ' '. date('M Y') .'.pdf');

    }
}
