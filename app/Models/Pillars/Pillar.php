<?php

namespace App\Models\Pillars;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Pillar
 * Author: Chrisdion Andrew
 * Date: 6/19/2023
 */
class Pillar extends Model
{
    use HasFactory;

    PUBLIC CONST PILLAR_TKSK = 1;
    PUBLIC CONST PILLAR_PSM = 2;
    PUBLIC CONST PILLAR_KARTAR = 3;
    PUBLIC CONST PILLAR_LKS = 4;

    protected $table = 'pillars';

    protected $fillable = [
        'code',
        'name',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
