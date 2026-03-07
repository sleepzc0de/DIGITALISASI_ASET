<?php

namespace App\Imports;

use App\Models\DashboardAset;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class DashboardAsetImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    private const KONDISI_LIST = ['Baik', 'Rusak Ringan', 'Rusak Berat'];

    /**
     * Hasil import: summary & error rows
     */
    public int   $importedCount = 0;
    public int   $skippedCount  = 0;
    public array $errors        = [];

    public function collection(Collection $rows): void
    {
        foreach ($rows as $index => $row) {
            $rowNumber = $index + 2; // +2 karena baris 1 = heading

            // Normalisasi key (heading row kadang pakai spasi/underscore campur)
            $data = $this->normalizeRow($row->toArray());

            // Validasi per baris
            $validator = Validator::make($data, [
                'kategori_aset'   => 'required|string|max:100',
                'jumlah_unit'     => 'required|integer|min:1|max:999999',
                'nilai_perolehan' => 'required|numeric|min:0|max:999999999999',
                'nilai_buku'      => [
                    'required',
                    'numeric',
                    'min:0',
                    'max:999999999999',
                    'lte:nilai_perolehan',
                ],
                'kondisi'         => ['required', Rule::in(self::KONDISI_LIST)],
                'lokasi'          => 'required|string|max:200',
                'tahun'           => 'required|integer|min:2000|max:' . ((int) date('Y') + 1),
                'keterangan'      => 'nullable|string|max:1000',
            ]);

            if ($validator->fails()) {
                $this->errors[] = [
                    'row'     => $rowNumber,
                    'data'    => $data['kategori_aset'] ?? '(kosong)',
                    'messages'=> $validator->errors()->all(),
                ];
                $this->skippedCount++;
                continue;
            }

            DashboardAset::create($validator->validated());
            $this->importedCount++;
        }
    }

    /**
     * Normalisasi heading dari Excel → key yang konsisten.
     * Mengizinkan variasi: "Kategori Aset", "kategori_aset", "KATEGORI ASET", dll.
     */
    private function normalizeRow(array $row): array
    {
        $map = [];
        foreach ($row as $key => $value) {
            // Lowercase, ganti spasi & strip karakter aneh → snake_case sederhana
            $normalized = strtolower(trim((string) $key));
            $normalized = preg_replace('/[\s\-]+/', '_', $normalized);
            $normalized = preg_replace('/[^a-z0-9_]/', '', $normalized);
            $map[$normalized] = $value !== '' ? $value : null;
        }

        return [
            'kategori_aset'   => $map['kategori_aset']   ?? null,
            'jumlah_unit'     => isset($map['jumlah_unit'])
                                    ? (int) $map['jumlah_unit']
                                    : null,
            'nilai_perolehan' => isset($map['nilai_perolehan'])
                                    ? (float) $map['nilai_perolehan']
                                    : null,
            'nilai_buku'      => isset($map['nilai_buku'])
                                    ? (float) $map['nilai_buku']
                                    : null,
            'kondisi'         => $map['kondisi']          ?? null,
            'lokasi'          => $map['lokasi']           ?? null,
            'tahun'           => isset($map['tahun'])
                                    ? (int) $map['tahun']
                                    : null,
            'keterangan'      => $map['keterangan']       ?? null,
        ];
    }
}
