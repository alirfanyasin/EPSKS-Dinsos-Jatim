<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

class EmployeeAuthController extends AuthenticatedSessionController
{
    public function showLoginForm()
    {
        return view('auth.login-employee');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'employee_code' => ['required', 'string'],
        ]);

        $code = $request->input('employee_code');
        $user = User::query()->where('employee_code', $code)->first();

        if ($user && $user->code_expired_date >= now() && $user->is_employee === true) {
            Auth::login($user);

            $request->session()->regenerate();

            if (Auth::user()->pillar_id == 4) {
                return redirect()->route('app.pillar.lks.report.index');
            } else if (Auth::user()->pillar_id == 3) {
                return redirect()->route('app.pillar.kartar.report.index');
            } else if (Auth::user()->pillar_id == 5) {
                return redirect()->route('app.pillar.pkh.report.index');
            } else {
                return redirect()->route('app.employee.report.index');
            }
        }

        if ($user && $user->code_expired_date < now() && $user->is_employee === true) {
            return back()->withErrors([
                'employe_code' => 'Kode Unik Pegawai sudah kadaluarsa.',
            ]);
        }

        return back()->withErrors([
            'employe_code' => 'Kode Unik Pegawai tidak ditemukan.',
        ]);
    }
}
