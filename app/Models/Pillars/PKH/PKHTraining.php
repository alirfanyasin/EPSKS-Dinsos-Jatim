<?php

namespace App\Models\Pillars\PKH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PKHTraining extends Model
{
    use HasFactory;
    protected $table = 'pkh_trainings';
    protected $fillable = [
        'pkh_id',
        'training_name',
        'organizer',
        'date',
        'certificate'
    ];
}
