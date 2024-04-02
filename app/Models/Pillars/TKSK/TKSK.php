<?php

namespace App\Models\Pillars\TKSK;

use App\Jobs\Users\CreateNewUserAfterTKSKCreated;
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
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Veelasky\LaravelHashId\Eloquent\HashableId;

/**
 * Class TKSK
 * @package App\Models\Pillars
 * @author Chrisdion Andrew <iniandrewrp@gmail.com>
 */

class TKSK extends Model
{
    use HasFactory;
    use HashableId;

    public const GRADE_GOOD = 'Baik';
    public const GRADE_ENOUGH = 'Cukup';
    public const GRADE_BAD = 'Buruk';

    public const GENDER_MALE = 'male';
    public const GENDER_FEMALE = 'female';

    public const RELIGION_ISLAM = 'Islam';
    public const RELIGION_PROTESTANT = 'Kristen Protestan';
    public const RELIGION_CATHOLIC = 'Kristen Katolik';
    public const RELIGION_HINDU = 'Hindu';
    public const RELIGION_BUDDHA = 'Buddha';

    public const EDUCATION_SMASMK = 'SMA / MA / SMK / Sederajat';
    public const EDUCATION_D1D2 = 'Diploma I / II';
    public const EDUCATION_D3 = 'Diploma III';
    public const EDUCATION_D4S1 = 'Diploma IV / S1';
    public const EDUCATION_S2S3 = 'S2 / S3';

    protected $table = 'tksks';

    protected $fillable = [
        'name',
        'mother_name',
        'nik',
        'membership_number',
        'place_of_birth',
        'date_of_birth',
        'age',
        'gender',
        'religion',
        'address',
        'duty_address',
        'phone_number',
        'email',
        'last_education',
        'year_of_appointment',
        'main_job',
        'bank_accounts',
        'is_active',
        'annual_evaluation_grade',
        'attachments',
        'office_id',
        'user_id',
    ];

    protected $casts = [
        'address' => 'array',
        'duty_address' => 'array',
        'bank_accounts' => 'array',
        'attachments' => 'array',
    ];

    protected $appends = ['hash', 'age'];
    protected $hidden = ['id'];

    public function trainings(): HasMany
    {
        return $this->hasMany(TKSKTraining::class, 'tksk_id');
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    public function reports(): HasMany
    {
        return $this->hasMany(TKSKReport::class, 'tksk_id');
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


    /**
     * Currently, this method is not used.
     * Get the value of membership number without dash and dot.
     * NIAT is an abbreviation of Nomor Induk Anggota TKSK.
     * @return Attribute
     */
    public function niat(): Attribute
    {
        return Attribute::make(fn () => str_replace(array('-', '.'), '', $this->membership_number));
    }

    protected function getPhoto($photo): ?string
    {
        if (! $photo) {
            return null;
        }

        return url('storage/' . $photo);
    }

    public static function boot(): void
    {
        parent::boot();

        self::created(static function ($model) {
            CreateNewUserAfterTKSKCreated::dispatch($model);
        });
    }
}
