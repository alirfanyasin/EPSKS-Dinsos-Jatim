<?php

namespace App\Models\Pillars\PSM;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Veelasky\LaravelHashId\Eloquent\HashableId;

/**
 * Class PSM
 * @package App\Models\Pillars\PSM
 * @author Chrisdion Andrew
 *
 * @property int $psm_id
 * @property string $name
 * @property string $organizer
 * @property string $certificate
 */

class PSMTraining extends Model
{
    use HasFactory;
    use HashableId;

    protected $table = 'psm_trainings';

    protected $fillable = [
        'name',
        'organizer',
        'certificate',
    ];

    protected $appends = ['hash'];
    protected $hidden = ['id'];

    public function psm(): BelongsTo
    {
        return $this->belongsTo(PSM::class, 'psm_id');
    }

    public function certificatePath(): Attribute
    {
        return new Attribute(fn () => $this->certificate ? url('storage/' . $this->certificate) : null);
    }
}
