<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'hobi',
        'foto',
        'no_hp',
        'email',
        'nama_ayah',
        'asal_sekolah',
        'nik',
    ];
}
