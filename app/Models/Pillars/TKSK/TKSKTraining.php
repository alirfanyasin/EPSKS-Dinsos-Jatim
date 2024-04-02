<?php

namespace App\Models\Pillars\TKSK;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Veelasky\LaravelHashId\Eloquent\HashableId;

/**
 * Class TKSKTraining
 * @package App\Models\Pillars\TKSK
 * @author Chrisdion Andrew <iniandrewrp@gmail.com>
 */

class TKSKTraining extends Model
{
    use HasFactory;
    use HashableId;

    protected $table = 'tksk_trainings';

    protected $fillable = [
        'name',
        'organizer',
        'certificate',
    ];

    protected $appends = ['hash'];
    protected $hidden = ['id'];

    public function tksk(): BelongsTo
    {
        return $this->belongsTo(TKSK::class, 'tksk_id');
    }

    public function certificatePath(): Attribute
    {
        return new Attribute(fn () => $this->certificate ? url('storage/' . $this->certificate) : null);
    }
}
