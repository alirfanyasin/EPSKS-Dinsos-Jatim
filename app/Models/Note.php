<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Veelasky\LaravelHashId\Eloquent\HashableId;

/**
 * Class Note
 * Author: Chrisdion Andrew
 * Date: 6/19/2023
 */

class Note extends Model
{
    use HasFactory;
    use HashableId;

    protected $fillable = [
        'note',
        'user_id',
        'noteable_id',
        'notable_type',
    ];

    public function noteable(): MorphTo
    {
        return $this->morphTo();
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
