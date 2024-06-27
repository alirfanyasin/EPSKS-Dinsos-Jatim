<?php

use App\Models\Office;
use App\Models\Pillars\PKH\PKH;
use App\Models\Pillars\PKH\PKHReport;
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
        Schema::create('pkh_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PKH::class, 'pkh_id')->constrained()->cascadeOnDelete();
            $table->string('date')->nullable(); // this can be used for daily or monthly date
            $table->string('venue')->nullable();
            $table->text('activity')->nullable();
            $table->text('constraint')->nullable(); // kendala
            $table->string('attachment_daily')->nullable();
            $table->string('attachment_monthly')->nullable();
            $table->string('month')->nullable();
            $table->text('description')->nullable();
            $table->enum('type', [PKHReport::TYPE_DAILY, PKHReport::TYPE_MONTHLY])->nullable();
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
        Schema::dropIfExists('pkh_reports');
    }
};
