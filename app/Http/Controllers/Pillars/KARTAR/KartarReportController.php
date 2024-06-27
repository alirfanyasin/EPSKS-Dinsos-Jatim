<?php

namespace App\Http\Controllers\Pillars\KARTAR;

use App\Http\Controllers\Controller;
use App\Models\Pillars\Kartar\KarangTarunaReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportKartarExport;
use Illuminate\Support\Facades\Validator;
use App\Models\Pillars\Kartar\KarangTaruna;
use App\Models\Pillars\Kartar\KarangTarunaExportReport;
use Illuminate\Support\Facades\DB;

class KartarReportController extends Controller
{
    public function index()
    {
        return view('app.pillars.kartar.report.index', [
            'pageTitle' => 'Laporan',
            'data_report' => KarangTarunaReport::all(),
        ]);
    }



    public function create(KarangTarunaReport $kartar)
    {
        return view('app.pillars.kartar.report.create', [
            'pageTitle' => 'Tambah Laporan',
            'kartar' => $kartar,
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'office_id' => 'nullable',
            'period' => 'required|in:1,2', // Memastikan 'period' adalah '1' atau '2'
            'name_kartar' => 'required',
            'regency' => 'required',
            'distric' => 'required',
            'village' => 'required',
            'status' => 'nullable',
            'message' => 'nullable',

            'date' => 'required_if:period,1', // Hanya diperlukan jika 'period' adalah '1'
            'place' => 'required_if:period,1', // Hanya diperlukan jika 'period' adalah '1'
            'activity' => 'required_if:period,1', // Hanya diperlukan jika 'period' adalah '1'
            'constraint' => 'required_if:period,1', // Hanya diperlukan jika 'period' adalah '1'
            'description' => 'required_if:period,1', // Hanya diperlukan jika 'period' adalah '1'
            'image' => 'required_if:period,1|file|image|mimes:jpg,jpeg,png|max:2024', // Hanya diperlukan jika 'period' adalah '1'

            'month' => 'required_if:period,2', // Hanya diperlukan jika 'period' adalah '2'
            'attachment' => 'required_if:period,2|file|mimes:pdf|max:5120', // Hanya diperlukan jika 'period' adalah '2'
        ], [
            'period.required' => 'Isian periode wajib diisi',
            'period.in' => 'Isian periode harus salah satu dari: 1, 2',
            'name_kartar.required' => 'Isian nama kartar wajib diisi',
            'regency.required' => 'Isian kabupaten wajib diisi',
            'distric.required' => 'Isian distrik wajib diisi',
            'village.required' => 'Isian desa wajib diisi',
            'date.required_if' => 'Isian waktu wajib diisi',
            'place.required_if' => 'Isian tempat kegiatan wajib diisi',
            'activity.required_if' => 'Isian aktivitas yang dilakukan wajib diisi',
            'constraint.required_if' => 'Isian kendala wajib diisi',
            'description.required_if' => 'Isian uraian / keterangan foto wajib diisi',
            'image.required_if' => 'Isian dokumentasi lapangan wajib diisi',
            'image.image' => 'File harus berupa gambar (JPG, JPEG, PNG)',
            'image.mimes' => 'File wajib berupa JPG, JPEG, PNG',
            'image.max' => 'File tidak boleh lebih dari 2MB',
            'month.required_if' => 'Isian bulan wajib diisi',
            'attachment.required_if' => 'Isian lampiran wajib diisi',
            'attachment.mimes' => 'File wajib berupa PDF',
            'attachment.max' => 'File tidak boleh lebih dari 5MB',
        ]);

        if ($data['period'] == '1') {
            if ($request->file('image')) {
                $image = $request->file('image');
                $randomString = Str::random(5);
                $name_image = $randomString . "_" . $image->getClientOriginalName();
                $image->storeAs('public/image/pillars/kartar/report/', $name_image);
                $data['image'] = $name_image;
            }
        }

        if ($data['period'] == '2') {
            if ($request->file('attachment')) {
                $attachment = $request->file('attachment');
                $randomString = Str::random(5);
                $name_attachment = $randomString . "_" . $attachment->getClientOriginalName();
                $attachment->storeAs('public/image/pillars/kartar/report/', $name_attachment);
                $data['attachment'] = $name_attachment;
            }
        }

        // Simpan data menggunakan create
        KarangTarunaReport::create($data);

        return redirect()->route('app.pillar.kartar.report.index')->with('success', 'Data berhasil disimpan.');
    }



