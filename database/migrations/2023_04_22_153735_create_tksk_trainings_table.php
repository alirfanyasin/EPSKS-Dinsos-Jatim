<?php

use App\Models\Pillars\TKSK\TKSK;
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
        Schema::create('tksk_trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TKSK::class, 'tksk_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('tksk_trainings');
    }
};
