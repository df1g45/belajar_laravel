<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    protected $fillable = [
        'id_service',
        'jumlah_biaya',
        'jenis_pembayaran',
        'keterangan',
    ];

    // Relationships
    public function daftarServis()
    {
        return $this->belongsTo(DaftarServis::class, 'id_service', 'id_service');
    }
}
