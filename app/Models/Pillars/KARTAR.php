<?php

namespace App\Models\Pillars;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Veelasky\LaravelHashId\Eloquent\HashableId;

/**
 * Class LKS
 * @package App\Models\Pillars
 * @author Chrisdion Andrew <iniandrewrp@gmail.com>
 */

class KARTAR extends Model
{
    use HasFactory;
    use HashableId;

    protected $table = 'karang_taruna_reports';
}
