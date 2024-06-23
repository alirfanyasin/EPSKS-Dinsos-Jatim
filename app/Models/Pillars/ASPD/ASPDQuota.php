<?php

namespace App\Models\Pillars\ASPD;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ASPDQuota extends Model
{
    use HasFactory;
    protected $table = 'aspd_quotas';
    protected $guarded = ['id'];
}
