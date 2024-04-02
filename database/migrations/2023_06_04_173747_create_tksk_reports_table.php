<?php

use App\Models\Office;
use App\Models\Pillars\TKSK\TKSK;
use App\Models\Pillars\TKSK\TKSKReport;
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
        Schema::create('tksk_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TKSK::class, 'tksk_id')->constrained()->cascadeOnDelete();
            $table->string('date')->nullable();
            $table->string('venue')->nullable();
            $table->text('activity')->nullable();
            $table->text('constraint')->nullable(); // kendala
            $table->string('attachment')->nullable();
            $table->text('description')->nullable();
            $table->enum('type', [TKSKReport::TYPE_DAILY, TKSKReport::TYPE_MONTHLY])->nullable();
            $table->foreignIdFor(Office::class, 'office_id')->nullable()->constrained()->cascadeOnDelete();
            $table->enum('status', [Review::STATUS_DRAFT, Review::STATUS_WAITING_APPROVAL, Review::STATUS_APPROVED, Review::STATUS_REVISION, Review::STATUS_REJECTED]);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tksk_reports');
    }
};
