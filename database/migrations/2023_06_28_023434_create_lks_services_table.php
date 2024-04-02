<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Pillars\LKS\LKS;
use App\Models\Pillars\LKS\LKSService;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lks_services', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LKS::class, 'lks_id')->constrained()->cascadeOnDelete();
            $table->enum('service', [LKSService::SERVICE_ANAK_DALAMPANTI, LKSService::SERVICE_ANAK_LUARPANTI, LKSService::SERVICE_ABH, LKSService::SERVICE_DISABILITAS_DALAMPANTI,
                                     LKSService::SERVICE_DISABILITAS_LUARPANTI, LKSService::SERVICE_GELANDANGAN_DANPENGEMIS, LKSService::SERVICE_KORBAN_NAPZA,
                                     LKSService::SERVICE_LANSIA_DALAMPANTI, LKSService::SERVICE_LANSIA_LUARPANTI, LKSService::SERVICE_AMPK, LKSService::SERVICE_ODHA,
                                     LKSService::SERVICE_TAMAN_ANAKSEJAHTERA, LKSService::SERVICE_TUNA_SOSIAL_DANKORBAN_PERDAGANGAN, LKSService::SERVICE_BWBP_EKSNAPITER
                                    ])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lks_services');
    }
};