    public function edit($id)
    {
        return view('app.pillars.kartar.report.edit', [
            'data_report' => KarangTarunaReport::findOrFail($id)
        ]);
    }


    private function deleteFileIfExists($fileName)
    {
        if ($fileName && Storage::exists('public/image/pillars/kartar/report/' . $fileName)) {
            Storage::delete('public/image/pillars/kartar/report/' . $fileName);
        }
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $file = KarangTarunaReport::findOrFail($id);

        $data = $request->validate([
            'office_id' => 'nullable',
            'period' => 'required|in:1,2', // Memastikan 'period' adalah '1' atau '2'
            'name_kartar' => 'required',
            'regency' => 'required',
            'distric' => 'required',
            'village' => 'required',
            'status' => 'nullable',
            'message' => 'nullable',

            'date' => 'required_if:period,1', // Hanya diperlukan jika 'period' adalah '1'
            'place' => 'required_if:period,1', // Hanya diperlukan jika 'period' adalah '1'
            'activity' => 'required_if:period,1', // Hanya diperlukan jika 'period' adalah '1'
            'constraint' => 'required_if:period,1', // Hanya diperlukan jika 'period' adalah '1'
            'description' => 'required_if:period,1', // Hanya diperlukan jika 'period' adalah '1'
            'image' => 'nullable|file|image|mimes:jpg,jpeg,png|max:2024', // Hanya diperlukan jika 'period' adalah '1'

            'month' => 'required_if:period,2', // Hanya diperlukan jika 'period' adalah '2'
            'attachment' => 'nullable|file|mimes:pdf|max:5120', // Hanya diperlukan jika 'period' adalah '2'
        ], [
            'period.required' => 'Isian periode wajib diisi',
            'period.in' => 'Isian periode harus salah satu dari: 1, 2',
            'name_kartar.required' => 'Isian nama kartar wajib diisi',
            'regency.required' => 'Isian kabupaten wajib diisi',
            'distric.required' => 'Isian distrik wajib diisi',
            'village.required' => 'Isian desa wajib diisi',
            'date.required_if' => 'Isian waktu wajib diisi',
            'place.required_if' => 'Isian tempat kegiatan wajib diisi',
            'activity.required_if' => 'Isian aktivitas yang dilakukan wajib diisi',
            'constraint.required_if' => 'Isian kendala wajib diisi',
            'description.required_if' => 'Isian uraian / keterangan foto wajib diisi',
            'image.nullable' => 'Isian dokumentasi lapangan wajib diisi',
            'image.image' => 'File harus berupa gambar (JPG, JPEG, PNG)',
            'image.mimes' => 'File wajib berupa JPG, JPEG, PNG',
            'image.max' => 'File tidak boleh lebih dari 2MB',
            'month.required_if' => 'Isian bulan wajib diisi',
            'attachment.nullable' => 'Isian lampiran wajib diisi',
            'attachment.mimes' => 'File wajib berupa PDF',
            'attachment.max' => 'File tidak boleh lebih dari 5MB',
        ]);

        if ($data['period'] == '1') {
            if ($request->file('image')) {
                $this->deleteFileIfExists($file->image);
                $image = $request->file('image');
                $randomString = Str::random(5);
                $name_image = $randomString . "_" . $image->getClientOriginalName();
                $image->storeAs('public/image/pillars/kartar/report/', $name_image);
                $data['image'] = $name_image;
            }
        }

        if ($data['period'] == '2') {
            if ($request->file('attachment')) {
                $this->deleteFileIfExists($file->attachment);
                $attachment = $request->file('attachment');
                $randomString = Str::random(5);
                $name_attachment = $randomString . "_" . $attachment->getClientOriginalName();
                $attachment->storeAs('public/image/pillars/kartar/report/', $name_attachment);
                $data['attachment'] = $name_attachment;
            }
        }

        KarangTarunaReport::where('id', $id)->update($data);
        return redirect()->route('app.pillar.kartar.report.index')->with('success', 'Data berhasil diupdate.');
    }



