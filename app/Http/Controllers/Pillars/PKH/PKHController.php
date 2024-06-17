<?php

namespace App\Http\Controllers\Pillars\PKH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PKHController extends Controller
{
    public function profile()
    {
        return view('app.pillars.pkh.index', [
            'pageTitle' => 'Data PKH',
        ]);
    }

    public function create()
    {
    }
}
