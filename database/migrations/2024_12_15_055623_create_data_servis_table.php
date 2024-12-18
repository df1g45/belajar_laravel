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
        Schema::create('data_servis', function (Blueprint $table) {
            $table->id(); // Auto-increment ID for this table
            $table->unsignedBigInteger('id_service');
            $table->string('estimasi_service');
            $table->string('nama_mekanik');
            $table->text('sparepart_pengganti')->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('id_service')->references('id_service')->on('daftar_servis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_servis');
    }
};
