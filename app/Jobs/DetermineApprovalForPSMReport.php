<?php

namespace App\Jobs;

use App\Models\Pillars\PSM\PSMReport;
use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DetermineApprovalForPSMReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected PSMReport $report,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->report->reviews()->count() > 0) {
            $this->report->reviews()->delete();
        }

        $this->report->reviews()->create([
            'name' => 'Dinas Sosial Kabupaten/Kota',
            'sequence' => 1,
            'status' => Review::STATUS_WAITING_APPROVAL,
        ]);

        $this->report->reviews()->create([
            'name' => 'Dinas Sosial Provinsi Jawa Timur',
            'sequence' => 2,
            'status' => Review::STATUS_DRAFT,
        ]);
    }
}
