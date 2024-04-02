<?php

use App\Models\Review;
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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('sequence')->default(1);
            $table->morphs('reviewable');
            $table->foreignId('reviewed_by')->nullable()->constrained('users');
            $table->enum('status', [Review::STATUS_DRAFT, Review::STATUS_WAITING_APPROVAL, Review::STATUS_APPROVED, Review::STATUS_REVISION, Review::STATUS_REJECTED]);
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
