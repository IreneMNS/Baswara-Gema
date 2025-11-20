<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan'; // nama tabel di database

    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar_url',
        'harga',
        'kapasitas',
        'fasilitas',
    ];

    // Relasi ke reservasi
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'ruangan_id');
    }
}
