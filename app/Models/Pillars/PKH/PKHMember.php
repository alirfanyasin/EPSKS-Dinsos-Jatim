<?php

namespace App\Models\Pillars\PKH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PKHMember extends Model
{
    use HasFactory;
    protected $table = 'pkh_members';
    protected $guarded = ['id'];
}
