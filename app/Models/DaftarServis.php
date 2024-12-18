<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarServis extends Model
{
    use HasFactory;

    protected $table = 'daftar_servis';
    protected $primaryKey = 'id_service';
    public $incrementing = true; // Auto-increment (default: true)
    protected $keyType = 'int'; // Tipe data integer

    protected $fillable = [
        'id_service',
        'no_plat',
        'id_pelanggan',
        'keluhan',
        'tanggal_service',
    ];

    // Relationships
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'no_plat', 'no_plat');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggann::class, 'id_pelanggan', 'id_pelanggan');
    }
}
