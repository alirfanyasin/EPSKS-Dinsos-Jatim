<?php

namespace App\Actions;

use App\Jobs\GenerateEmployeeReportCode;
use App\Models\Pillars\ASPD\ASPD;
use App\Models\Pillars\Kartar\KarangTaruna;
use App\Models\Pillars\LKS;
use App\Models\Pillars\Pillar;
use App\Models\Pillars\PSM\PSM;
use App\Models\Pillars\TKSK\TKSK;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Class ReportCodeAction
 * Author: Chrisdion Andrew
 * Date: 6/29/2023
 */

class ReportCodeManagementAction
{
    public function __construct(
        protected ?Request $request = null,
    ) {
    }


    public function getEmployeeByPillar(): Collection|array
    {
        $query = User::query();
        $query->whereHas('roles', fn ($q) => $q->where('name', User::ROLE_EMPLOYEE));
        $query->where('pillar_id', auth()->user()->pillar->id);
        $query->where('is_employee', true);

        if (!auth()->user()->isDinsosJatim) {
            $query->where('office_id', auth()->user()->office->id);
        }

        $query->whereNotNull('employee_code');
        $query->whereDate('code_expired_date', '>', now()->format('Y-m-d'));

        return $query->get();
    }

    public function getEmployeeByOffice(): Collection|array
    {
        $query = User::query();
        $query->whereHas('roles', fn ($q) => $q->where('name', User::ROLE_EMPLOYEE));
        $query->where('office_id', auth()->user()->office->id);
        $query->whereNotNull('employee_code');
        $query->whereDate('code_expired_date', '>', now()->format('Y-m-d'));

        return $query->get();
    }

    public function generateCode(): bool
    {
        $this->request->validate([
            'pillar' => 'nullable|integer',
            'expired_date' => 'required',
            'office_id' => (auth()->user()->isDinsosJatim  && auth()->user()->pillar_id !== null ? 'required|' : 'nullable|') . 'numeric|exists:offices,id',
        ]);

        $pillar = $this->request->integer('pillar') ?: auth()->user()->pillar_id;

        if ($this->isDataExists($pillar)->count() === 0) {
            redirect()->back()->withErrors([
                'error' => 'Tidak ada data yang ditemukan pada kantor yang dipilih!',
            ])->withInput();
            return false;
        }

        GenerateEmployeeReportCode::dispatch($this->request->all(), $pillar);

        return true;
    }

    private function isDataExists($pillar): Collection|array
    {
        return match ($pillar) {
            Pillar::PILLAR_TKSK => TKSK::query()->where('office_id', auth()->user()->isDinsosJatim ? $this->request['office_id'] : auth()->user()->office_id)->get(),
            Pillar::PILLAR_PSM => PSM::query()->where('office_id', auth()->user()->isDinsosJatim ? $this->request['office_id'] : auth()->user()->office_id)->get(),
            Pillar::PILLAR_LKS => LKS::query()->where('office_id', auth()->user()->isDinsosJatim ? $this->request['office_id'] : auth()->user()->office_id)->get(),
            Pillar::PILLAR_KARTAR => KarangTaruna::query()->where('office_id', auth()->user()->isDinsosJatim ? $this->request['office_id'] : auth()->user()->office_id)->get(),
            Pillar::PILLAR_ASPD => ASPD::query()->where('office_id', auth()->user()->isDinsosJatim ? $this->request['office_id'] : auth()->user()->office_id)->get(),
        };
    }
}
