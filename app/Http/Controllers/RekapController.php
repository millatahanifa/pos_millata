<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use Carbon\Carbon;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        // Ambil data penjualan khusus yang statusnya COMPLETED (selesai)
        $penjualan = Penjualan::where('status', 'COMPLETED')
                        ->whereMonth('created_at', $bulan)
                        ->whereYear('created_at', $tahun)
                        ->with('user')
                        ->latest()
                        ->get();

        $totalPendapatan = $penjualan->sum('total_pembayaran');
        $totalTransaksi = $penjualan->count();

        // --- MENGHITUNG DATA GRAFIK PER HARI ---
        $jumlahHari = Carbon::create($tahun, $bulan)->daysInMonth;
        $grafikHari = [];
        $grafikPendapatan = [];

        for ($i = 1; $i <= $jumlahHari; $i++) {
            $grafikHari[] = $i . ' ' . Carbon::create($tahun, $bulan)->translatedFormat('M');
            
            // Total omzet di tanggal ke-$i (hanya status COMPLETED)
            $omzetHarian = $penjualan->filter(function ($item) use ($i, $bulan, $tahun) {
                return Carbon::parse($item->created_at)->day == $i &&
                       Carbon::parse($item->created_at)->month == $bulan &&
                       Carbon::parse($item->created_at)->year == $tahun;
            })->sum('total_pembayaran');

            $grafikPendapatan[] = $omzetHarian;
        }

        return view('penjualan.rekap', compact(
            'penjualan', 
            'bulan', 
            'tahun', 
            'totalPendapatan', 
            'totalTransaksi',
            'grafikHari',
            'grafikPendapatan'
        ));
    }
}