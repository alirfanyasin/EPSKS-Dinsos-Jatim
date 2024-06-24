<?php

namespace App\Models\Pillars\ASPD;

use App\Models\Office;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ASPD extends Model
{
    use HasFactory;
    protected $table = 'aspds';
    protected $guarded = ['id'];


    /**
     * Get all of the aspdRegency for the ASPD
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function aspdRegency(): HasMany
    {
        return $this->hasMany(ASPDRegency::class, 'aspd_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id');
    }
}
