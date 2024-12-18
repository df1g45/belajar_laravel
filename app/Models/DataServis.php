<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataServis extends Model
{
    use HasFactory;

    protected $table = 'data_servis';

    protected $fillable = [
        'id_service',
        'estimasi_service',
        'nama_mekanik',
        'sparepart_pengganti',
    ];

    // Relationships
    public function daftarServis()
    {
        return $this->belongsTo(DaftarServis::class, 'id_service', 'id_service');
    }
}
