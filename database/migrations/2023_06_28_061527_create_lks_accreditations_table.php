<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Pillars\LKS\LKS;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lks_accreditations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LKS::class, 'lks_id')->constrained()->cascadeOnDelete();
            $table->string('assessment_year');
            $table->string('grade');
            $table->string('attachment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lks_accreditations');
    }
};
