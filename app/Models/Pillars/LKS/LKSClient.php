<?php

namespace App\Models\Pillars\LKS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Veelasky\LaravelHashId\Eloquent\HashableId;

class LKSClient extends Model
{
    use HasFactory;
    use HashableId;

    public const GENDER_MALE = "Laki-Laki";
    public const GENDER_FEMALE = "Perempuan";

    public const RELIGION_ISLAM = "Islam";
    public const RELIGION_CATHOLIC = "Kristen Katolik";
    public const RELIGION_PROTESTANT = "Kristen Protestan";
    public const RELIGION_BUDDHA = "Budha";
    public const RELIGION_HINDU = "Hindu";

    public const EDUCATION_SMASMK = 'SMA / MA / SMK / Sederajat';
    public const EDUCATION_D1D2 = 'Diploma I / II';
    public const EDUCATION_D3 = 'Diploma III';
    public const EDUCATION_D4S1 = 'Diploma IV / S1';
    public const EDUCATION_S2S3 = 'S2 / S3';

    protected $table = 'lks_clients';

    protected $fillable = [
        'lks_id',
        'name',
        'family_card_number',
        'nik',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'religion',
        'address',
        'attachments',
        'last_education',
    ];

    protected $casts = [
        'address' => 'array',
        'attachments' => 'array',
    ];

    protected $hidden = ['id'];
}
