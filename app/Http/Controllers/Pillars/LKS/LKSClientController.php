<?php

namespace App\Http\Controllers\Pillars\LKS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pillars\LKS\LKS;
use App\Models\Pillars\LKS\LKSClient;
use App\Actions\Pillars\LKS\LKSClientAction;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;

class LKSClientController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, LKSClientAction $action): RedirectResponse
    {
        $lks = LKS::byHash($request->hash);

        $command = $action->create($lks);

        return $command
            ? redirect()->back()->with('success', 'Berhasil menambahkan data klien')
            : redirect()->back()->with('error', 'Gagal menambahkan data klien')->withInput();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LKSClientAction $action, $lks_client_hash)
    {
        $LKSClient = LKSClient::byHashOrFail($lks_client_hash);

        $command = $action->update($LKSClient);

        return $command
            ? redirect()->back()->with('success', 'Berhasil mengubah data klien')
            : redirect()->back()->with('error', 'Gagal mengubah data klien')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($lks_client_hash)
    {
        $destroy = LKSClient::byHashOrFail($lks_client_hash);

        File::delete('storage/pillars/lks/client/'. $destroy->attachments['ktp']);
        File::delete('storage/pillars/lks/client/'. $destroy->attachments['kk']);

        $destroy->delete();

        return redirect()->back()->with('success', "Berhasil Menghapus Data Klien");
    }
}
