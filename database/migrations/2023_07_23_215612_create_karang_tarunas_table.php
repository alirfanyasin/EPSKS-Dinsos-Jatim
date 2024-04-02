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
        Schema::create('karang_tarunas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kartar');
            $table->string('alamat_sekretariat');
            $table->string('foto_sekretariat')->nullable();
            // $table->jsonb('address')->nullable(); // fulladdress, desa, kecamatan, kabupaten, rt, rw
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('desa');
            $table->string('no_telp_sekretariat')->nullable();
            $table->string('email_kartar');
            $table->string('no_sk')->nullable();
            $table->date('tanggal_sk');
            $table->string('penandatangan_sk');
            $table->string('selaku');
            $table->string('file_sk');
            $table->string('nama_ketua_kartar');
            $table->string('no_telp_wa');
            $table->string('foto_ketua');
            $table->string('jumlah_anggota_laki_laki')->nullable();
            $table->string('jumlah_anggota_perempuan')->nullable();
            $table->string('jumlah_pengurus_laki_laki')->nullable();
            $table->string('jumlah_pengurus_perempuan')->nullable();
            $table->string('klasifikasi_kartar')->nullable();
            $table->string('status_kinerja')->nullable();
            $table->string('status')->default('Tidak Lengkap')->nullable();
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
        Schema::dropIfExists('karang_tarunas');
    }
};
