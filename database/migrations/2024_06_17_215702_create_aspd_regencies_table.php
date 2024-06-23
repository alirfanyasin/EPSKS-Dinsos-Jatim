<?php

use App\Models\Pillars\ASPD\ASPD;
use App\Models\Pillars\ASPD\ASPDQuota;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aspd_regencies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ASPD::class, 'aspd_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ASPDQuota::class, 'aspd_quota_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspd_regencies');
    }
};
