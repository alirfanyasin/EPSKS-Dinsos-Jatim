<?php

namespace App\Models\Pillars\TKSK;

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
 * Class TKSKReport
 * @package App\Models\Pillars
 * @author Chrisdion Andrew <iniandrewrp@gmail.com>
 */

class TKSKReport extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HashableId;

    public const TYPE_DAILY = 'daily';
    public const TYPE_MONTHLY = 'monthly';

    protected $table = 'tksk_reports';

    protected $fillable = [
        'tksk_id',
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

    // protected $casts = [
    //     'date' => 'date',
    // ];

    protected $appends = ['hash', 'daily_date', 'monthly_date', 'attachment_path'];

    public function tksk(): BelongsTo
    {
        return $this->belongsTo(TKSK::class);
    }

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable')->orderBy('sequence');
    }

    public function latest_review(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Review::class, 'reviewable')->latestOfMany();
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
