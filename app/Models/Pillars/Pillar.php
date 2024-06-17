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

    public const PILLAR_TKSK = 1;
    public const PILLAR_PSM = 2;
    public const PILLAR_KARTAR = 3;
    public const PILLAR_LKS = 4;
    public const PILLAR_PKH = 5;
    public const PILLAR_ASPD = 6;

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
