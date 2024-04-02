<?php

namespace App\Http\Controllers\Pillars;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KartarController extends Controller
{
    public function index()
    {
        return view('app.pillars.kartar.index');
    }

    public function create()
    {
        return view('app.pillars.kartar.add');
    }

    public function edit($id)
    {
        return view('app.pillars.kartar.edit');
    }

    public function show($id)
    {
        return view('app.pillars.kartar.show');
    }

    public function addManagement($id)
    {
        return view('app.pillars.kartar.management.add');
    }

    public function editManagement($id)
    {
        return view('app.pillars.kartar.management.edit');
    }

    public function report($id)
    {
       return view('app.pillars.kartar.report.index');
    }

    public function addReport($id)
    {
        return view('app.pillars.kartar.report.add');
    }
}
