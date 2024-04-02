<?php

namespace App\Models\Pillars\LKS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Veelasky\LaravelHashId\Eloquent\HashableId;
use Illuminate\Support\Carbon;

class LKSTrainingManagement extends Model
{
    use HasFactory;
    use HashableId;

    protected $table = 'lks_training_management';

    protected $fillable = [
        'lks_id',
        'name',
        'organizer',
        'date',
        'attachment'
    ];
}
