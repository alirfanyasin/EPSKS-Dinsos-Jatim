<?php

use App\Models\Pillars\PSM\PSM;
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
        Schema::create('psm_trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PSM::class, 'psm_id')->constrained()->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('organizer')->nullable();
            $table->string('certificate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('psm_trainings');
    }
};
