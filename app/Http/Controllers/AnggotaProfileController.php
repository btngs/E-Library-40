<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnggotaProfileController extends Controller
{
    public function show(Request $request): View
    {
        $user = $request->user();
        $startDate = Carbon::parse(now()->subDays(27)->startOfDay());

        $riwayatSebulan = Peminjaman::query()
            ->where('user_id', $user->id)
            ->whereIn('status', [Peminjaman::STATUS_DIPINJAM, Peminjaman::STATUS_DIKEMBALIKAN])
            ->whereDate('tanggal_pinjam', '>=', $startDate->toDateString())
            ->get();

        $labels = collect(range(0, 3))->map(function (int $index) use ($startDate) {
            $weekStart = $startDate->copy()->addDays($index * 7);
            $weekEnd = $weekStart->copy()->addDays(6);

            return $weekStart->format('d M') . ' - ' . $weekEnd->format('d M');
        });

        $chartData = collect(range(0, 3))->map(function (int $index) use ($riwayatSebulan, $startDate) {
            $weekStart = $startDate->copy()->addDays($index * 7);
            $weekEnd = $weekStart->copy()->addDays(6)->endOfDay();

            return $riwayatSebulan->filter(function ($item) use ($weekStart, $weekEnd) {
                $tanggalPinjam = $item->tanggal_pinjam
                    ? Carbon::parse($item->tanggal_pinjam)
                    : null;

                return $tanggalPinjam
                    && $tanggalPinjam->between($weekStart, $weekEnd);
            })->count();
        });

        return view('anggota.profile.show', [
            'chartLabels' => $labels,
            'chartData' => $chartData,
            'maxChartValue' => max(1, (int) $chartData->max()),
            'totalPinjamSebulan' => $riwayatSebulan->count(),
            'totalAktif' => $riwayatSebulan->where('status', Peminjaman::STATUS_DIPINJAM)->count(),
            'totalDenda' => $riwayatSebulan->where('status', Peminjaman::STATUS_DIPINJAM)->sum('estimated_denda'),
        ]);
    }
}
