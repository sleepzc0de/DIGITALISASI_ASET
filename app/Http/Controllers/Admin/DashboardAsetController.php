<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DashboardAset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DashboardAsetController extends Controller
{
    /**
     * Durasi cache dalam detik (5 menit).
     * Pisahkan konstanta agar mudah diubah.
     */
    private const CACHE_TTL    = 300;
    private const CACHE_KEY    = 'dashboard_aset_stats';
    private const PER_PAGE     = 15;
    private const KONDISI_LIST = ['Baik', 'Rusak Ringan', 'Rusak Berat'];

    // ── Index ──────────────────────────────────────────────────────────────
    public function index(Request $request)
    {
        // Validasi query string untuk keamanan (cegah injection via URL)
        $request->validate([
            'search'  => 'nullable|string|max:100',
            'kondisi' => ['nullable', Rule::in(self::KONDISI_LIST)],
            'sort'    => 'nullable|string|in:kategori_aset,jumlah_unit,nilai_buku,tahun,kondisi',
            'dir'     => 'nullable|in:asc,desc',
        ]);

        $query = DashboardAset::query();

        // ── Search ───────────────────────────────────────────────────────
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('kategori_aset', 'like', '%' . $search . '%')
                  ->orWhere('lokasi',       'like', '%' . $search . '%')
                  ->orWhere('keterangan',   'like', '%' . $search . '%');
            });
        }

        // ── Filter kondisi ───────────────────────────────────────────────
        if ($kondisi = $request->get('kondisi')) {
            $query->where('kondisi', $kondisi);
        }

        // ── Sort ─────────────────────────────────────────────────────────
        $sort = $request->get('sort', 'created_at');
        $dir  = $request->get('dir',  'desc');
        $query->orderBy($sort, $dir);

        // Paginate — withQueryString() menjaga filter aktif di link halaman
        $asets = $query->paginate(self::PER_PAGE)->withQueryString();

        // ── Summary stats via cache ──────────────────────────────────────
        // Hitung dari DB langsung (bukan dari paginated collection)
        // agar angka mencerminkan SEMUA data, bukan hanya halaman aktif.
        $stats = Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return DashboardAset::query()
                ->selectRaw('
                    COUNT(*)                          AS total_aset,
                    SUM(nilai_buku)                   AS total_nilai_buku,
                    AVG(nilai_buku)                   AS avg_nilai_buku,
                    COUNT(DISTINCT kategori_aset)     AS total_kategori,
                    COUNT(DISTINCT lokasi)            AS total_lokasi
                ')
                ->first();
        });

        return view('admin.dashboard-aset.index', compact('asets', 'stats'));
    }

    // ── Create ─────────────────────────────────────────────────────────────
    public function create()
    {
        return view('admin.dashboard-aset.create', [
            'kondisiList' => self::KONDISI_LIST,
            'currentYear' => (int) date('Y'),
        ]);
    }

    // ── Store ──────────────────────────────────────────────────────────────
    public function store(Request $request)
    {
        $validated = $this->validateAset($request);

        DashboardAset::create($validated);
        $this->clearCache();

        return redirect()
            ->route('admin.dashboard-aset.index')
            ->with('success', 'Data aset berhasil ditambahkan.');
    }

    // ── Show ───────────────────────────────────────────────────────────────
    public function show(DashboardAset $dashboardAset)
    {
        return view('admin.dashboard-aset.show', compact('dashboardAset'));
    }

    // ── Edit ───────────────────────────────────────────────────────────────
    public function edit(DashboardAset $dashboardAset)
    {
        return view('admin.dashboard-aset.edit', [
            'dashboardAset' => $dashboardAset,
            'kondisiList'   => self::KONDISI_LIST,
            'currentYear'   => (int) date('Y'),
        ]);
    }

    // ── Update ─────────────────────────────────────────────────────────────
    public function update(Request $request, DashboardAset $dashboardAset)
    {
        $validated = $this->validateAset($request);

        $dashboardAset->update($validated);
        $this->clearCache();

        return redirect()
            ->route('admin.dashboard-aset.index')
            ->with('success', 'Data aset berhasil diperbarui.');
    }

    // ── Destroy ────────────────────────────────────────────────────────────
    public function destroy(DashboardAset $dashboardAset)
    {
        $dashboardAset->delete();
        $this->clearCache();

        return redirect()
            ->route('admin.dashboard-aset.index')
            ->with('success', 'Data aset berhasil dihapus.');
    }

    // ══════════════════════════════════════════════════════════════════════
    //  PRIVATE HELPERS
    // ══════════════════════════════════════════════════════════════════════

    /**
     * Aturan validasi terpusat — dipakai oleh store & update.
     * Menghindari duplikasi kode dan memudahkan perubahan di masa depan.
     */
    private function validateAset(Request $request): array
    {
        return $request->validate([
            'kategori_aset'   => 'required|string|max:100',
            'jumlah_unit'     => 'required|integer|min:1|max:999999',
            'nilai_perolehan' => 'required|numeric|min:0|max:999999999999',
            'nilai_buku'      => [
                'required',
                'numeric',
                'min:0',
                'max:999999999999',
                // Nilai buku tidak boleh melebihi nilai perolehan
                'lte:nilai_perolehan',
            ],
            'kondisi'         => ['required', Rule::in(self::KONDISI_LIST)],
            'lokasi'          => 'required|string|max:200',
            'tahun'           => 'required|integer|min:2000|max:' . ((int) date('Y') + 1),
            'keterangan'      => 'nullable|string|max:1000',
        ]);
    }

    /**
     * Hapus semua cache yang berkaitan dengan dashboard aset.
     */
    private function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
