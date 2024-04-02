<?php

use App\Models\Office;
use App\Models\User;
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
        Schema::create('psms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('nik')->nullable()->unique();
            $table->string('membership_number')->nullable()->unique(); // nomor keanggotaan
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('religion')->nullable();
            $table->jsonb('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->jsonb('duty_address')->nullable(); // kabupaten, kecamatan ['regency', 'district']
            $table->string('last_education')->nullable();
            $table->string('year_of_appointment')->nullable(); // tahun pengangkatan
            $table->string('main_job')->nullable();
            $table->json('technical_guidance')->nullable(); // bimbingan teknik dasar: no sertif, organizer, date, attachment
            $table->jsonb('attachments')->nullable(); // photo ktp, personal photo
            $table->boolean('is_active')->default(false); // status kinerja
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
        Schema::dropIfExists('psms');
    }
};
