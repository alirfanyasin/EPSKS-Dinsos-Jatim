<?php

namespace App\Actions\Pillars\PSM;

use App\Models\Pillars\PSM\PSMReport;
use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PSMReportApprovalAction
{
    public function __construct(
        protected ?Request $request = null,
    ) {
    }

    public function getDailyReports(): Collection|array
    {
        $query = PSMReport::query();
        $query->where('type', PSMReport::TYPE_DAILY);
        $query->where('status', Review::STATUS_WAITING_APPROVAL);

        if (! auth()->user()?->isDinsosJatim()) {
            $query->where('office_id', auth()->user()->office->id);
        }

        $query->whereHas('reviews', function ($query) {
            $query->where('status', Review::STATUS_WAITING_APPROVAL);
            $query->where('sequence', auth()->user()?->isDinsosJatim ? 2 : 1);
        });

        return $query->get();
    }

    public function getMonthlyReports()
    {
        $query = PSMReport::query();
        $query->where('type', PSMReport::TYPE_MONTHLY);
        $query->where('status', Review::STATUS_WAITING_APPROVAL);

        if (! auth()->user()?->isDinsosJatim()) {
            $query->where('office_id', auth()->user()->office->id);
        }

        $query->whereHas('reviews', function ($query) {
            $query->where('status', Review::STATUS_WAITING_APPROVAL);
            $query->where('sequence', auth()->user()?->isDinsosJatim ? 2 : 1);
        });

        return $query->get();
    }

    public function approval(PSMReport $report): bool
    {
        $sequence = auth()->user()?->isDinsosJatim ? 2 : 1;

        return match ($this->request->input('status')) {
            Review::STATUS_APPROVED => $this->approve($report, $sequence),
            Review::STATUS_REVISION => $this->revise($report, $sequence),
            Review::STATUS_REJECTED => $this->reject($report, $sequence),
        };
    }

    protected function approve(PSMReport $report, $sequence)
    {
        $report->reviews()->where('sequence', $sequence)->update([
            'reviewed_by' => auth()->user()->id,
            'status' => Review::STATUS_APPROVED,
            'reviewed_at' => now(),
        ]);

        if ($sequence === 1) {
            $report->reviews()->where('sequence', 2)->update([
                'status' => Review::STATUS_WAITING_APPROVAL,
            ]);
        } else {
            $report->update([
                'status' => Review::STATUS_APPROVED,
            ]);
        }

        return true;
    }

    protected function revise(PSMReport $report, $sequence): bool
    {
        $report->reviews()->where('sequence', $sequence)->update([
            'reviewed_by' => auth()->user()->id,
            'status' => Review::STATUS_REVISION,
            'reviewed_at' => now(),
        ]);

        $report->update([
            'status' => Review::STATUS_REVISION,
        ]);

        $report->notes()->create([
            'user_id' => auth()->user()->id,
            'note' => $this->request->input('revision_note'),
        ]);

        return true;
    }

    protected function reject(PSMReport $report, $sequence): bool
    {
        $report->reviews()->where('sequence', $sequence)->update([
            'reviewed_by' => auth()->user()->id,
            'status' => Review::STATUS_REJECTED,
            'reviewed_at' => now(),
        ]);

        if ($sequence === 1) {
            $report->reviews()->where('sequence', 2)->delete();
        }

        $report->update([
            'status' => Review::STATUS_REJECTED,
        ]);

        return true;
    }
}
