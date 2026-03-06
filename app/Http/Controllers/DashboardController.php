<?php

namespace App\Http\Controllers;

use App\Models\DashboardAset;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private const CACHE_TTL = 3600;
    private const CACHE_KEY = 'dashboard_aset_data';

    public function index(): View
    {
        $data = Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {

            $kategoriData = DashboardAset::selectRaw(
                                'kategori_aset, SUM(jumlah_unit) as total'
                            )
                            ->groupBy('kategori_aset')
                            ->orderByDesc('total')
                            ->get();

            $kondisiData = DashboardAset::selectRaw(
                               'kondisi, SUM(jumlah_unit) as total'
                           )
                           ->whereNotNull('kondisi')
                           ->groupBy('kondisi')
                           ->get();

            $nilaiPerKategori = DashboardAset::selectRaw(
                                    'kategori_aset, SUM(nilai_buku) as total_nilai'
                                )
                                ->groupBy('kategori_aset')
                                ->orderByDesc('total_nilai')
                                ->get();

            $trendTahunan = DashboardAset::selectRaw(
                                'tahun, SUM(jumlah_unit) as total'
                            )
                            ->whereNotNull('tahun')
                            ->groupBy('tahun')
                            ->orderBy('tahun')
                            ->get();

            // ── Agregat dasar ─────────────────────────────────────────
            $totalAset        = (int) $kategoriData->sum('total');
            $totalNilai       = (float) $nilaiPerKategori->sum('total_nilai');

            $kondisiBaikRow   = $kondisiData->firstWhere('kondisi', 'Baik');
            $kondisiBaik      = $kondisiBaikRow ? (int) $kondisiBaikRow->total : 0;
            $totalKondisiUnit = (int) $kondisiData->sum('total');
            $persentaseBaik   = $totalKondisiUnit > 0
                                    ? (int) round(($kondisiBaik / $totalKondisiUnit) * 100)
                                    : 0;

            // ── Pertumbuhan unit aset: bulan ini vs bulan lalu ────────
            $bulanIni   = now()->month;
            $tahunIni   = now()->year;
            $bulanLalu  = now()->subMonth()->month;
            $tahunLalu  = now()->subMonth()->year;

            $unitBulanIni = (int) DashboardAset::whereMonth('created_at', $bulanIni)
                                ->whereYear('created_at', $tahunIni)
                                ->sum('jumlah_unit');

            $unitBulanLalu = (int) DashboardAset::whereMonth('created_at', $bulanLalu)
                                ->whereYear('created_at', $tahunLalu)
                                ->sum('jumlah_unit');

            // Hitung persentase pertumbuhan unit
            $pertumbuhanUnit = null; // null = tidak ada data pembanding
            if ($unitBulanLalu > 0) {
                $pertumbuhanUnit = round(
                    (($unitBulanIni - $unitBulanLalu) / $unitBulanLalu) * 100,
                    1
                );
            } elseif ($unitBulanIni > 0 && $unitBulanLalu === 0) {
                // Ada data bulan ini tapi tidak ada bulan lalu = data baru
                $pertumbuhanUnit = null;
            }

            // ── Pertumbuhan nilai aset: bulan ini vs bulan lalu ───────
            $nilaiBulanIni = (float) DashboardAset::whereMonth('created_at', $bulanIni)
                                ->whereYear('created_at', $tahunIni)
                                ->sum('nilai_buku');

            $nilaiBulanLalu = (float) DashboardAset::whereMonth('created_at', $bulanLalu)
                                ->whereYear('created_at', $tahunLalu)
                                ->sum('nilai_buku');

            // Hitung persentase pertumbuhan nilai
            $pertumbuhanNilai = null;
            if ($nilaiBulanLalu > 0) {
                $pertumbuhanNilai = round(
                    (($nilaiBulanIni - $nilaiBulanLalu) / $nilaiBulanLalu) * 100,
                    1
                );
            }

            // ── Rata-rata pertumbuhan trend tahunan ───────────────────
            // Hitung dari data trendTahunan yang sudah ada (tidak query baru)
            $rataRataPertumbuhanTahunan = null;
            if ($trendTahunan->count() >= 2) {
                $pertumbuhanList = [];
                $trendArr = $trendTahunan->values();

                for ($i = 1; $i < $trendArr->count(); $i++) {
                    $prev = (int) $trendArr[$i - 1]->total;
                    $curr = (int) $trendArr[$i]->total;
                    if ($prev > 0) {
                        $pertumbuhanList[] = (($curr - $prev) / $prev) * 100;
                    }
                }

                if (count($pertumbuhanList) > 0) {
                    $rataRataPertumbuhanTahunan = round(
                        array_sum($pertumbuhanList) / count($pertumbuhanList),
                        1
                    );
                }
            }

            return array_merge([
                'totalAset'                  => 0,
                'totalNilai'                 => 0,
                'kategoriData'               => collect(),
                'kondisiData'                => collect(),
                'nilaiPerKategori'           => collect(),
                'trendTahunan'               => collect(),
                'kondisiBaik'                => 0,
                'persentaseBaik'             => 0,
                'pertumbuhanUnit'            => null,
                'pertumbuhanNilai'           => null,
                'rataRataPertumbuhanTahunan' => null,
            ], compact(
                'totalAset',
                'totalNilai',
                'kategoriData',
                'kondisiData',
                'nilaiPerKategori',
                'trendTahunan',
                'kondisiBaik',
                'persentaseBaik',
                'pertumbuhanUnit',
                'pertumbuhanNilai',
                'rataRataPertumbuhanTahunan',
            ));
        });

        return view('dashboard.index', $data);
    }
}
