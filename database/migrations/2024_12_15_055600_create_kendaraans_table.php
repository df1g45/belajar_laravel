<?php

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
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->string('no_plat')->primary(); // Custom Primary Key
            $table->enum('jenis_kendaraan', ['Matic', 'Manual Transmisi']); // Radio button options
            $table->string('no_stnk');
            $table->year('tahun_pembuatan');
            $table->string('nama_pemilik');
            $table->string('warna');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};
