<?php

namespace App\Models\Pillars\LKS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Veelasky\LaravelHashId\Eloquent\HashableId;
use App\Models\Pillars\LKS\LKSReviwedreport;
use App\Models\User;

class LKSReviewReport extends Model
{
    use HasFactory;
    use HashableId;

    protected $table = "lks_review_reports";

    protected $hidden = ['id'];

    protected $fillable = [
        'lks_report_id',
        'reviewed_by',
        'status',
        'note',
        'reviewed_at'
    ];

    /**
     * Get the user that owns the LKSReviewReport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * The lks that belong to the LKSReviewReport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lks()
    {
        return $this->belongsToMany(LKS::class, 'lks_id', 'id');
    }
}
