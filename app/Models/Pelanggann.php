<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggann extends Model
{
    use HasFactory;

    protected $table = 'pelangganns';
    protected $primaryKey = 'id_pelanggan';
    public $incrementing = true; // Auto-increment (default: true)
    protected $keyType = 'int'; // Tipe data integer

    protected $fillable = [
        'id_pelanggan',
        'nama_lengkap',
        'no_hp',
        'alamat',
        'pekerjaan',
    ];
}
