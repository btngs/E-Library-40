<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function index(): View
    {
        // Statistik tahun ini
        $totalPinjamTahunIni = Peminjaman::whereYear('created_at', date('Y'))->count();
        $totalDendaTahunIni = Peminjaman::whereYear('created_at', date('Y'))
            ->where('denda_lunas', true)
            ->sum('denda');

        // Rekap bulanan
        $rekapBulanan = Peminjaman::query()
            ->select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('YEAR(created_at) as tahun'),
                DB::raw('COUNT(*) as total_pinjam'),
                DB::raw('SUM(CASE WHEN denda_lunas = 1 THEN denda ELSE 0 END) as total_denda_lunas'),
                DB::raw('SUM(CASE WHEN denda_lunas = 0 THEN denda ELSE 0 END) as total_denda_berjalan')
            )
            ->groupBy('tahun', 'bulan')
            ->orderByDesc('tahun')
            ->orderByDesc('bulan')
            ->get();

        return view('laporan.index', compact('rekapBulanan', 'totalPinjamTahunIni', 'totalDendaTahunIni'));
    }
}
