<?php

namespace App\Http\Controllers\Pillars\LKS;

use App\Models\Pillars\LKS\LKS;
use App\Models\Pillars\LKS\LKSManagement;
use App\Models\Pillars\LKS\LKSTrainingManagement;
use App\Actions\Pillars\LKS\LKSTrainingManagementAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LKSTrainingManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($lks_hash, $lks_management_hash)
    {
        $dataMaster = LKS::byHash($lks_hash);
        $dataManagement = LKSManagement::byHash($lks_management_hash);
        $dataTraining = LKSTrainingManagement::where('lks_management_id', $dataManagement->id)->get();

        return view('app.pillars.lks.training.index', [
            'master' => $dataMaster,
            'management' => $dataManagement,
            'dataTraining' => $dataTraining
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, LKSTrainingManagementAction $action)
    {
        $LKSManagement = LKSManagement::byHash($request->hash);

        $command = $action->create($LKSManagement);

        return $command
            ? redirect()->back()->with('success', 'Berhasil menambahkan data pelatihan')
            : redirect()->back()->with('error', 'Gagal menambahkan data pelatihan')->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show($lks_hash, $lks_management_hash)
    {
        $dataMaster = LKS::byHash($lks_hash);
        $dataManagement = LKSManagement::byHash($lks_management_hash);
        $dataTraining = LKSTrainingManagement::where('lks_management_id', $dataManagement->id)->get();

        return view('app.pillars.lks.training.show', [
            'master' => $dataMaster,
            'management' => $dataManagement,
            'dataTraining' => $dataTraining
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LKSTrainingManagementAction $action, $lks_hash, $lks_management_hash, $lks_training_hash)
    {
        $LKSTrainingManagement = LKSTrainingManagement::byHash($lks_training_hash);

        $command = $action->update($LKSTrainingManagement);

        return $command
            ? redirect()->back()->with('success', 'Berhasil mengubah data pelatihan')
            : redirect()->back()->with('error', 'Gagal mengubah data pelatihan')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($lks_hash, $lks_management_hash, $lks_training_hash)
    {
        $data = LKSTrainingManagement::byHashOrFail($lks_training_hash);

        File::delete('storage/pillars/lks/training/'. $data->attachment);
        $data->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data pelatihan');
    }
}
