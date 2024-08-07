<?php

namespace App\Models\Pillars\PKH;

use App\Models\Office;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PKH extends Model
{
    use HasFactory;
    protected $table = 'pkhs';
    protected $guarded = ['id'];


    protected $casts = [
        'education' => 'array', // Ensure 'education' is cast to an array
    ];


    /**
     * Get all of the pkh_report for the PKH
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pkh_report(): HasMany
    {
        return $this->hasMany(PKHReport::class, 'pkh_id');
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
