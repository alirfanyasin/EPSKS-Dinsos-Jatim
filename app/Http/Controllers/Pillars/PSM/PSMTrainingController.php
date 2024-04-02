<?php

namespace App\Http\Controllers\Pillars\PSM;

use App\Actions\Pillars\PSM\PSMTrainingAction;
use App\Http\Controllers\Controller;
use App\Models\Pillars\PSM\PSM;
use App\Models\Pillars\PSM\PSMTraining;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PSMTrainingController extends Controller
{
    public function store(Request $request, PSM $psm): RedirectResponse
    {
        $command = (new PSMTrainingAction($request))->create($psm);

        return $command
            ? redirect()->route('app.pillar.psm.profile.edit', $psm->hash)->with('success', 'Berhasil menambahkan data')
            : redirect()->back()->with('error', 'Gagal menambahkan data')->withInput();
    }

    public function update(Request $request, PSMTraining $training): RedirectResponse
    {
        $command = (new PSMTrainingAction($request))->update($training);

        return $command
            ? redirect()->route('app.pillar.psm.profile.edit', $training->psm->hash)->with('success', 'Berhasil mengubah data')
            : redirect()->back()->with('error', 'Gagal mengubah data')->withInput();
    }

    public function delete(PSMTraining $training): RedirectResponse
    {
        $command = (new PSMTrainingAction())->delete($training);

        return $command
            ? redirect()->route('app.pillar.psm.profile.edit', $training->psm->hash)->with('success', 'Berhasil menghapus data')
            : redirect()->back()->with('error', 'Gagal menghapus data')->withInput();
    }
}
