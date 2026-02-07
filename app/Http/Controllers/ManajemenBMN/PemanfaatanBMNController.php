<?php

namespace App\Http\Controllers\ManajemenBMN;

use App\Http\Controllers\Controller;
use App\Models\PemanfaatanBMN;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PemanfaatanBMNController extends Controller
{
    public function index(Request $request)
    {
        $query = PemanfaatanBMN::query();

        if ($request->has('jenis') && $request->jenis) {
            $query->where('jenis_pemanfaatan', $request->jenis);
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $pemanfaatans = $query->latest()->paginate(15);

        $stats = [
            'total' => PemanfaatanBMN::count(),
            'aktif' => PemanfaatanBMN::where('status', 'Aktif')->count(),
            'sk_sewa' => PemanfaatanBMN::where('jenis_pemanfaatan', 'SK Sewa')->count(),
            'izin_penghunian' => PemanfaatanBMN::where('jenis_pemanfaatan', 'Izin Penghunian')->count(),
            'total_nilai_sewa' => PemanfaatanBMN::where('status', 'Aktif')->sum('nilai_sewa_tahunan'),
        ];

        // Data untuk chart dengan fallback default
        $chartData = $this->getChartData();
        $graphData = $this->getGraphData();

        return view('manajemen-bmn.pemanfaatan.index', compact('pemanfaatans', 'stats', 'chartData', 'graphData'));
    }

    public function show(PemanfaatanBMN $pemanfaatan)
    {
        return view('manajemen-bmn.pemanfaatan.show', compact('pemanfaatan'));
    }

    public function peta()
    {
        $pemanfaatans = PemanfaatanBMN::where('status', 'Aktif')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        return view('manajemen-bmn.pemanfaatan.peta', compact('pemanfaatans'));
    }

    /**
     * Get data untuk chart dashboard dengan fallback default
     */
    private function getChartData()
    {
        try {
            // Data Pie Chart: Distribusi Jenis Pemanfaatan
            $skSewaCount = PemanfaatanBMN::where('jenis_pemanfaatan', 'SK Sewa')->count();
            $izinCount = PemanfaatanBMN::where('jenis_pemanfaatan', 'Izin Penghunian')->count();

            $jenisData = [
                'labels' => ['SK Sewa', 'Izin Penghunian'],
                'data' => [
                    $skSewaCount > 0 ? $skSewaCount : 0,
                    $izinCount > 0 ? $izinCount : 0
                ],
                'colors' => ['#10b981', '#3b82f6']
            ];

            // Data Pie Chart: Distribusi Status
            $statusAktif = PemanfaatanBMN::where('status', 'Aktif')->count();
            $statusBerakhir = PemanfaatanBMN::where('status', 'Berakhir')->count();
            $statusDiperpanjang = PemanfaatanBMN::where('status', 'Diperpanjang')->count();
            $statusDibatalkan = PemanfaatanBMN::where('status', 'Dibatalkan')->count();

            $statusData = [
                'labels' => ['Aktif', 'Berakhir', 'Diperpanjang', 'Dibatalkan'],
                'data' => [
                    $statusAktif > 0 ? $statusAktif : 0,
                    $statusBerakhir > 0 ? $statusBerakhir : 0,
                    $statusDiperpanjang > 0 ? $statusDiperpanjang : 0,
                    $statusDibatalkan > 0 ? $statusDibatalkan : 0
                ],
                'colors' => ['#10b981', '#ef4444', '#f59e0b', '#6b7280']
            ];

            // Data Top 5 Nilai Sewa Terbesar
            $topSewa = PemanfaatanBMN::whereNotNull('nilai_sewa_tahunan')
                ->where('nilai_sewa_tahunan', '>', 0)
                ->orderBy('nilai_sewa_tahunan', 'desc')
                ->take(5)
                ->get();

            $topSewaData = [
                'labels' => [],
                'data' => [],
                'full_labels' => [],
                'nilai_penuh' => []
            ];

            if ($topSewa->isNotEmpty()) {
                $topSewaData = [
                    'labels' => $topSewa->map(function($item) {
                        return strlen($item->nama_pihak_ketiga) > 15
                            ? substr($item->nama_pihak_ketiga, 0, 12) . '...'
                            : $item->nama_pihak_ketiga;
                    })->toArray(),
                    'data' => $topSewa->map(function($item) {
                        return $item->nilai_sewa_tahunan > 0 ? $item->nilai_sewa_tahunan / 1000000 : 0;
                    })->toArray(),
                    'full_labels' => $topSewa->pluck('nama_pihak_ketiga')->toArray(),
                    'nilai_penuh' => $topSewa->pluck('nilai_sewa_tahunan')->toArray()
                ];
            } else {
                // Default data jika tidak ada nilai sewa
                $topSewaData = [
                    'labels' => ['Belum ada data'],
                    'data' => [0],
                    'full_labels' => ['Tidak ada data nilai sewa'],
                    'nilai_penuh' => [0]
                ];
            }

            return [
                'jenis' => $jenisData,
                'status' => $statusData,
                'top_sewa' => $topSewaData
            ];

        } catch (\Exception $e) {
            \Log::error('Error generating chart data: ' . $e->getMessage());

            // Return default chart data jika error
            return [
                'jenis' => [
                    'labels' => ['SK Sewa', 'Izin Penghunian'],
                    'data' => [0, 0],
                    'colors' => ['#10b981', '#3b82f6']
                ],
                'status' => [
                    'labels' => ['Aktif', 'Berakhir', 'Diperpanjang', 'Dibatalkan'],
                    'data' => [0, 0, 0, 0],
                    'colors' => ['#10b981', '#ef4444', '#f59e0b', '#6b7280']
                ],
                'top_sewa' => [
                    'labels' => ['Belum ada data'],
                    'data' => [0],
                    'full_labels' => ['Tidak ada data'],
                    'nilai_penuh' => [0]
                ]
            ];
        }
    }

    /**
     * Get data untuk grafik trend dengan fallback default
     */
    private function getGraphData()
    {
        try {
            // Data Trend Bulanan (Pemanfaatan yang dibuat per bulan)
            $months = [];
            $monthlyData = [];
            $colors = [];

            // Generate 6 bulan terakhir
            for ($i = 5; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i);
                $monthName = $month->translatedFormat('M');
                $months[] = $monthName;

                // Hitung jumlah data per bulan
                $count = PemanfaatanBMN::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count();
                $monthlyData[] = max(0, $count); // Pastikan tidak negatif

                // Generate gradient color
                $colorIntensity = max(100, 500 - ($i * 80));
                $colors[] = "rgba(59, 130, 246, " . ($colorIntensity / 1000) . ")";
            }

            // Data Nilai Sewa per Jenis
            $sewaSK = PemanfaatanBMN::where('jenis_pemanfaatan', 'SK Sewa')
                ->where('status', 'Aktif')
                ->sum('nilai_sewa_tahunan') ?? 0;

            $sewaPerJenis = [
                'SK Sewa' => $sewaSK > 0 ? $sewaSK : 0,
                'Izin Penghunian' => 0
            ];

            return [
                'months' => $months,
                'monthly_data' => $monthlyData,
                'monthly_colors' => $colors,
                'sewa_per_jenis' => $sewaPerJenis
            ];

        } catch (\Exception $e) {
            \Log::error('Error generating graph data: ' . $e->getMessage());

            // Return default graph data
            $currentMonth = Carbon::now()->translatedFormat('M');
            return [
                'months' => [$currentMonth],
                'monthly_data' => [0],
                'monthly_colors' => ['rgba(59, 130, 246, 0.4)'],
                'sewa_per_jenis' => [
                    'SK Sewa' => 0,
                    'Izin Penghunian' => 0
                ]
            ];
        }
    }
}
