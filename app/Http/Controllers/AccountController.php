<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return view('app.account.index');
    }

    public function create()
    {
        return view('app.account.create');
    }

    public function edit()
    {
        return view('app.account.edit');
    }
}
