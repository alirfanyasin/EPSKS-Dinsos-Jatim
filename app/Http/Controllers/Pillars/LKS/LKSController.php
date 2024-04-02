<?php

namespace App\Http\Controllers\Pillars\LKS;

use App\Models\Pillars\LKS\LKS;
use App\Models\Pillars\LKS\LKSService;
use App\Models\Pillars\LKS\LKSAccreditation;
use App\Models\Pillars\LKS\LKSManagement;
use App\Models\Pillars\LKS\LKSClient;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Utilities\Province;
use App\Models\Utilities\Regency;
use Illuminate\Http\Request;
use App\Actions\Pillars\LKS\LKSAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Pillars\LKS\BnbaExport;
use App\Imports\Pillars\LKS\BnbaImport;
use Illuminate\Filesystem\Filesystem;
use Validator;

class LKSController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index(LKSAction $action)
    {

        return view('app.pillars.lks.index', [
            'pageTitle' => 'Data LKS',
            'dataLKS' => $action->getQuery()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $filterProvince = Province::query()->where('name', 'JAWA TIMUR')->firstOrFail();
        $regencies = Regency::query()->where('province_id', $filterProvince->id)->get();

        return view('app.pillars.lks.create', [
            'pageTitle' => 'Tambah Data LKS',
            'regencies' => $regencies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LKSAction $action): RedirectResponse
    {
        $command = $action->create();

        return $command
            ? redirect()->route('app.pillar.lks.index')->with('success', 'Berhasil menambahkan data')
            : redirect()->back()->with('error', 'Gagal menambahkan data')->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(LKS $lks, $lks_hash)
    {
        $data = LKS::byHash($lks_hash);
        $service = LKSService::where('lks_id', $data->id)->get();
        $accreditations = LKSAccreditation::where('lks_id', $data->id)->get();
        $managements = LKSManagement::where('lks_id', $data->id)->get();
        $clients = LKSClient::where('lks_id', $data->id)->get();

        return view('app.pillars.lks.show', [
            'pageTitle' => 'Detail Data LKS',
            'lks' => $data,
            'service' => $service,
            'accreditations' => $accreditations,
            'managements' => $managements,
            'clients' => $clients
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LKS $lks, $lks_hash)
    {
        $filterProvince = Province::query()->where('name', 'JAWA TIMUR')->firstOrFail();
        $regencies = Regency::query()->where('province_id', $filterProvince->id)->get();
        $data = LKS::byHash($lks_hash);
        $services = LKSService::where('lks_id', $data->id)->get();
        $lksServices = [];
        foreach ($services as $value) {
            $lksServices[] = $value->service;
        }
        $accreditation = LKSAccreditation::where('lks_id', $data->id)->get();
        $managements = LKSManagement::where('lks_id', $data->id)->get();
        $clients = LKSClient::where('lks_id', $data->id)->get();

        return view('app.pillars.lks.edit', [
            'pageTitle' => 'Detail Data LKS',
            'lks' => $data,
            'regencies' => $regencies,
            'services' => $lksServices,
            'accreditations' => $accreditation,
            'managements' => $managements,
            'clients' => $clients
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LKSAction $action, $lks_hash)
    {
        $dataLKS = LKS::byHashOrFail($lks_hash);

        if ($dataLKS->attachments == null) {

            $validator = Validator::make($request->all(), [
                'attachments.front' => 'required|file',
                'attachments.ktp_leader' => 'required|file',
                'attachments.npwp' => 'required|file',
                'attachments.leader_photo' => 'required|file',
                'attachments.board' => 'required|file',
                'attachments.sk' => 'required|file',
                'attachments.akta' => 'required|file',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        $command = $action->update($dataLKS);

        return $command
            ? redirect()->route('app.pillar.lks.index')->with('success', 'Berhasil mengubah data')
            : redirect()->back()->with('error', 'Gagal mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LKS $lks, $lks_hash)
    {
        $dataLKS = LKS::byHashOrFail($lks_hash);

        $user = User::where('username', $dataLKS->npwp)->first();
        $user->delete();

        if ($dataLKS->attachments != null) {
            File::delete('storage/pillars/lks/bnba/' . $dataLKS->attachments['front']);
            File::delete('storage/pillars/lks/bnba/' . $dataLKS->attachments['ktp_leader']);
            File::delete('storage/pillars/lks/bnba/' . $dataLKS->attachments['npwp']);
            File::delete('storage/pillars/lks/bnba/' . $dataLKS->attachments['leader_photo']);
            File::delete('storage/pillars/lks/bnba/' . $dataLKS->attachments['board']);
            File::delete('storage/pillars/lks/bnba/' . $dataLKS->attachments['sk']);
            File::delete('storage/pillars/lks/bnba/' . $dataLKS->attachments['akta']);
        }

        if ($dataLKS->siop_attachments != null) {
            File::delete('storage/pillars/lks/bnba/' . $dataLKS->siop_attachments['prov']);
            File::delete('storage/pillars/lks/bnba/' . $dataLKS->siop_attachments['regency']);
        }

        $dataLKS->delete();
        return redirect()->route('app.pillar.lks.index')->with('success', 'Berhasil meghapus profil LKS');
    }

    public function import()
    {
        $filterProvince = Province::query()->where('name', 'JAWA TIMUR')->firstOrFail();
        $regencies = Regency::query()->where('province_id', $filterProvince->id)->get();

        return view('app.pillars.lks.import', [
            'pageTitle' => 'Import Data LKS',
            'regencies' => $regencies
        ]);
    }

    public function exportBnba()
    {
        return Excel::download(new BnbaExport, 'bnba-lks.xlsx');
    }

    public function importBnba(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'data' => 'required|file|mimes:xlsx',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $patch = new Filesystem;
        $patch->cleanDirectory('storage/pillars/lks/bnba/import');

        $fileData = $request->file('data');
        $nameFile = rand() . '_' . $fileData->getClientOriginalName();
        $fileData->move('storage/pillars/lks/bnba/import/', $nameFile);

        Excel::import(new BnbaImport, public_path('/storage/pillars/lks/bnba/import/' . $nameFile));

        return redirect()->route('app.pillar.lks.index')->with('success', 'Berhasil Mengimport Data LKS');
    }
}
