<?php

namespace App\Http\Controllers\Pillars\ASPD;

use App\Http\Controllers\Controller;
use App\Models\Pillars\ASPD\ASPD;
use App\Models\Pillars\ASPD\ASPDQuota;
use App\Models\Pillars\ASPD\ASPDRegency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ASPDController extends Controller
{
    public function profile()
    {
        return view('app.pillars.aspd.index', [
            'pageTitle' => 'Data ASPD',
            'datas' => ASPDRegency::all()
        ]);
    }


    public function create()
    {
        // Dapatkan semua aspd_quotas
        $quotas = ASPDQuota::all();

        // Hitung jumlah entri aspd_regencies untuk setiap aspd_quota_id
        $quotaCounts = ASPDRegency::select('aspd_quota_id', DB::raw('count(*) as count'))
            ->groupBy('aspd_quota_id')
            ->pluck('count', 'aspd_quota_id');

        // Filter quotas yang belum penuh
        $availableQuotas = $quotas->filter(function ($quota) use ($quotaCounts) {
            $usedCount = $quotaCounts->get($quota->id, 0);
            return $usedCount < $quota->quota;
        });


        $name = Auth::user()->name;
        $nameWithoutLastWord = preg_replace('/\b\w+\s*$/', '', $name);
        preg_match('/(KOTA|KABUPATEN) [A-Z ]+/', $nameWithoutLastWord, $matches);
        $kota = isset($matches[0]) ? trim($matches[0]) : 'Not found';

        $allQuotasFull = true;

        foreach ($availableQuotas  as $regency) {
            if (trim($regency->name) == $kota) {
                $allQuotasFull = false;
            }
        }

        return view('app.pillars.aspd.create', [
            'pageTitle' => 'Tambah Data ASPD',
            'regencies' => $availableQuotas,
            'allQuotasFull' => $allQuotasFull
        ]);
    }


    public function store(Request $request)
    {

        $this->rules($request);

        $data = [
            'name' => $request->name,
            'nik' => $request->nik,
            'phone' => $request->phone,
            'regency' => $request->regency,
            'address' => $request->address,
            'explanation' => $request->explanation,
            'office_id' => $request->office_id,
            'user_id' => $request->user_id,
        ];

        if ($request->hasFile('identity_photo')) {
            $identity_photo = $request->file('identity_photo');
            $randomString = Str::random(5);
            $name_file_identity_photo = $randomString . "_" . $identity_photo->getClientOriginalName();
            $identity_photo->storeAs('public/image/pillars/ASPD/profile/KTP/', $name_file_identity_photo);
            $data['identity_photo'] = $name_file_identity_photo;
        }

        $aspd = ASPD::create($data);
        ASPDRegency::create([
            'aspd_id' => $aspd->id,
            'aspd_quota_id' => $data['regency']
        ]);

        return redirect()->route('app.pillar.aspd.index')->with('success', 'Data berhasil disimpan');
    }


    public function show($id)
    {
        return view('app.pillars.aspd.show', [
            'pageTitle' => 'Detail Data ASPD',
            'data' => ASPDRegency::findOrFail($id)
        ]);
    }

    public function edit($id)
    {
        // Dapatkan semua aspd_quotas
        $quotas = ASPDQuota::all();

        // Hitung jumlah entri aspd_regencies untuk setiap aspd_quota_id
        $quotaCounts = ASPDRegency::select('aspd_quota_id', DB::raw('count(*) as count'))
            ->groupBy('aspd_quota_id')
            ->pluck('count', 'aspd_quota_id');

        // Filter quotas yang belum penuh
        $availableQuotas = $quotas->filter(function ($quota) use ($quotaCounts) {
            $usedCount = $quotaCounts->get($quota->id, 0);
            return $usedCount < $quota->quota;
        });

        return view('app.pillars.aspd.edit', [
            'pageTitle' => 'Edit Data ASPD',
            'data' => ASPDRegency::findOrFail($id),
            'regencies' => $availableQuotas,
        ]);
    }


    public function delete($id)
    {
        $data = ASPDRegency::findOrFail($id);
        $dataASPD = ASPD::where('id', $id)->first();
        $this->deleteFileIfExists($data->aspd->identity_photo);
        $data->delete();
        $dataASPD->delete();
        return redirect()->route('app.pillar.aspd.index')->with('success', 'Data berhasil dihapus.');
    }



    public function update($id, Request $request)
    {
        $validate = $this->rules($request);
        $validate['identity_photo'] = 'nullable';

        // Find the record by ID
        $data = ASPD::findOrFail($id);

        // Check if a new file is uploaded
        if ($request->hasFile('identity_photo')) {
            // Delete the old file if it exists
            if ($data->identity_photo) {
                Storage::delete('public/image/pillars/ASPD/profile/KTP/' . $data->identity_photo);
            }

            // Handle the new file upload
            $file = $request->file('identity_photo');
            $randomString = Str::random(5);
            $name = $randomString . "_" . $file->getClientOriginalName();
            $file->storeAs('public/image/pillars/ASPD/profile/KTP/', $name);

            // Update the identity_photo field with the new file name
            $data->identity_photo = $name;
        }

        // Update the remaining fields
        $data->update([
            'name' => $request->name,
            'nik' => $request->nik,
            'phone' => $request->phone,
            'regency' => $request->regency,
            'address' => $request->address,
            'explanation' => $request->explanation,
            'identity_photo' => $data->identity_photo,
        ]);

        return redirect()->route('app.pillar.aspd.index')->with('success', 'Berhasil mengupdate data');
    }


    public function rules($request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'nik' => 'required|max:20',
            'phone' => 'required|max:15',
            'identity_photo' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
            'regency' => 'required|max:255',
            'address' => 'required|max:255',
            'explanation' => 'nullable',
        ]);
    }

    private function deleteFileIfExists($fileName)
    {
        if ($fileName && Storage::exists('public/image/pillars/ASPD/profile/KTP/' . $fileName)) {
            Storage::delete('public/image/pillars/ASPD/profile/KTP/' . $fileName);
        }
    }
}
