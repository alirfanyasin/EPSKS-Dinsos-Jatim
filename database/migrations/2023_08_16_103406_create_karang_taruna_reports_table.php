<?php

use App\Models\Office;
use App\Models\Pillars\Kartar\KarangTaruna;
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
        Schema::create('karang_taruna_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Office::class, 'office_id')->constrained()->cascadeOnDelete();
            $table->string('period');
            $table->string('name_kartar');
            $table->string('regency');
            $table->string('distric');
            $table->string('village');
            $table->string('date')->nullable();
            $table->string('month')->nullable(); // month for monthly type
            $table->string('place')->nullable();
            $table->text('activity')->nullable();
            $table->text('constraint')->nullable();
            $table->string('attachment')->nullable(); // attachment for monthly type
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('Menunggu disetujui');
            $table->text('message')->nullable(); // message revision
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karang_taruna_reports');
    }
};
