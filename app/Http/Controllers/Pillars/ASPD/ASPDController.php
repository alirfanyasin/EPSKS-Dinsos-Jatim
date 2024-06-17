<?php

namespace App\Http\Controllers\Pillars\ASPD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    }
}
