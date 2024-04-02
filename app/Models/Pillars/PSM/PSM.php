<?php

namespace App\Models\Pillars\PSM;

use App\Jobs\Users\CreateNewUserAfterPSMCreated;
use App\Models\Note;
use App\Models\Office;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Arr;
use Veelasky\LaravelHashId\Eloquent\HashableId;

/**
 * Class PSM
 * @property array $technical_guidance
 * @property array $attachments
 * @property int $office_id
 * @package App\Models\Pillars\PSM
 * @author Chrisdion Andrew <iniandrewrp@gmail.com>
 */

class PSM extends Model
{
    use HasFactory;
    use HashableId;

    protected $table = 'psms';

    protected $fillable = [
        'name',
        'nik',
        'membership_number',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'religion',
        'address',
        'phone_number',
        'email',
        'duty_address',
        'last_education',
        'year_of_appointment',
        'technical_guidance',
        'main_job',
        'attachments',
        'is_active', // status kinerja
        'user_id',
        'office_id',
    ];

    protected $casts = [
        'address' => 'array',
        'duty_address' => 'array',
        'technical_guidance' => 'array',
        'attachments' => 'array',
        'is_active' => 'boolean',
    ];

    protected $appends = ['hash', 'age'];
    protected $hidden = ['id'];

    public function trainings(): HasMany
    {
        return $this->hasMany(PSMTraining::class, 'psm_id');
    }

    public function reports(): HasMany
    {
        return $this->hasMany(PSMReport::class, 'psm_id');
    }

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable')->orderBy('sequence');
    }

    public function latestReview(): MorphOne
    {
        return $this->morphOne(Review::class, 'reviewable')->latestOfMany();
    }

    public function notes(): MorphMany
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    public function latestNote(): MorphOne
    {
        return $this->morphOne(Note::class, 'noteable')->latestOfMany();
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function age(): Attribute
    {
        return new Attribute(fn () => Carbon::parse($this->date_of_birth)->age);
    }

    public function photo(): Attribute
    {
        return new Attribute(fn () => $this->getPhoto($this->attachments['photo'] ?? null));
    }

    public function photoKtp(): Attribute
    {
        return new Attribute(fn () => $this->getPhoto($this->attachments['ktp'] ?? null));
    }

    public function regencyAddress(): Attribute
    {
        return new Attribute(fn () => Arr::exists($this->address, 'regency') ? $this->address['regency'] : null);
    }

    public function districtAddress(): Attribute
    {
        return new Attribute(fn () => Arr::exists($this->address, 'district') ? $this->address['district'] : null);
    }

    public function villageAddress(): Attribute
    {
        return new Attribute(fn () => Arr::exists($this->address, 'village') ? $this->address['village'] : null);
    }

    public function technicalGuidanceCertificatePath(): Attribute
    {
        return new Attribute(fn () => $this->technical_guidance['certificate_path'] ? asset('storage/' . $this->technical_guidance['certificate_path']) : null);
    }

    protected function getPhoto($photo): ?string
    {
        if (! $photo) {
            return null;
        }

        return url('storage/' . $photo);
    }

    protected static function boot()
    {
        parent::boot();

        self::created(static function ($model) {
            CreateNewUserAfterPSMCreated::dispatch($model);
        });
    }
}
