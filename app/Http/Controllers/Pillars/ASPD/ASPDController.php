<?php

namespace App\Http\Controllers\Pillars\ASPD;

use App\Http\Controllers\Controller;
use App\Models\Pillars\ASPD\ASPD;
use App\Models\Pillars\ASPD\ASPDQuota;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ASPDController extends Controller
{
    public function profile()
    {
        return view('app.pillars.aspd.index', [
            'pageTitle' => 'Data ASPD',
        ]);
    }


    public function create()
    {
        $regencies = ASPDQuota::all();
        return view('app.pillars.aspd.create', [
            'pageTitle' => 'Tambah Data ASPD',
            'regencies' => $regencies
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
            $identity_photo->storeAs('public/image/pillars/ASP/profile/KTP/', $name_file_identity_photo);
            $data['identity_photo'] = $name_file_identity_photo;
        }

        ASPD::create($data);
        return redirect()->route('app.pillar.aspd.index')->with('success', 'Data berhasil disimpan');
    }

    public function rules($request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'nik' => 'required|max:20',
            'phone' => 'required|max:15',
            'identity_photo' => 'required|max:255',
            'regency' => 'required|max:255',
            'address' => 'required|max:255',
            'explanation' => 'nullable',
        ]);
    }
}
