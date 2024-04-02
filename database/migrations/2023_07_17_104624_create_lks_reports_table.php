<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Pillars\LKS\LKSReport;
use App\Models\Pillars\LKS\LKS;
use App\Models\Office;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lks_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LKS::class, 'lks_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Office::class, 'office_id')->nullable()->constrained()->cascadeOnDelete();
            $table->enum('type', [LKSReport::PERIOD_DAILY, LKSReport::PERIOD_MONTHLY]);
            $table->enum('status', [LKSReport::STATUS_DRAFT, LKSReport::STATUS_APPROVE, LKSReport::STATUS_WAITING_APPROVAL, LKSReport::STATUS_REVISION, LKSReport::STATUS_REJECT]);
            $table->string('attachment')->nullable();
            $table->string('date')->nullable();
            $table->string('venue')->nullable();
            $table->longText('activity')->nullable();
            $table->longText('constraint')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('is_super_admin_approve')->default(false);
            $table->boolean('is_admin_approve')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lks_reports');
    }
};
