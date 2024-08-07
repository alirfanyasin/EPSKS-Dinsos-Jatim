<?php

namespace App\Models\Pillars\ASPD;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ASPDReport extends Model
{
    use HasFactory;

    public const TYPE_DAILY = 'daily';
    public const TYPE_MONTHLY = 'monthly';

    protected $table = 'aspd_reports';

    protected $guarded = ['id'];

    public function aspd(): BelongsTo
    {
        return $this->belongsTo(ASPD::class, 'aspd_id');
    }
}
