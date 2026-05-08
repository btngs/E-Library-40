<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori',
    ];

    public function buku(): BelongsToMany
    {
        return $this->belongsToMany(Buku::class, 'buku_kategori');
    }
}
