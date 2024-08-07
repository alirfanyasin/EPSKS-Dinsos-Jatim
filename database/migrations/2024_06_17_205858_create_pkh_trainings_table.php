<?php

use App\Models\Pillars\PKH\PKH;
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
        Schema::create('pkh_trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PKH::class, 'pkh_id')->constrained()->cascadeOnDelete();
            $table->string('training_name');
            $table->string('organizer');
            $table->string('date');
            $table->string('certificate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pkh_trainings');
    }
};
