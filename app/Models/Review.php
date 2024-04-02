<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Veelasky\LaravelHashId\Eloquent\HashableId;

/**
 * Class Review
 * @package App\Models\
 * @author Chrisdion Andrew <iniandrewrp@gmail.com>
 */

class Review extends Model
{
    use HasFactory;
    use HashableId;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_WAITING_APPROVAL = 'waiting_approval';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REVISION = 'revision';
    public const STATUS_REJECTED = 'rejected';

    protected $table = 'reviews';

    protected $fillable = [
        'reviewable_id',
        'reviewable_type',
        'reviewed_by',
        'status',
        'reviewed_at',
        'name',
        'sequence',
    ];

    protected $appends = [
        'hash'
    ];

    protected $hidden = [
        'id',
        'reviewable_id',
        'reviewable_type',
        'reviewable_by',
        'reviewed_by',
    ];

    public function reviewable(): MorphTo
    {
        return $this->morphTo('reviewable');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
