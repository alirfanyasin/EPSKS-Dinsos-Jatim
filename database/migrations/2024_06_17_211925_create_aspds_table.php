<?php

use App\Models\Office;
use App\Models\User;
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
        Schema::create('aspds', function (Blueprint $table) {
            $table->id();
            $table->string('regency');
            $table->string('name');
            $table->string('nik');
            $table->string('address');
            $table->string('identity_photo');
            $table->string('phone');
            $table->string('explanation');
            $table->foreignIdFor(Office::class, 'office_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class, 'user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspds');
    }
};
