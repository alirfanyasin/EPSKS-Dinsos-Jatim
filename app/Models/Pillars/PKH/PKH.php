<?php

namespace App\Models\Pillars\PKH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PKH extends Model
{
    use HasFactory;
    protected $table = 'pkhs';
    protected $guarded = ['id'];


    protected $casts = [
        'education' => 'array', // Ensure 'education' is cast to an array
    ];
}
