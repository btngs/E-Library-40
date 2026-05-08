<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';

    protected $fillable = [
        'cover',
        'judul',
        'pengarang',
        'deskripsi',
        'tahun_terbit',
        'stok',
    ];

    public function kategori(): BelongsToMany
    {
        return $this->belongsToMany(Kategori::class, 'buku_kategori');
    }

    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }
}