    public function delete($id)
    {
        $data = KarangTarunaReport::findOrFail($id);

        if ($data->period == '1') {
            $this->deleteFileIfExists($data->image);
        }
        if ($data->period == '2') {
            $this->deleteFileIfExists($data->attachment);
        }

        $data->delete();
        return redirect()->route('app.pillar.kartar.report.index')->with('success', 'Data berhasil dihapus');
    }


    public function revisi($id)
    {
        return view('app.pillars.kartar.report.revisi', [
            'data_report' => KarangTarunaReport::findOrFail($id)
        ]);
    }
    public function revisi_update(Request $request)
    {
        $id = $request->id;
        // Validasi data input
        $validatedData = $request->validate([
            'name_kartar' => 'required',
            'regency' => 'required',
            'distric' => 'required',
            'village' => 'required',
            'document' => 'nullable|file|mimes:pdf|max:2024',
            'month' => 'nullable',
            'year' => 'required',
            'period' => 'required',
            'office_id' => 'required'
        ], [
            'document.required' => 'Dokumen harus diunggah.',
            'document.mimes' => 'Dokumen harus berupa file PDF.',
        ]);

        $validatedData['status'] = $request->status;
        $validatedData['office_id'] = $request->office_id;
        $validatedData['message'] = "";

        $data = KarangTarunaReport::findOrFail($id);

        if ($request->hasFile('document')) {
            $this->deleteFileIfExists($data->document);
            $file = $request->file('document');
            $randomString = Str::random(5);
            $name_file = $randomString . "_" . $file->getClientOriginalName();
            $file->storeAs('public/image/pillars/kartar/report/' . $name_file);
            $validatedData['document'] = $name_file;
        }

        KarangTarunaReport::where('id', $id)->update($validatedData);
        return redirect()->route('app.pillar.kartar.report.index')->with('success', 'Data berhasil diupdate.');
    }


    public function exportReport($select)
    {
        return view('app.pillars.kartar.report.export', [
            'data' => KarangTarunaReport::where('period', $select)->first()
        ]);
    }


    public function export_pdf($name, Request $request)
    {

        $data = [
            'period' => $request->input('period'),
            'no_id' => $request->input('no_id'),
            'office_id' => $request->input('office_id'),
            'name_kartar' => $request->input('name_kartar'),
            'regency' => $request->input('regency'),
            'distric' => $request->input('distric'),
            'village' => $request->input('village'),
            'month' => $request->input('month'),
            'date' => $request->input('date'),
            'head_kartar' => $request->input('head_kartar'),
            'head_village' => $request->input('head_village'),
            'position_village' => $request->input('position_village'),
            'nip_village' => $request->input('nip_village'),
            'head_dinas' => $request->input('head_dinas'),
            'position_dinas' => $request->input('position_dinas'),
            'class_dinas' => $request->input('class_dinas'),
            'nip_dinas' => $request->input('nip_dinas'),
        ];


        $dateYear = date('Y', strtotime($data['month']));
        $dateMonth = date('m', strtotime($data['month']));

        $data_report = DB::table('karang_taruna_reports')->whereYear('date', $dateYear)->whereMonth('date', $dateMonth)->get();

        // Set default font
        PDF::setOptions(['defaultFont' => 'Nunito Sans']);

        // Load the PDF view with data
        $pdf = PDF::loadView('app.pillars.kartar.report.pdf.export-report', ['data' => $data_report, 'data_export' => $data]);

        // Download the PDF with a custom name
        return $pdf->download('Laporan ' . $name . '.pdf');
    }



    public function export_excel($select)
    {
        // return (new ReportKartarExport(2018))->download('invoices.xlsx');
        // return (new ReportKartarExport($select))->download('Laporan.xlsx');
        return Excel::download(new ReportKartarExport($select), 'Laporan.xlsx');
    }
}
