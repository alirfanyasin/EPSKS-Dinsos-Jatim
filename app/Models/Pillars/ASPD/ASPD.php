<?php

namespace App\Models\Pillars\ASPD;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
