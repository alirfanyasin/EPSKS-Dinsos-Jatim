<?php

namespace App\Models\Pillars\ASPD;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ASPDRegency extends Model
{
    use HasFactory;
    protected $table = 'aspd_regencies';
    protected $guarded = ['id'];
}
