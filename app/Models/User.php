<?php

namespace App\Models;

use App\Models\Pillars\Kartar\KarangTaruna;
use App\Models\Pillars\Pillar;
use App\Models\Pillars\PSM\PSM;
use App\Models\Pillars\TKSK\TKSK;
use App\Models\Pillars\LKS\LKS;
use App\Models\Pillars\LKS\LKSReviewReport;
use App\Models\Pillars\PKH\PKH;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property bool $isDinsosJatim
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    public const ROLE_SUPER_ADMIN = 'super-admin';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_EMPLOYEE = 'employee';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nip',
        'name',
        'username',
        'email',
        'password',
        'office_id',
        'pillar_id',
        'is_employee',
        'employee_code',
        'code_expired_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_employee' => 'boolean',
        'is_active' => 'boolean',
        'code_expired_date' => 'date',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function pillar(): BelongsTo
    {
        return $this->belongsTo(Pillar::class, 'pillar_id');
    }

    public function tksk(): BelongsTo
    {
        return $this->belongsTo(TKSK::class, 'id', 'user_id');
    }

    public function psm(): BelongsTo
    {
        return $this->belongsTo(PSM::class, 'id', 'user_id');
    }

    public function lks(): BelongsTo
    {
        return $this->belongsTo(LKS::class, 'id', 'user_id');
    }

    public function karang_taruna(): BelongsTo
    {
        return $this->belongsTo(KarangTaruna::class, 'id', 'user_id');
    }
    public function pkh(): BelongsTo
    {
        return $this->belongsTo(PKH::class, 'id', 'user_id');
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    /**
     * Interact with the user's password
     *
     * @param $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function password(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $value,
            set: fn ($value) => Hash::make($value),
        );
    }

    public function labelExpiredDate(): Attribute
    {
        return new Attribute(fn () => Carbon::make($this->code_expired_date)?->translatedFormat('d F Y'));
    }

    public function isDinsosJatim(): Attribute
    {
        return new Attribute(fn () => $this->office_id === 1);
    }

    /**
     * Get the review_report_lks associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function review_report_lks()
    {
        return $this->hasOne(LKSReviewReport::class, 'reviewed_by', 'id');
    }
}
