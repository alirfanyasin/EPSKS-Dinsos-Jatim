<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Pillars\ASPD\ASPD;
use App\Models\Pillars\ASPD\ASPDReport;
use App\Models\Review;
use App\Models\Office;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aspd_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ASPD::class, 'aspd_id')->constrained()->cascadeOnDelete();
            $table->string('date')->nullable(); // this can be used for daily or monthly date
            $table->string('venue')->nullable();
            $table->text('activity')->nullable();
            $table->text('constraint')->nullable(); // kendala
            $table->string('attachment_daily')->nullable();
            $table->string('attachment_monthly')->nullable();
            $table->string('month')->nullable();
            $table->text('description')->nullable();
            $table->enum('type', [ASPDReport::TYPE_DAILY, ASPDReport::TYPE_MONTHLY])->nullable();
            $table->text('message')->nullable();
            $table->foreignIdFor(Office::class, 'office_id')->nullable()->constrained()->cascadeOnDelete();
            $table->enum('status', [Review::STATUS_DRAFT, Review::STATUS_WAITING_APPROVAL, Review::STATUS_APPROVED, Review::STATUS_REVISION, Review::STATUS_REJECTED]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspd_reports');
    }
};
