<?php

namespace App\Actions\Pillars\TKSK;

use App\Concerns\HandleAttachment;
use App\Concerns\HandleMonthlyExport;
use App\Concerns\Validation;
use App\Jobs\DetermineApprovalForTKSKReport;
use App\Models\Pillars\TKSK\TKSKReport;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * Class TKSKReportAction
 * Author: Chrisdion Andrew
 * Date: 6/19/2023
 */

class TKSKReportAction
{
    use Validation;
    use HandleAttachment;
    use HandleMonthlyExport;

    public function __construct(
        protected ?Request $request = null,
        protected $photoPath = 'pillars/tksk/report/daily',
        protected $documentPath = 'pillars/tksk/report/monthly',
    ) {
    }

    public function getAllDailyReports(): Collection|array
    {
        $query = TKSKReport::query();
        $query->where('type', TKSKReport::TYPE_DAILY);

        if (! auth()->user()?->isDinsosJatim()) {
            $query->where('office_id', auth()->user()->office->id);
        }

        return $query->get();
    }

    public function getAllMonthlyReports(): Collection|array
    {
        $query = TKSKReport::query();
        $query->where('type', TKSKReport::TYPE_MONTHLY);

        if (! auth()->user()?->isDinsosJatim()) {
            $query->where('office_id', auth()->user()->office->id);
        }

        return $query->get();
    }

    public function getDailyReportsByReporter(): Collection|array
    {
        $query = TKSKReport::query();
        $query->where('tksk_id', auth()->user()->tksk->id);
        $query->where('type', TKSKReport::TYPE_DAILY);

        return $query->get();
    }

    public function getMonthlyReportsByReporter(): Collection|array
    {
        $query = TKSKReport::query();
        $query->where('tksk_id', auth()->user()->tksk->id);
        $query->where('type', TKSKReport::TYPE_MONTHLY);

        return $query->get();
    }

    public function getReportByHash(string $hash): TKSKReport
    {
        return TKSKReport::byHashOrFail($hash);
    }

    public function createDaily(): bool
    {
        $filteredRequest = $this->validate($this->request->all(), $this->rules(TKSKReport::TYPE_DAILY));

        $tkskReport = new TKSKReport();
        $tkskReport->fill($filteredRequest);
        $tkskReport->date = $filteredRequest['date_daily'];
        $tkskReport->tksk_id = auth()->user()->tksk->id;
        $tkskReport->type = TKSKReport::TYPE_DAILY;
        $tkskReport->office_id = auth()->user()->office->id;
        $tkskReport->status = Review::STATUS_WAITING_APPROVAL;

        if ($this->request->hasFile('attachment_daily') ?? false) {
            $tkskReport->attachment = $this->storePhoto($this->request->file('attachment_daily'), 1080, $this->photoPath);
        }

        $result = $tkskReport->save();

        DetermineApprovalForTKSKReport::dispatch($tkskReport);

        return $result;
    }

    public function createMonthly(): bool
    {
        $filteredRequest = $this->validate($this->request->all(), $this->rules(TKSKReport::TYPE_MONTHLY));

        $tkskReport = new TKSKReport();
        $tkskReport->fill($filteredRequest);
        $tkskReport->date = $filteredRequest['date_monthly'];
        $tkskReport->tksk_id = auth()->user()->tksk->id;
        $tkskReport->type = TKSKReport::TYPE_MONTHLY;
        $tkskReport->office_id = auth()->user()->office->id;
        $tkskReport->status = Review::STATUS_WAITING_APPROVAL;

        if ($this->request->hasFile('attachment_monthly') ?? false) {
            $tkskReport->attachment = $this->storeDocument($this->request->file('attachment_monthly'), $this->documentPath);
        }

        $result = $tkskReport->save();

        DetermineApprovalForTKSKReport::dispatch($tkskReport);

        return $result;
    }

    public function updateDaily(string $hash): bool
    {
        $filteredRequest = $this->validate($this->request->all(), $this->rules(TKSKReport::TYPE_DAILY));

        $tkskReport = $this->getReportByHash($hash);
        $tkskReport->fill($filteredRequest);
        $tkskReport->date = $filteredRequest['date_daily'];
        $tkskReport->tksk_id = auth()->user()->tksk->id;
        $tkskReport->type = TKSKReport::TYPE_DAILY;
        $tkskReport->office_id = auth()->user()->office->id;
        $tkskReport->status = Review::STATUS_WAITING_APPROVAL;

        if ($this->request->hasFile('attachment_daily') ?? false) {
            $tkskReport->attachment = $this->storePhoto($this->request->file('attachment_daily'), 1080, $this->photoPath);
        }

        $result = $tkskReport->save();

        DetermineApprovalForTKSKReport::dispatch($tkskReport);

        return $result;
    }

    public function updateMonthly(string $hash): bool
    {
        $filteredRequest = $this->validate($this->request->all(), $this->rules(TKSKReport::TYPE_MONTHLY));

        $tkskReport = $this->getReportByHash($hash);
        $tkskReport->fill($filteredRequest);
        $tkskReport->date = $filteredRequest['date_monthly'];
        $tkskReport->tksk_id = auth()->user()->tksk->id;
        $tkskReport->type = TKSKReport::TYPE_MONTHLY;
        $tkskReport->office_id = auth()->user()->office->id;
        $tkskReport->status = Review::STATUS_WAITING_APPROVAL;

        if ($this->request->hasFile('attachment_monthly') ?? false) {
            $tkskReport->attachment = $this->storeDocument($this->request->file('attachment_monthly'), $this->documentPath);
        }

        $result = $tkskReport->save();

        DetermineApprovalForTKSKReport::dispatch($tkskReport);

        return $result;
    }

    // Export from daily to monthly
    public function exportMonthly(): string
    {
        $month = Carbon::parse($this->request->input('month'))->translatedFormat('F');

        $payloads = TKSKReport::query()
            ->where('date', 'like', '%' . $this->request->input('month') . '%')
            ->where('type', TKSKReport::TYPE_DAILY)
            ->where('status', Review::STATUS_APPROVED)
            ->where('tksk_id', auth()->user()->tksk->id)
            ->with('tksk.user')
            ->get();

        if ($payloads->isEmpty()) {
             return false;
        }

        return $this->doExportMonthly($payloads, $payloads->first()->tksk, $month);
    }

    private function rules($type = null): array
    {
        return $type === TKSKReport::TYPE_DAILY
            ? $this->dailyRules()
            : $this->monthlyRules();
    }

    private function dailyRules(?TKSKReport $report = null): array
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

    private function monthlyRules(?TKSKReport $report = null): array
    {
        return [
            'date_monthly' => 'required',
            'attachment_monthly' => 'file|mimes:pdf' . ($report ? '|required' : '|nullable'), // max 10Mb
        ];
    }
}
