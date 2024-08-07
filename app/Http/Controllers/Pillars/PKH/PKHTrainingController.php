<?php

namespace App\Http\Controllers\Pillars\PKH;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Pillars\PKH\PKH;
use App\Http\Controllers\Controller;
use App\Models\Pillars\PKH\PKHTraining;
use Illuminate\Support\Facades\Storage;

class PKHTrainingController extends Controller
{
    //
    public function create($pkh_id)
    {
        return view('app.pillars.pkh.training.create', [
            'data' => PKH::findOrFail($pkh_id),
            'data_training' => PKHTraining::where('pkh_id', $pkh_id)->get()
        ]);
    }

    public function rules()
    {
        return [
            'pkh_id' => 'nullable',
            'training_name' => 'required',
            'organizer' => 'required',
            'date' => 'required',
            'certificate' => 'required|file|mimes:pdf|max:2024',
        ];
    }

    private function deleteFileIfExists($fileName)
    {
        if ($fileName && Storage::exists('public/image/pillars/pkh/training/certificate/' . $fileName)) {
            Storage::delete('public/image/pillars/pkh/certificate/' . $fileName);
        }
    }

    public function store(Request $request, $pkh_id)
    {
        $validatedData = $request->validate($this->rules());
        if ($request->hasFile('certificate')) {
            $certificate = $request->file('certificate');
            $randomString = Str::random(5);
            $name_file_certificate = $randomString . "_" . $certificate->getClientOriginalName();
            $certificate->storeAs('public/image/pillars/pkh/certificate/', $name_file_certificate);
            $validatedData['certificate'] = $name_file_certificate;
        }

        PKHTraining::create($validatedData);
        return redirect('app/pillar/pkh/training/create/' . $pkh_id)->with('success', 'Data berhasil disimpan');
    }

    public function delete(Request $request)
    {
        $pkh_id = $request->pkh_id;
        $training_id = $request->training_id;

        $training = PKHTraining::findOrFail($training_id);
        $this->deleteFileIfExists($training->certificate);
        $training->delete();

        return redirect('app/pillar/pkh/training/create/' .  $pkh_id)->with('success', 'Data berhasil dihapus.');
    }
}
