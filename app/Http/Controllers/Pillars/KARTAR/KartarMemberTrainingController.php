<?php

namespace App\Http\Controllers\Pillars\KARTAR;

use App\Http\Controllers\Controller;
use App\Models\Pillars\Kartar\KarangTarunaMember;
use App\Models\Pillars\Kartar\KarangTarunaMemberTraining;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KartarMemberTrainingController extends Controller
{
    public function rules()
    {
        return [
            'member_id' => 'nullable',
            'training_name' => 'required',
            'organizer' => 'required',
            'date' => 'required',
            'certificate' => 'required|file|mimes:pdf|max:2024',
        ];
    }

    private function deleteFileIfExists($fileName)
    {
        if ($fileName && Storage::exists('public/image/pillars/kartar/certificate/' . $fileName)) {
            Storage::delete('public/image/pillars/kartar/certificate/' . $fileName);
        }
    }




    public function store(Request $request, $member_id, $kartar_id)
    {
        $validatedData = $request->validate($this->rules());

        if ($request->hasFile('certificate')) {
            $certificate = $request->file('certificate');
            $randomString = Str::random(5);
            $name_file_certificate = $randomString . "_" . $certificate->getClientOriginalName();
            $certificate->storeAs('public/image/pillars/kartar/certificate/', $name_file_certificate);
            $validatedData['certificate'] = $name_file_certificate;
        }

        KarangTarunaMemberTraining::create($validatedData);
        return redirect('app/pillar/kartar/member/edit/' . $member_id . '/' . $kartar_id)->with('success', 'Data berhasil disimpan');
    }


    public function delete(Request $request)
    {
        $member_id = $request->member_id;
        $kartar_id = $request->kartar_id;
        $training_id = $request->training_id;

        $training = KarangTarunaMemberTraining::findOrFail($training_id);
        $this->deleteFileIfExists($training->certificate);
        $training->delete();

        return redirect('app/pillar/kartar/member/edit/' . $member_id . '/' . $kartar_id)->with('success', 'Data berhasil dihapus.');
    }
}
