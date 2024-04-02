<?php

use App\Models\Office;
use App\Models\Utilities\District;
use App\Models\Utilities\Regency;
use App\Models\Pillars\LKS\LKS;
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
        Schema::create('lks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->jsonb('address')->nullable(); // fulladdress, desa, kecamatan, kabupaten, rt, rw
            $table->enum('owner', [LKS::OWNER_KEMENSOS, LKS::OWNER_DINSOSPROV, LKS::OWNER_DINSOSKOTA, LKS::OWNER_MASYARAKAT])->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('leader_name')->nullable();
            $table->jsonb('attachments')->nullable(); // ktp leader, sk kemenkumham, akta notaris, npwp, foto leader, foto depan, foto papan
            $table->jsonb('siop_attachments')->nullable(); // siop prov, siop kab/kota
            $table->string('phone_number_leader')->nullable();
            $table->jsonb('clients')->nullable(); // pria, wanita
            $table->string('kemenkumham_number')->nullable();
            $table->string('sk_date')->nullable();
            $table->string('notary_name')->nullable();
            $table->string('number_akta')->nullable();
            $table->string('akta_date')->nullable();
            $table->string('prov_siop_number')->nullable();
            $table->string('prov_siop_date')->nullable();
            $table->string('regency_siop_number')->nullable();
            $table->string('regency_siop_date')->nullable();
            $table->string('since')->nullable();
            $table->string('npwp')->nullable()->unique();
            $table->boolean('is_active')->default(false);
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
        Schema::dropIfExists('lks');
    }
};
