<?php

namespace App\Models\Pillars\PSM;

use App\Models\Note;
use App\Models\Review;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Veelasky\LaravelHashId\Eloquent\HashableId;

/**
 * Class PSMReport
 * Author: Chrisdion Andrew
 * Date: 8/29/2023
 * @property string $date
 * @property int $tksk_id
 * @property string $type
 * @property int $office_id
 * @property string $status
 * @property string $attachment
 */
class PSMReport extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HashableId;

    PUBLIC CONST TYPE_DAILY = 'daily';
    PUBLIC CONST TYPE_MONTHLY = 'monthly';

    protected $table = 'psm_reports';

    protected $fillable = [
        'psm_id',
        'date',
        'venue',
        'activity',
        'constraint',
        'attachment',
        'description',
        'type',
        'status',
        'office_id',
    ];

    protected $appends = ['hash', 'daily_date', 'monthly_date', 'attachment_path'];

    public function psm(): BelongsTo
    {
        return $this->belongsTo(PSM::class);
    }

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable')->orderBy('sequence');
    }

    public function notes(): MorphMany
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    public function dailyDate(): Attribute
    {
        return new Attribute(fn () => Carbon::parse($this->date)->translatedFormat('d F Y'));
    }

    public function monthlyDate(): Attribute
    {
        return new Attribute(fn () => Carbon::parse($this->date)->translatedFormat('F Y'));
    }

    public function reportType(): Attribute
    {
        return new Attribute(fn () => $this->type === self::TYPE_DAILY ? 'Laporan Real Time (Harian)' : 'Laporan Bulanan ');
    }

    public function approvalSigner(): Attribute
    {
        return new Attribute(fn () => $this->reviews->where('status', Review::STATUS_WAITING_APPROVAL)->first());
    }

    public function statusLabel(): Attribute
    {
        return new Attribute(fn() => match ($this->status) {
            Review::STATUS_WAITING_APPROVAL => 'Menunggu Persetujuan dari ' . $this->approvalSigner->name,
            Review::STATUS_APPROVED => 'Disetujui',
            Review::STATUS_REJECTED => 'Ditolak',
            Review::STATUS_REVISION => 'Perlu Revisi',
            default => 'Tidak diketahui',
        });
    }

    public function attachmentPath(): Attribute
    {
        return new Attribute(fn () => $this->attachment ? asset('storage/' . $this->attachment) : null);
    }
}
