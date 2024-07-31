<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('app.profile.index', [
            'pageTitle' => 'Profile',
        ]);
    }

    public function changePassword()
    {
        return view('app.profile.change-password', [
            'pageTitle' => 'Change Password'
        ]);
    }

    public function changePasswordAction(Request $request)
    {

        $password = Auth::user()->password;

        $request->validate([
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6',
        ]);

        if (Hash::check($request->current_password, $password)) {
            if ($request->new_password === $request->confirm_password) {
                User::where('id', Auth::user()->id)->update(['password' => Hash::make($request->new_password)]);
                return redirect()->route('app.profile.index')->with('success', 'Password berhasil disimpan');
            } else {
                return redirect()->route('app.profile.change-password')->withErrors(['error' => 'Konfirmasi Password Salah']);
            }
        } else {
            return redirect()->route('app.profile.change-password')->withErrors(['error' => 'Password Salah']);
        }
    }
}
