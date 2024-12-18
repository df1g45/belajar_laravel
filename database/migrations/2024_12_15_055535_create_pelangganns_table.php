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
        Schema::create('pelangganns', function (Blueprint $table) {
            $table->bigIncrements('id_pelanggan')->primary(); // Custom Primary Key
            $table->string('nama_lengkap');
            $table->string('no_hp');
            $table->text('alamat');
            $table->string('pekerjaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelangganns');
    }
};
