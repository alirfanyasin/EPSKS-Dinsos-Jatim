<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Pillars\LKS\LKSManagement;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lks_training_management', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LKSManagement::class, 'lks_management_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('organizer');
            $table->string('date');
            $table->string('attachment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lks_training_management');
    }
};
