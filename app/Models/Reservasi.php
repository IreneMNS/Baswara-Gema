<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi'; // nama tabel di database

    protected $fillable = [
        'nama_customer',
        'email',
        'telepon',
        'ruangan_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
    ];

    // Relasi ke ruangan
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }
}
