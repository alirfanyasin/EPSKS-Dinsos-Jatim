<?php

namespace App\Models\Pillars\PKH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PKHReport extends Model
{
    use HasFactory;


    public const TYPE_DAILY = 'daily';
    public const TYPE_MONTHLY = 'monthly';

    protected $table = 'pkh_reports';

    protected $guarded = ['id'];
}
