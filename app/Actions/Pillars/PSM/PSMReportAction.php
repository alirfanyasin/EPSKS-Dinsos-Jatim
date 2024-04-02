<?php

namespace App\Actions\Pillars\PSM;

use App\Concerns\HandleAttachment;
use App\Concerns\HandleMonthlyExport;
use App\Concerns\Validation;
use App\Jobs\DetermineApprovalForPSMReport;
use App\Models\Pillars\PSM\PSMReport;
use App\Models\Pillars\TKSK\TKSKReport;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PSMReportAction
{
    use Validation;
    use HandleAttachment;
    use HandleMonthlyExport;

    public function __construct(
        protected ?Request $request = null,
        protected $photoPath = 'pillars/psm/report/daily',
        protected $documentPath = 'pillars/psm/report/monthly',
    ) {
    }

    public function getAllDailyReports(): Collection|array
    {
        $query = PSMReport::query();
        $query->where('type', PSMReport::TYPE_DAILY);

        if (! auth()->user()?->isDinsosJatim()) {
            $query->where('office_id', auth()->user()->office->id);
        }

        return $query->get();
    }

    public function getAllMonthlyReports(): Collection|array
    {
        $query = PSMReport::query();
        $query->where('type', PSMReport::TYPE_MONTHLY);

        if (! auth()->user()?->isDinsosJatim()) {
            $query->where('office_id', auth()->user()->office->id);
        }

        return $query->get();
    }

    public function getDailyReportsByReporter(): Collection|array
    {
        $query = PSMReport::query();
        $query->where('psm_id', auth()->user()->psm->id);
        $query->where('type', PSMReport::TYPE_DAILY);

        return $query->get();
    }

    public function getMonthlyReportsByReporter(): Collection|array
    {
        $query = PSMReport::query();
        $query->where('psm_id', auth()->user()->psm->id);
        $query->where('type', PSMReport::TYPE_MONTHLY);

        return $query->get();
    }

    public function getReportByHash(string $hash): PSMReport
    {
        return PSMReport::byHashOrFail($hash);
    }

    public function createDaily(): bool
    {
        $filteredRequest = $this->validate($this->request->all(), $this->rules(PSMReport::TYPE_DAILY));

        $psmReport = new PSMReport();
        $psmReport->fill($filteredRequest);
        $psmReport->date = $filteredRequest['date_daily'];
        $psmReport->psm_id = auth()->user()->psm->id;
        $psmReport->type = PSMReport::TYPE_DAILY;
        $psmReport->office_id = auth()->user()->office->id;
        $psmReport->status = Review::STATUS_WAITING_APPROVAL;

        if ($this->request->hasFile('attachment_daily') ?? false) {
            $psmReport->attachment = $this->storePhoto($this->request->file('attachment_daily'), 1080, $this->photoPath);
        }

        $result = $psmReport->save();

        DetermineApprovalForPSMReport::dispatch($psmReport);

        return $result;
    }

    public function createMonthly(): bool
    {
        $filteredRequest = $this->validate($this->request->all(), $this->rules(PSMReport::TYPE_MONTHLY));

        $psmReport = new PSMReport();
        $psmReport->fill($filteredRequest);
        $psmReport->date = $filteredRequest['date_monthly'];
        $psmReport->psm_id = auth()->user()->psm->id;
        $psmReport->type = PSMReport::TYPE_MONTHLY;
        $psmReport->office_id = auth()->user()->office->id;
        $psmReport->status = Review::STATUS_WAITING_APPROVAL;

        if ($this->request->hasFile('attachment_monthly') ?? false) {
            $psmReport->attachment = $this->storeDocument($this->request->file('attachment_monthly'), $this->documentPath);
        }

        $result = $psmReport->save();

        DetermineApprovalForPSMReport::dispatch($psmReport);

        return $result;
    }

    public function updateDaily(string $hash): bool
    {
        $filteredRequest = $this->validate($this->request->all(), $this->rules(PSMReport::TYPE_DAILY));

        $psmReport = $this->getReportByHash($hash);
        $psmReport->fill($filteredRequest);
        $psmReport->date = $filteredRequest['date_daily'];
        $psmReport->psm_id = auth()->user()->psm->id;
        $psmReport->type = PSMReport::TYPE_DAILY;
        $psmReport->office_id = auth()->user()->office->id;
        $psmReport->status = Review::STATUS_WAITING_APPROVAL;

        if ($this->request->hasFile('attachment_daily') ?? false) {
            $psmReport->attachment = $this->storePhoto($this->request->file('attachment_daily'), 1080, $this->photoPath);
        }

        $result = $psmReport->save();

        DetermineApprovalForPSMReport::dispatch($psmReport);

        return $result;
    }

    public function updateMonthly(string $hash): bool
    {
        $filteredRequest = $this->validate($this->request->all(), $this->rules(PSMReport::TYPE_MONTHLY));

        $psmReport = $this->getReportByHash($hash);
        $psmReport->fill($filteredRequest);
        $psmReport->date = $filteredRequest['date_monthly'];
        $psmReport->psm_ID = auth()->user()->psm->id;
        $psmReport->type = PSMReport::TYPE_MONTHLY;
        $psmReport->office_id = auth()->user()->office->id;
        $psmReport->status = Review::STATUS_WAITING_APPROVAL;

        if ($this->request->hasFile('attachment_monthly') ?? false) {
            $psmReport->attachment = $this->storeDocument($this->request->file('attachment_monthly'), $this->documentPath);
        }

        $result = $psmReport->save();

        DetermineApprovalForPSMReport::dispatch($psmReport);

        return $result;
    }

    // Export from daily to monthly
    public function exportMonthly(): string
    {
        $month = Carbon::parse($this->request->input('month'))->translatedFormat('F');

        $payloads = PSMReport::query()
            ->where('date', 'like', '%' . $this->request->input('month') . '%')
            ->where('type', PSMReport::TYPE_DAILY)
            ->where('status', Review::STATUS_APPROVED)
            ->where('psm_id', auth()->user()->psm->id)
            ->with('psm.user')
            ->get();

        if ($payloads->isEmpty()) {
            return false;
        }

        return $this->doExportMonthly($payloads, $payloads->first()->psm, $month);
    }

    private function rules($type = null): array
    {
        return $type === PSMReport::TYPE_DAILY
            ? $this->dailyRules()
            : $this->monthlyRules();
    }

    private function dailyRules(?PSMReport $report = null): array
    {
        return [
            'date_daily' => 'required',
            'venue' => 'required',
            'activity' => 'required',
            'constraint' => 'required',
            'attachment_daily' => 'image|mimes:jpg,png,jpeg|max:10240' . ($report ? '|required' : '|nullable'), // max 10Mb
            'description' => 'required'
        ];
    }

    private function monthlyRules(?PSMReport $report = null): array
    {
        return [
            'date_monthly' => 'required',
            'attachment_monthly' => 'file|mimes:pdf' . ($report ? '|required' : '|nullable'), // max 10Mb
        ];
    }

}
