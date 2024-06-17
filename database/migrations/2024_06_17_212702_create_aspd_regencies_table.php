<?php

use App\Models\Pillars\ASPD\ASPD;
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
            $table->string('name');
            $table->string('quota');
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
