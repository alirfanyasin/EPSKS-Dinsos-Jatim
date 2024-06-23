<?php

namespace App\Models\Pillars\ASPD;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ASPDRegency extends Model
{
    use HasFactory;
    protected $table = 'aspd_regencies';
    protected $guarded = ['id'];


    /**
     * Get the aspd that owns the ASPDRegency
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function aspd(): BelongsTo
    {
        return $this->belongsTo(ASPD::class, 'aspd_id');
    }

    /**
     * Get the aspdQuota that owns the ASPDRegency
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function aspdQuota(): BelongsTo
    {
        return $this->belongsTo(ASPDQuota::class, 'aspd_quota_id');
    }
}
