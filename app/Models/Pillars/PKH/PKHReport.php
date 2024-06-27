<?php

namespace App\Models\Pillars\PKH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PKHReport extends Model
{
    use HasFactory;


    public const TYPE_DAILY = 'daily';
    public const TYPE_MONTHLY = 'monthly';

    protected $table = 'pkh_reports';

    protected $guarded = ['id'];

    /**
     * Get the pkh that owns the PKHReport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pkh(): BelongsTo
    {
        return $this->belongsTo(PKH::class, 'pkh_id');
    }
}
