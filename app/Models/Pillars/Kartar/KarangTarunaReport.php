<?php

namespace App\Models\Pillars\Kartar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KarangTarunaReport extends Model
{
    use HasFactory;

    protected $table = 'karang_taruna_reports';
    protected $guarded = ['id'];
}
