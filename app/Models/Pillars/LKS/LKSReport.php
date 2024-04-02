<?php

namespace App\Models\Pillars\LKS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Veelasky\LaravelHashId\Eloquent\HashableId;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pillars\LKS\LKSReviwedreport;

class LKSReport extends Model
{
    use HasFactory;
    use HashableId;

    public const PERIOD_DAILY = "daily";
    public const PERIOD_MONTHLY = "monthly";

    public const STATUS_DRAFT = "draft";
    public const STATUS_WAITING_APPROVAL = "waiting_approval";
    public const STATUS_APPROVE = "approved";
    public const STATUS_REVISION = "revision";
    public const STATUS_REJECT = "rejected";

    protected $table = "lks_reports";

    protected $fillable = [
        'lks_id',
        'office_id',
        'type',
        'status',
        'attachment',
        'date',
        'venue',
        'activity',
        'constraint',
        'description'
    ];

    protected $hidden = ['id'];

    public function statusLabel(): Attribute
    {
        return new Attribute(fn() => match ($this->status) {
            LKSReport::STATUS_WAITING_APPROVAL => 'Menunggu Persetujuan',
            LKSReport::STATUS_APPROVE => 'Disetujui',
            LKSReport::STATUS_REJECT => 'Ditolak',
            LKSReport::STATUS_REVISION => 'Perlu Revisi',
            default => 'Tidak diketahui',
        });
    }

    /**
     * Get the lks that owns the LKSReport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lks()
    {
        return $this->belongsTo(LKS::class, 'lks_id');
    }

    /**
     * Get the review_report associated with the LKSReport
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function review_report()
    {
        return $this->hasOne(LKSReviwedreport::class, 'lks_id', 'id');
    }

}
