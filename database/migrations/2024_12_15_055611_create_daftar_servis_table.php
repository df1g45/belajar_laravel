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
        Schema::create('daftar_servis', function (Blueprint $table) {
            $table->bigIncrements('id_service')->primary(); // Custom Primary Key
            $table->string('no_plat');
            $table->unsignedBigInteger('id_pelanggan');
            $table->text('keluhan');
            $table->date('tanggal_service');
            $table->timestamps();

            // Foreign keys
            $table->foreign('no_plat')->references('no_plat')->on('kendaraans')->onDelete('cascade');
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelangganns')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_servis');
    }
};
