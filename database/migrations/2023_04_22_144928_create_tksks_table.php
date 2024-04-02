<?php

use App\Models\Office;
use App\Models\Pillars\TKSK\TKSK;
use App\Models\User;
use App\Models\Utilities\District;
use App\Models\Utilities\Regency;
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
        Schema::create('tksks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('nik')->nullable()->unique();
            $table->string('membership_number', 15)->nullable()->unique(); // nomor keanggotaan
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', [TKSK::GENDER_MALE, TKSK::GENDER_FEMALE])->nullable();
            $table->enum('religion', [TKSK::RELIGION_ISLAM, TKSK::RELIGION_PROTESTANT, TKSK::RELIGION_CATHOLIC, TKSK::RELIGION_HINDU, TKSK::RELIGION_BUDDHA])->nullable();
            $table->jsonb('address')->nullable(); // fulladdress, desa, kecamatan, kabupaten, rt, rw
            $table->jsonb('duty_address')->nullable(); // kabupaten, kecamatan ['regency', 'district']
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->enum('last_education', [TKSK::EDUCATION_SMASMK, TKSK::EDUCATION_D1D2, TKSK::EDUCATION_D3, TKSK::EDUCATION_D4S1, TKSK::EDUCATION_S2S3])->nullable();
            $table->string('year_of_appointment')->nullable(); // tahun pengangkatan
            $table->string('main_job')->nullable();
            $table->jsonb('bank_accounts')->nullable();
            $table->enum('annual_evaluation_grade', [TKSK::GRADE_GOOD, TKSK::GRADE_ENOUGH, TKSK::GRADE_BAD])->nullable();
            $table->jsonb('attachments')->nullable(); // photo, photo ktp
            $table->boolean('is_active')->default(false);
            $table->foreignIdFor(Office::class, 'office_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class, 'user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tksks');
    }
};
