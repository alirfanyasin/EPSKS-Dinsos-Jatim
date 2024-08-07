<?php

namespace App\Jobs;

use App\Models\Pillars\ASPD\ASPD;
use App\Models\Pillars\Kartar\KarangTaruna;
use App\Models\Pillars\LKS;
use App\Models\Pillars\PSM\PSM;
use App\Models\User;
use App\Models\Pillars\Pillar;
use App\Models\Pillars\PKH\PKH;
use App\Models\Pillars\TKSK\TKSK;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Auth;

/**
 * Class GenerateTKSKReportCode
 * Author: Chrisdion Andrew
 * Date: 6/29/2023
 */

class GenerateEmployeeReportCode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $officeId;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected array $request,
        protected int $pillar,
    ) {
        $this->officeId = auth()->user()->isDinsosJatim ? $this->request['office_id'] : auth()->user()->office_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        match ($this->pillar) {
            Pillar::PILLAR_TKSK => $this->generateTKSKCode(),
            Pillar::PILLAR_PSM => $this->generatePSMCode(),
            Pillar::PILLAR_LKS => $this->generateLKSCode(),
            Pillar::PILLAR_KARTAR => $this->generateKARTARCode(),
            Pillar::PILLAR_ASPD => $this->generateASPDCode(),
            Pillar::PILLAR_PKH => $this->generatePKHCode(),
            default => throw new \Exception('Pillar not found'),
        };
    }

    private function generateTKSKCode(): void
    {
        TKSK::query()->where('office_id', $this->officeId)->get()->each(function ($employee) {
            $employee->user()->update([
                'employee_code' => Str::random(7),
                'code_expired_date' => $this->request['expired_date'],
            ]);
        });
    }

    private function generatePSMCode(): void
    {
        PSM::query()->where('office_id', $this->officeId)->get()->each(function ($employee) {
            $employee->user()->update([
                'employee_code' => Str::random(7),
                'code_expired_date' => $this->request['expired_date'],
            ]);
        });
    }

    private function generateLKSCode(): void
    {
        LKS::query()->where('office_id', $this->officeId)->get()->each(function ($employee) {
            User::query()->where('id', $employee->user_id)->update([
                'employee_code' => Str::random(7),
                'code_expired_date' => $this->request['expired_date']
            ]);
        });
    }

    private function generateKARTARCode(): void
    {
        KarangTaruna::query()->where('office_id', $this->officeId)->get()->each(function ($employee) {
            User::query()->where('id', $employee->user_id)->update([
                'employee_code' => Str::random(7),
                'code_expired_date' => $this->request['expired_date']
            ]);
        });
    }

    private function generateASPDCode(): void
    {
        ASPD::query()->where('office_id', $this->officeId)->get()->each(function ($employee) {
            User::query()->where('id', $employee->user_id)->update([
                'employee_code' => Str::random(7),
                'code_expired_date' => $this->request['expired_date']
            ]);
        });
    }
    private function generatePKHCode(): void
    {
        PKH::query()->where('office_id', $this->officeId)->get()->each(function ($employee) {
            User::query()->where('id', $employee->user_id)->update([
                'employee_code' => Str::random(7),
                'code_expired_date' => $this->request['expired_date']
            ]);
        });
    }
}
