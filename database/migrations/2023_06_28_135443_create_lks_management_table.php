<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Pillars\LKS\LKS;
use App\Models\Pillars\LKS\LKSManagement;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lks_managements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LKS::class, 'lks_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('nik');
            $table->enum('gender', [LKSManagement::GENDER_MALE, LKSManagement::GENDER_FEMALE]);
            $table->enum('religion', [LKSManagement::RELIGION_ISLAM, LKSManagement::RELIGION_CATHOLIC,
                                      LKSManagement::RELIGION_PROTESTANT, LKSManagement::RELIGION_BUDDHA, LKSManagement::RELIGION_HINDU]);
            $table->string('start_working');
            $table->string('place_of_birth')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('position');
            $table->enum('employee_status', [LKSManagement::STATUS_PERMANENT, LKSManagement::STATUS_NOT_PERMANENT]);
            $table->enum('last_education', [LKSManagement::EDUCATION_SMASMK, LKSManagement::EDUCATION_D1D2, LKSManagement::EDUCATION_D3,
                                            LKSManagement::EDUCATION_D4S1, LKSManagement::EDUCATION_S2S3]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lks_managements');
    }
};
