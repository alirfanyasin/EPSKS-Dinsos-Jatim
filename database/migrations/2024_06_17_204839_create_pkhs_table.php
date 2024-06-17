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
        Schema::create('pkhs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nik');
            $table->string('gender');
            $table->string('tmt');
            $table->string('religion');
            $table->string('place_of_birth');
            $table->string('date_of_birth');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('no_npwp');
            $table->string('appointment_letter');
            $table->string('education');
            $table->string('pt_origin');
            $table->string('major');
            $table->string('clothes_size');
            $table->string('marital_status');
            $table->string('number_of_children');
            $table->string('no_bpjs');
            $table->string('husband_or_wife_name');
            $table->string('mother_name');
            $table->string('family_card_number');
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
        Schema::dropIfExists('pkhs');
    }
};
