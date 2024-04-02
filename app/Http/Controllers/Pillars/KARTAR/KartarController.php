<?php

namespace App\Http\Controllers\Pillars\KARTAR;

use App\Exports\KartarExport;
use App\Http\Controllers\Controller;
use App\Imports\KartarImport;
use App\Models\Pillars\Kartar\KarangTaruna;
use App\Models\Pillars\Kartar\KarangTarunaMember;
use App\Models\Utilities\Province;
use App\Models\Utilities\Regency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Jobs\Users\CreateNewUserAfterKARTARCreate;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class KartarController extends Controller
{
    public function profile()
    {
        return view('app.pillars.kartar.index', [
            'kartar' => KarangTaruna::all()
        ]);
    }



    public function rules()
    {
        return [
            'nama_kartar' => 'required',
            'alamat_sekretariat' => 'required',
            'foto_sekretariat' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kota' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'no_telp_sekretariat' => 'nullable',
            'email_kartar' => 'required',
            'no_sk' => 'required',
            'tanggal_sk' => 'required',
            'penandatangan_sk' => 'required',
            'selaku' => 'required',
            'file_sk' => 'required|file|mimes:pdf|max:2048',
            'nama_ketua_kartar' => 'required',
            'no_telp_wa' => 'required',
            'foto_ketua' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'jumlah_anggota_laki_laki' => 'nullable',
            'jumlah_anggota_perempuan' => 'nullable',
            'jumlah_pengurus_laki_laki' => 'nullable',
            'jumlah_pengurus_perempuan' => 'nullable',
            'klasifikasi_kartar' => 'nullable',
            'status_kinerja' => 'nullable',
            'office_id' => 'required'
        ];
    }

    private function deleteFileIfExists($fileName)
    {
        if ($fileName && Storage::exists('public/image/pillars/kartar/profile/' . $fileName)) {
            Storage::delete('public/image/pillars/kartar/profile/' . $fileName);
        }
    }

    private function uploadFile($file)
    {
        $randomString = Str::random(5);
        $name =  $randomString . "_" . $file->getClientOriginalName();
        $file->storeAs('public/image/pillars/kartar/profile/', $name);
        return $name;
    }


    public function create()
    {
        $filterProvince = Province::query()->where('name', 'JAWA TIMUR')->firstOrFail();
        $regencies = Regency::query()->where('province_id', $filterProvince->id)->get();

        return view('app.pillars.kartar.create', [
            'pageTitle' => 'Tambah Data Karang Taruna',
            'regencies' => $regencies
        ]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate($this->rules(['foto_sekretariat' => '', 'file_sk' => '', 'foto_ketua' => '']));

        if ($request->hasFile('foto_sekretariat')) {
            $foto_sekretariat = $request->file('foto_sekretariat');
            $randomString = Str::random(5);
            $name_file_foto_sekretariat = $randomString . "_" . $foto_sekretariat->getClientOriginalName();
            $foto_sekretariat->storeAs('public/image/pillars/kartar/profile/', $name_file_foto_sekretariat);
            $validatedData['foto_sekretariat'] = $name_file_foto_sekretariat;
        }

        if ($request->hasFile('file_sk')) {
            $file_sk = $request->file('file_sk');
            $randomString = Str::random(5);
            $name_file_sk = $randomString . "_" . $file_sk->getClientOriginalName();
            $file_sk->storeAs('public/image/pillars/kartar/profile/', $name_file_sk);
            $validatedData['file_sk'] = $name_file_sk;
        }

        if ($request->hasFile('foto_ketua')) {
            $foto_ketua = $request->file('foto_ketua');
            $randomString = Str::random(5);
            $name_foto_ketua = $randomString . "_" . $foto_ketua->getClientOriginalName();
            $foto_ketua->storeAs('public/image/pillars/kartar/profile/', $name_foto_ketua);
            $validatedData['foto_ketua'] = $name_foto_ketua;
        }

        $data = KarangTaruna::create($validatedData);
        CreateNewUserAfterKARTARCreate::dispatch($data);

        return redirect()->route('app.pillar.kartar.index')->with('success', 'Data berhasil disimpan.');
    }



    public function show($id)
    {
        return view('app.pillars.kartar.show', [
            'data' => KarangTaruna::findOrFail($id),
            'data_member' => KarangTarunaMember::where('kartar_id', $id)->get()
        ]);
    }



    public function edit($id)
    {
        return view('app.pillars.kartar.edit', [
            'data' => KarangTaruna::findOrFail($id),
            'data_member' => KarangTarunaMember::where('kartar_id', $id)->get()
        ]);
    }

    public function update($id, Request $request)
    {
        $rules = $this->rules();
        $rules['foto_sekretariat'] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
        $rules['file_sk'] = 'nullable|file|mimes:pdf|max:2048';
        $rules['foto_ketua'] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';

        $validatedData = $request->validate($rules);

        $data = KarangTaruna::findOrFail($id);


        if ($request->hasFile('foto_sekretariat')) {
            $this->deleteFileIfExists($data->foto_sekretariat);
            $validatedData['foto_sekretariat'] = $this->uploadFile($request->file('foto_sekretariat'));
        }

        if ($request->hasFile('file_sk')) {
            $this->deleteFileIfExists($data->file_sk);
            $validatedData['file_sk'] = $this->uploadFile($request->file('file_sk'));
        }

        if ($request->hasFile('foto_ketua')) {
            $this->deleteFileIfExists($data->foto_ketua);
            $validatedData['foto_ketua'] = $this->uploadFile($request->file('foto_ketua'));
        }

        $data = KarangTaruna::where('id', $id)->update($validatedData);


        return redirect()->route('app.pillar.kartar.index')->with('success', 'Data berhasil diupdate.');
    }


    public function delete($id)
    {
        $data = KarangTaruna::findOrFail($id);

        $this->deleteFileIfExists($data->foto_sekretariat);
        $this->deleteFileIfExists($data->file_sk);
        $this->deleteFileIfExists($data->foto_ketua);

        $data->delete();

        return redirect()->route('app.pillar.kartar.index')->with('success', 'Data berhasil dihapus.');
    }


    public function import()
    {
        return view('app.pillars.kartar.import');
    }

    public function importExcel(Request $request)
    {
        Excel::import(new KartarImport, $request->file('file'));

        return redirect()->route('app.pillar.kartar.index')->with('success', 'Data berhasil di import');
    }
}
