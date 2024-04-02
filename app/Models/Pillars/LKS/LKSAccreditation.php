<?php

namespace App\Models\Pillars\LKS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Veelasky\LaravelHashId\Eloquent\HashableId;

class LKSAccreditation extends Model
{
    use HasFactory;
    use HashableId;

    protected $table = 'lks_accreditations';

    protected $fillable = [
        'lks_id',
        'assessment_year',
        'grade',
        'attachment',
    ];
}
