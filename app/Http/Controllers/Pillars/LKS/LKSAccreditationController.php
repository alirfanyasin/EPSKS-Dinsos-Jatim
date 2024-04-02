<?php

namespace App\Http\Controllers\Pillars\LKS;

use App\Models\Pillars\LKS\LKS;
use App\Models\Pillars\LKS\LKSAccreditation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Actions\Pillars\LKS\LKSAccreditationAction;
use Illuminate\Http\RedirectResponse;

class LKSAccreditationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, LKSAccreditationAction $action): RedirectResponse
    {
        $lks = LKS::byHash($request->hash);
        $command = $action->create($lks);

        return $command
            ? redirect()->back()->with('success', 'Berhasil menambahkan data akreditasi')
            : redirect()->back()->with('error', 'Gagal menambahkan data akreditasi')->withInput();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LKSAccreditationAction $action, $lks_accreditation_hash)
    {
        $LKSAccreditation = LKSAccreditation::byHashOrFail($lks_accreditation_hash);

        $command = $action->update($LKSAccreditation);

        return $command
            ? redirect()->back()->with('success', 'Berhasil mengubah data akreditasi')
            : redirect()->back()->with('error', 'Gagal menambahkan data akreditasi')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($lks_accreditation_hash)
    {
        $data = LKSAccreditation::byHashOrFail($lks_accreditation_hash);

        File::delete('storage/pillars/lks/accreditation/'. $data->attachment);
        $data->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data Akreditasi');
    }
}
