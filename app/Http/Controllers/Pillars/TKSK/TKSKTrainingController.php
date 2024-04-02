<?php

namespace App\Http\Controllers\Pillars\TKSK;

use App\Actions\Pillars\TKSK\TKSKTrainingAction;
use App\Http\Controllers\Controller;
use App\Models\Pillars\TKSK\TKSK;
use App\Models\Pillars\TKSK\TKSKTraining;
use Illuminate\Http\RedirectResponse;

class TKSKTrainingController extends Controller
{
    public function store(TKSK $tksk, TKSKTrainingAction $action): RedirectResponse
    {
        $command = $action->create($tksk);

        return $command
            ? redirect()->route('app.pillar.tksk.edit', $tksk->hash)->with('success', 'Berhasil menambahkan data')
            : redirect()->back()->with('error', 'Gagal menambahkan data')->withInput();
    }

    public function update(TKSKTraining $training, TKSKTrainingAction $action): RedirectResponse
    {
        $command = $action->update($training);

        return $command
            ? redirect()->route('app.pillar.tksk.edit', $training->tksk->hash)->with('success', 'Berhasil mengubah data')
            : redirect()->back()->with('error', 'Gagal mengubah data')->withInput();
    }

    public function delete(TKSKTraining $training, TKSKTrainingAction $action): RedirectResponse
    {
        $command = $action->delete($training);

        return $command
            ? redirect()->route('app.pillar.tksk.edit', $training->tksk->hash)->with('success', 'Berhasil menghapus data')
            : redirect()->back()->with('error', 'Gagal menghapus data')->withInput();
    }
}
