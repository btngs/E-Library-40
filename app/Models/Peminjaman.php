<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peminjaman extends Model
{
    public const STATUS_MENUNGGU = 'menunggu';
    public const STATUS_DIPINJAM = 'dipinjam';
    public const STATUS_PENDING_KEMBALI = 'pending_kembali';
    public const STATUS_DIKEMBALIKAN = 'dikembalikan';

    protected $table = 'peminjaman';

    protected $fillable = [
        'user_id',
        'buku_id',
        'tanggal_pinjam',
        'jatuh_tempo',
        'tanggal_kembali',
        'status',
        'denda',
        'denda_lunas',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pinjam' => 'date',
            'jatuh_tempo' => 'date',
            'tanggal_kembali' => 'date',
            'denda_lunas' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class);
    }

    public function getEstimatedDendaAttribute(): int
    {
        if (($this->denda ?? 0) > 0) {
            return (int) $this->denda;
        }

        if ($this->status !== self::STATUS_DIPINJAM || ! $this->jatuh_tempo || ! $this->jatuh_tempo->isPast()) {
            return 0;
        }

        return $this->jatuh_tempo->diffInDays(now()) * 1000;
    }
}
