<?php

namespace App\Models\Pillars\ASPD;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ASPDQuota extends Model
{
    use HasFactory;
    protected $table = 'aspd_quotas';
    protected $guarded = ['id'];

    /**
     * Get all of the aspdRegency for the ASPDQuota
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function aspdRegency(): HasMany
    {
        return $this->hasMany(ASPDRegency::class, 'aspd_quota_id');
    }
}
