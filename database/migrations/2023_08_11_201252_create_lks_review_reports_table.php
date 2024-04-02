<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Pillars\LKS\LKSReport;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lks_review_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LKSReport::class, 'lks_report_id')->constrained()->cascadeOnDelete();
            $table->foreignId('reviewed_by')->nullable()->constrained('users');
            $table->enum('status', [LKSReport::STATUS_DRAFT, LKSReport::STATUS_APPROVE, LKSReport::STATUS_WAITING_APPROVAL, LKSReport::STATUS_REVISION, LKSReport::STATUS_REJECT]);
            $table->string('note')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lks_review_reports');
    }
};
