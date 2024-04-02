<?php

namespace App\Http\Controllers\Pillars\LKS;

use App\Http\Controllers\Controller;
use App\Models\Pillars\LKS\LKSReport;
use App\Models\Pillars\LKS\LKSReviewReport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Validator;

class LKSReviewReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->office_id != 1) {
            $dataDaily = LKSReport::where('office_id', Auth::user()->office_id)->where('type', 'daily')->where('is_admin_approve', 0)->where('status', LKSReport::STATUS_WAITING_APPROVAL)->get();
            $dataMonthly = LKSReport::where('office_id', Auth::user()->office_id)->where('type', 'monthly')->where('is_admin_approve', 0)->where('status', LKSReport::STATUS_WAITING_APPROVAL)->get();
        } else {
            $dataDaily = LKSReport::where('type', 'daily')->where('is_super_admin_approve', 0)->where('is_admin_approve', 1)->where('status', LKSReport::STATUS_WAITING_APPROVAL)->get();
            $dataMonthly = LKSReport::where('type', 'monthly')->where('is_super_admin_approve', 0)->where('is_admin_approve', 1)->where('status', LKSReport::STATUS_WAITING_APPROVAL)->get();
        }

        return view('app.pillars.lks.approval.index', [
            'dailyReports' => $dataDaily,
            'monthlyReports' => $dataMonthly,
            'pageTitle' => "Verifikasi Laporan"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required'
        ]);

        if ($request->status === "revision") {
            $request->validate([
                'revision_note' => 'required'
            ]);
        }

        $idReport = LKSReport::hashToId($request->hash);

        $post = new LKSReviewReport;

        $post->lks_report_id = $idReport;
        $post->reviewed_by = Auth::user()->id;
        $post->status = $request->status;
        $post->reviewed_at = Carbon::now();
        if ($request->status === "revision") {
            $post->note = $request->revision_note;
        } else {
            $post->note = "Laporan disetujui";
        }

        $post->save();

        $report = LKSReport::byHash($request->hash);

        if (Auth::user()->office_id != 1) {
            if ($request->status === "approved") {
                $report->is_admin_approve = 1;
            } else if($request->status === "revision") {
                $report->status = LKSReport::STATUS_REVISION;
            }
            else{
                $report->status = LKSReport::STATUS_REJECT;
            }
        } else {
            if ($request->status === "approved") {
                $report->is_super_admin_approve = 1;
                $report->status = LKSReport::STATUS_APPROVE;
            } else if($request->status === "revision") {
                $report->status = LKSReport::STATUS_REVISION;
            }
            else{
                $report->status = LKSReport::STATUS_REJECT;
            }
        }

        // if ($request->status === "approved") {
        //     if (auth()->user()->hasRole('admin')) {
        //         $report->is_admin_approve = 1;
        //     } else {
        //         $report->is_super_admin_approve = 1;
        //     }

        //     $report->status = LKSReport::STATUS_APPROVE;
        // } else if($request->status === "revision") {
        //     $report->status = LKSReport::STATUS_REVISION;
        // }
        // else{
        //     $report->status = LKSReport::STATUS_REJECT;
        // }

        $report->save();

        return redirect()->back()->with('success', "Berhasil memverifikasi data laporan");
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
