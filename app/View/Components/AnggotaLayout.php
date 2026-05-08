<?php

namespace App\View\Components;

use App\Models\Peminjaman;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AnggotaLayout extends Component
{
    public int $totalDendaAktif;

    public function __construct()
    {
        $user = auth()->user();

        $this->totalDendaAktif = $user
            ? Peminjaman::query()
                ->where('user_id', $user->id)
                ->where('status', Peminjaman::STATUS_DIPINJAM)
                ->get()
                ->sum('estimated_denda')
            : 0;
    }

    public function render(): View|Closure|string
    {
        return view('layouts.anggota');
    }
}
