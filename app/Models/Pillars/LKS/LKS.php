<?php

namespace App\Models\Pillars\LKS;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Veelasky\LaravelHashId\Eloquent\HashableId;

class LKS extends Model
{
    use HasFactory;
    use HashableId;

    public const OWNER_KEMENSOS = 'Pemerintah Pusat / Kemensos';
    public const OWNER_DINSOSPROV = 'Pemerintah Daerah / Dinas Sosial Provinsi';
    public const OWNER_DINSOSKOTA = 'Pemerintah Daerah / Dinas Sosial Kabupaten/Kota';
    public const OWNER_MASYARAKAT = 'Masyarakat';

    protected $table = 'lks';

    protected $fillable = [
        'name',
        'address',
        'owner',
        'phone_number',
        'email',
        'leader_name',
        'attachments',
        'siop_attachments',
        'phone_number_leader',
        'clients',
        'kemenkumham_number',
        'sk_date',
        'notary_name',
        'number_akta',
        'akta_date',
        'prov_siop_number',
        'prov_siop_date',
        'regency_siop_number',
        'regency_siop_date',
        'since',
        'npwp',
        'is_active',
        'office_id',
        'user_id',
        'is_super_admin_approve',
        'is_admin_approve'
    ];

    protected $casts = [
        'address' => 'array',
        'attachments' => 'array',
        'siop_attachments' => 'array',
        'clients' => 'array',
        'siop_attachments' => 'array',
    ];

    protected $appends = ['hash'];
    protected $hidden = ['id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get all of the report for the LKS
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function report()
    {
        return $this->hasMany(LKSReport::class);
    }

}
