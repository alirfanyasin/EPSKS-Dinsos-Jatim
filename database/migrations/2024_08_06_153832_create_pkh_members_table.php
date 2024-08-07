<?php

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
        Schema::create('pkh_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pkh_id');
            $table->string('name_member');
            $table->string('nik', 16);
            $table->string('photo_identity');
            $table->string('gender');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('phone_number');
            $table->string('religion');
            $table->string('last_education')->nullable();
            $table->string('main_job')->nullable();
            $table->string('address')->nullable();
            $table->string('position')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pkh_members');
    }
};
