<?php

namespace App\Http\Controllers\Pillars\LKS;

use App\Models\Pillars\LKS\LKS;
use App\Models\Pillars\LKS\LKSManagement;
use App\Actions\Pillars\LKS\LKSManagementAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LKSManagementController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, LKSManagementAction $action)
    {
        $lks = LKS::byHash($request->hash);

        $command = $action->create($lks);

        return $command
            ? redirect()->back()->with('success', 'Berhasil menambahkan data pengurus')
            : redirect()->back()->with('error', 'Gagal menambahkan data pengurus')->withInput();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LKSManagementAction $action, $lks_management_hash)
    {
        $LKSManagement = LKSManagement::byHashOrFail($lks_management_hash);

        $command = $action->update($LKSManagement);

        return $command
            ? redirect()->back()->with('success', 'Berhasil mengubah data pengurus')
            : redirect()->back()->with('error', 'Gagal mengubah data pengurus')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($lks_management_hash)
    {
        $delete = LKSManagement::byHashOrFail($lks_management_hash);
        $delete->delete();

        return redirect()->back()->with('success', "Berhasil Menghapus Data Pengurus");
    }
}
