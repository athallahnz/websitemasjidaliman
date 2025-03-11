<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatans'; // Nama tabel di database

    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'kategori', // Tambahkan kategori agar bisa disimpan
        'tanggal_kegiatan', // Tambahkan tanggal kegiatan
        'link', // Tambahkan kolom link
    ];
}
