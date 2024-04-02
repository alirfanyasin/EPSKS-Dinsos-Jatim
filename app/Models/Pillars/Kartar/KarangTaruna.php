<?php

namespace App\Models\Pillars\Kartar;

use App\Models\Office;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KarangTaruna extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $table = 'karang_tarunas';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }
}
