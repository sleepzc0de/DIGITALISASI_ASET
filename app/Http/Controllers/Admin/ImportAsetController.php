<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\DashboardAsetImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ImportAsetController extends Controller
{
    private const CACHE_KEY    = 'dashboard_aset_stats';
    private const MAX_FILE_MB  = 5;

    // ── Show form ──────────────────────────────────────────────────────────
    public function create()
    {
        return view('admin.dashboard-aset.import');
    }

    // ── Process import ─────────────────────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls,csv',
                'max:' . (self::MAX_FILE_MB * 1024), // KB
            ],
        ], [
            'file.required' => 'File wajib diunggah.',
            'file.mimes'    => 'Format file harus .xlsx, .xls, atau .csv.',
            'file.max'      => 'Ukuran file maksimal ' . self::MAX_FILE_MB . ' MB.',
        ]);

        $import = new DashboardAsetImport();

        try {
            Excel::import($import, $request->file('file'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // Tangkap error level-library (jarang terjadi karena kita pakai ToCollection)
            return back()
                ->with('import_error', 'File tidak dapat diproses: ' . $e->getMessage())
                ->withInput();
        } catch (\Exception $e) {
            return back()
                ->with('import_error', 'Terjadi kesalahan saat memproses file: ' . $e->getMessage())
                ->withInput();
        }

        // Hapus cache agar stats diperbarui
        Cache::forget(self::CACHE_KEY);

        // Siapkan pesan hasil
        $summary = "Berhasil mengimpor {$import->importedCount} data aset.";
        if ($import->skippedCount > 0) {
            $summary .= " {$import->skippedCount} baris dilewati karena error.";
        }

        return back()
            ->with('import_success', $summary)
            ->with('import_imported', $import->importedCount)
            ->with('import_skipped', $import->skippedCount)
            ->with('import_errors', $import->errors);
    }

    // ── Download template ──────────────────────────────────────────────────
    public function downloadTemplate(): StreamedResponse
    {
        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="template_import_aset.csv"',
        ];

        $callback = function () {
            $handle = fopen('php://output', 'w');

            // BOM UTF-8 agar Excel bisa baca karakter Indonesia
            fwrite($handle, "\xEF\xBB\xBF");

            // Header kolom
            fputcsv($handle, [
                'kategori_aset',
                'jumlah_unit',
                'nilai_perolehan',
                'nilai_buku',
                'kondisi',
                'lokasi',
                'tahun',
                'keterangan',
            ]);

            // Contoh baris 1
            fputcsv($handle, [
                'Elektronik',
                '5',
                '50000000',
                '40000000',
                'Baik',
                'Gedung A Lantai 2',
                '2022',
                'Laptop Dell Latitude',
            ]);

            // Contoh baris 2
            fputcsv($handle, [
                'Kendaraan',
                '1',
                '300000000',
                '200000000',
                'Rusak Ringan',
                'Parkir Basement',
                '2019',
                '',
            ]);

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
