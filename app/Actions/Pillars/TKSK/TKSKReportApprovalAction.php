<?php

namespace App\Actions\Pillars\TKSK;

use App\Models\Pillars\TKSK\TKSKReport;
use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * Class TKSKReportApprovalAction
 * Author: Chrisdion Andrew
 * Date: 7/9/2023
 */

class TKSKReportApprovalAction
{
    public function __construct(
        protected ?Request $request = null,
    )
    {
    }

    public function getDailyReports(): Collection|array
    {
        $query = TKSKReport::query();
        $query->where('type', TKSKReport::TYPE_DAILY);
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
        $query = TKSKReport::query();
        $query->where('type', TKSKReport::TYPE_MONTHLY);
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

    public function approval(TKSKReport $TKSKReport)
    {
        $sequence = auth()->user()?->isDinsosJatim ? 2 : 1;

        return match ($this->request->input('status')) {
            Review::STATUS_APPROVED => $this->approve($TKSKReport, $sequence),
            Review::STATUS_REVISION => $this->revise($TKSKReport, $sequence),
            Review::STATUS_REJECTED => $this->reject($TKSKReport, $sequence),
        };
    }

    protected function approve(TKSKReport $report, $sequence)
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

    protected function revise(TKSKReport $report, $sequence)
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

    protected function reject(TKSKReport $report, $sequence)
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
