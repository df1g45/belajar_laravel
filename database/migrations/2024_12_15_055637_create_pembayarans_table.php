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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id(); // Auto-increment ID for this table
            $table->unsignedBigInteger('id_service');
            $table->decimal('jumlah_biaya', 10, 2); // Format for currency
            $table->enum('jenis_pembayaran', ['Cash', 'Non Tunai']); // Radio button options
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('pembayarans');
    }
};
