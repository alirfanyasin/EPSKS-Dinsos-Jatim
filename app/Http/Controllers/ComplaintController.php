<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ComplaintController extends Controller
{
    public function index()
    {
        $aduan = Complaint::all();
        return view('app.complaint.index',compact('aduan'));
    }

    public function create()
    {
        return view('app.complaint.create');
    }

    public function store(Request $request){

        $image = $request->file('image');
        $fileName = time() . '_' . $image->getClientOriginalName();
        $filePath = 'images/' . $fileName;
        $image->move(public_path('images'), $fileName);

        $complaint = new Complaint;
        $complaint->title = $request->input('judul');
        $complaint->content = $request->input('detail');
        $complaint->user_id = Auth::user()->id;
        $complaint->slug = Str::slug($request->input('judul'), '-');
        $complaint->image = $filePath;
        $complaint->save();
        
        return redirect()->route('app.complaint.index');
    }

    public function edit()
    {
        return view('app.complaint.edit');
    }

    public function destroy(string $id){
        $complaint = Complaint::findOrFail($id);

        $complaint->delete();

        return redirect()->route('app.complaint.index');
    }



}
