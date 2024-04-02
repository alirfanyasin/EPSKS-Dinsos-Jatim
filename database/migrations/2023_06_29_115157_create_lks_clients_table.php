<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Pillars\LKS\LKS;
use App\Models\Pillars\LKS\LKSClient;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lks_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LKS::class, 'lks_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('family_card_number');
            $table->string('nik');
            $table->enum('gender', [LKSClient::GENDER_MALE, LKSClient::GENDER_FEMALE]);
            $table->string('place_of_birth')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->enum('religion', [LKSClient::RELIGION_ISLAM, LKSClient::RELIGION_CATHOLIC,
                                      LKSClient::RELIGION_PROTESTANT, LKSClient::RELIGION_BUDDHA, LKSClient::RELIGION_HINDU]);
            $table->jsonb('address')->nullable(); // fulladdress, desa, kecamatan, kabupaten, rt, rw
            $table->jsonb('attachments')->nullable(); // ktp, kk
            $table->enum('last_education', [LKSClient::EDUCATION_SMASMK, LKSClient::EDUCATION_D1D2, LKSClient::EDUCATION_D3,
                                            LKSClient::EDUCATION_D4S1, LKSClient::EDUCATION_S2S3]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lks_clients');
    }
};
