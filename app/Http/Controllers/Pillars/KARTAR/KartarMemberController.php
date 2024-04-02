<?php

namespace App\Http\Controllers\Pillars\KARTAR;

use App\Http\Controllers\Controller;
use App\Models\Pillars\Kartar\KarangTaruna;
use App\Models\Pillars\Kartar\KarangTarunaMember;
use App\Models\Pillars\Kartar\KarangTarunaMemberTraining;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KartarMemberController extends Controller
{
    public function rules()
    {
        return [
            'kartar_id' => 'nullable',
            'name_member' => 'required',
            'nik' => 'required',
            'photo_identity' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            'gender' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'phone_number' => 'required',
            'religion' => 'required',
            'last_education' => 'nullable',
            'main_job' => 'nullable',
            'address' => 'nullable',
            'position' => 'nullable',
        ];
    }

    private function deleteFileIfExists($fileName)
    {
        if ($fileName && Storage::exists('public/image/pillars/kartar/member/' . $fileName)) {
            Storage::delete('public/image/pillars/kartar/member/' . $fileName);
        }
    }

    private function uploadFile($file)
    {
        $randomString = Str::random(5);
        $name = $randomString . "_" . $file->getClientOriginalName();
        $file->storeAs('public/image/pillars/kartar/member', $name);
        return $name;
    }



    public function create($id)
    {
        return view('app.pillars.kartar.member.create', [
            'data' => KarangTaruna::findOrFail($id)
        ]);
    }

    public function show($member_id, $kartar_id)
    {
        $data_member = KarangTarunaMember::findOrFail($member_id);
        $data_kartar = KarangTaruna::findOrFail($kartar_id);
        $data_training_member = KarangTarunaMemberTraining::where('member_id', $member_id)->get();

        return view('app.pillars.kartar.member.show', [
            'data_member' => $data_member,
            'data' => $data_kartar,
            'data_training' => $data_training_member
        ]);
    }


    public function store(Request $request, $id)
    {
        $validatedData = $request->validate($this->rules());

        if ($request->hasFile('photo_identity')) {
            $photo_identity = $request->file('photo_identity');
            $randomString = Str::random(5);
            $name_file_photo_identity =   $randomString . "_" . $photo_identity->getClientOriginalName();
            $photo_identity->storeAs('public/image/pillars/kartar/member', $name_file_photo_identity);
            $validatedData['photo_identity'] = $name_file_photo_identity;
        }

        KarangTarunaMember::create($validatedData);
        return redirect()->route('app.pillar.kartar.edit', $id)->with('success', 'Data berhasil disimpan');
    }


    public function edit($member_id, $kartar_id)
    {
        $data_member = KarangTarunaMember::findOrFail($member_id);
        $data_kartar = KarangTaruna::findOrFail($kartar_id);
        $data_training_member = KarangTarunaMemberTraining::where('member_id', $member_id)->get();

        return view('app.pillars.kartar.member.edit', [
            'data_member' => $data_member,
            'data_kartar' => $data_kartar,
            'data_training' => $data_training_member
        ]);
    }


    public function update($member_id, $kartar_id, Request $request)
    {

        $rules = $this->rules();
        $rules['photo_identity'] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
        $validatedData = $request->validate($rules);

        $data = KarangTarunaMember::findOrFail($member_id);

        if ($request->hasFile('photo_identity')) {
            $this->deleteFileIfExists($data->photo_identity);
            $validatedData['photo_identity'] = $this->uploadFile($request->file('photo_identity'));
        }

        KarangTarunaMember::where('id', $member_id)->update($validatedData);
        return redirect()->route('app.pillar.kartar.edit', $kartar_id)->with('success', 'Data berhasil diupdate.');
    }








    public function delete(Request $request)
    {
        $member_id = $request->member_id;
        $kartar_id = $request->kartar_id;

        $member = KarangTarunaMember::findOrFail($member_id);
        $this->deleteFileIfExists($member->photo_identity);
        $member->delete();

        return redirect()->route('app.pillar.kartar.edit', $kartar_id)->with('success', 'Data berhasil dihapus.');
    }
}
