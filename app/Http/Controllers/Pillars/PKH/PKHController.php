<?php

namespace App\Http\Controllers\Pillars\PKH;

use App\Http\Controllers\Controller;
use App\Jobs\Users\CreateNewUserAfterPKHCreate;
use App\Models\Pillars\PKH\PKH;
use App\Models\Pillars\PKH\PKHMember;
use App\Models\Pillars\PKH\PKHTraining;
use App\Models\Utilities\Province;
use App\Models\Utilities\Regency;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PKHController extends Controller
{

    public function profile()
    {
        return view('app.pillars.pkh.index', [
            'pageTitle' => 'Data PKH',
            'datas' => PKH::all()
        ]);
    }

    public function create()
    {
        $filterProvince = Province::query()->where('name', 'JAWA TIMUR')->firstOrFail();
        $regencies = Regency::query()->where('province_id', $filterProvince->id)->get();
        return view('app.pillars.pkh.create', [
            'pageTitle' => 'Tambah Data PKH',
            'regencies' => $regencies
        ]);
    }


    public function store(Request $request)
    {
        $this->rules($request);

        $data = [
            'name' => $request->name,
            'nik' => $request->nik,
            'tmt' => $request->tmt,
            'religion' => $request->religion,
            'gender' => $request->gender,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'province' => $request->province,
            'city' => $request->city,
            'no_npwp' => $request->no_npwp,
            'clothes_size' => $request->clothes_size,
            'education' => $request->education,
            'pt_origin_d3' => $request->pt_origin_D3,
            'pt_origin_s1' => $request->pt_origin_S1,
            'pt_origin_s2' => $request->pt_origin_S2,
            'pt_origin_s3' => $request->pt_origin_S3,
            'major_d3' => $request->major_D3,
            'major_s1' => $request->major_S1,
            'major_s2' => $request->major_S2,
            'major_s3' => $request->major_S3,
            'marital_status' => $request->marital_status,
            'number_of_children' => $request->number_of_children,
            'husband_or_wife_name' => $request->husband_or_wife_name,
            'family_card_number' => $request->family_card_number,
            'mother_name' => $request->mother_name,
            'no_bpjs' => $request->no_bpjs,
            'office_id' => $request->office_id,
            'user_id' => $request->user_id,
        ];

        if ($request->hasFile('appointment_letter')) {
            $appointment_letter = $request->file('appointment_letter');
            $randomString = Str::random(5);
            $name_file_appointment_letter = $randomString . "_" . $appointment_letter->getClientOriginalName();
            $appointment_letter->storeAs('public/image/pillars/PKH/profile/', $name_file_appointment_letter);
            $data['appointment_letter'] = $name_file_appointment_letter;
        }

        $pkh = PKH::create($data);

        CreateNewUserAfterPKHCreate::dispatch($pkh);
        return redirect()->route('app.pillar.pkh.index')->with('success', 'Data berhasil disimpan.');
    }



    public function show($id)
    {
        $data = PKH::findOrFail($id);
        $data->education = $data->education;

        return view('app.pillars.pkh.show', [
            'pageTitle' => 'Detail Data PKH',
            'data' => $data,
            'data_training' => PKHTraining::where('pkh_id', $id)->get()
        ]);
    }
    public function edit($id)
    {
        $data = PKH::findOrFail($id);

        $data->education = $data->education;

        return view('app.pillars.pkh.edit', [
            'pageTitle' => 'Detail Data PKH',
            'data' => $data,
            'data_training' => PKHTraining::where('pkh_id', $id)->get()
        ]);
    }
    public function update(Request $request, $id)
    {
        $this->rules($request);

        $data = [
            'name' => $request->name,
            'nik' => $request->nik,
            'tmt' => $request->tmt,
            'religion' => $request->religion,
            'gender' => $request->gender,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'province' => $request->province,
            'city' => $request->city,
            'no_npwp' => $request->no_npwp,
            'clothes_size' => $request->clothes_size,
            'education' => $request->education,
            'pt_origin_d3' => $request->pt_origin_D3,
            'pt_origin_s1' => $request->pt_origin_S1,
            'pt_origin_s2' => $request->pt_origin_S2,
            'pt_origin_s3' => $request->pt_origin_S3,
            'major_d3' => $request->major_D3,
            'major_s1' => $request->major_S1,
            'major_s2' => $request->major_S2,
            'major_s3' => $request->major_S3,
            'marital_status' => $request->marital_status,
            'number_of_children' => $request->number_of_children,
            'husband_or_wife_name' => $request->husband_or_wife_name,
            'family_card_number' => $request->family_card_number,
            'mother_name' => $request->mother_name,
            'no_bpjs' => $request->no_bpjs,
            'office_id' => $request->office_id,
            'user_id' => $request->user_id,
        ];

        $pkh = PKH::findOrFail($id);


        if ($request->hasFile('appointment_letter')) {
            if ($pkh->appointment_letter) {
                Storage::delete('public/image/pillars/PKH/profile/' . $pkh->appointment_letter);
            }

            $file = $request->file('appointment_letter');
            $randomString = Str::random(5);
            $name = $randomString . "_" . $file->getClientOriginalName();
            $file->storeAs('public/image/pillars/PKH/profile/', $name);

            $pkh->appointment_letter = $name;
        }

        $pkh->update($data);

        return redirect()->route('app.pillar.pkh.index')->with('success', 'Data berhasil diupdate.');
    }



    public function delete($id)
    {
        $data = PKH::findOrFail($id);

        $this->deleteFileIfExists($data->appointment_letter);
        $data->delete();
        return redirect()->route('app.pillar.pkh.index')->with('success', 'Data berhasil dihapus.');
    }


    public function rules($request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'nik' => 'required|digits:16',
            'tmt' => 'required',
            'religion' => 'required|string',
            'gender' => 'required|string',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|digits:12',
            'address' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'no_npwp' => 'required|digits:15',
            'appointment_letter' => 'nullable|file|mimes:pdf|max:2048',
            'clothes_size' => 'required|max:10',
            'education' => 'array', // Make sure 'education' is an array
            'pt_origin_d3' => 'nullable|string|max:255',
            'pt_origin_s1' => 'nullable|string|max:255',
            'pt_origin_s2' => 'nullable|string|max:255',
            'pt_origin_s3' => 'nullable|string|max:255',
            'major_d3' => 'nullable|string|max:255',
            'major_s1' => 'nullable|string|max:255',
            'major_s2' => 'nullable|string|max:255',
            'major_s3' => 'nullable|string|max:255',
            'marital_status' => 'required|string|max:255',
            'number_of_children' => 'nullable|integer',
            'husband_or_wife_name' => 'nullable|string|max:255',
            'family_card_number' => 'required|digits:16',
            'no_bpjs' => 'nullable|digits:13',
        ]);
    }

    private function deleteFileIfExists($fileName)
    {
        if ($fileName && Storage::exists('public/image/pillars/PKH/profile/' . $fileName)) {
            Storage::delete('public/image/pillars/PKH/profile/' . $fileName);
        }
    }
}
