<?php

namespace App\Hashing;

use Illuminate\Hashing\BcryptHasher;

class PepperedHasher extends BcryptHasher
{
    protected string $pepper;

    public function __construct(array $options = [])
    {
        parent::__construct($options);
        // Ambil pepper dari config yang baca dari .env
        $this->pepper = config('app.pepper', '');
    }

    /**
     * Hash password dengan pepper sebelum bcrypt.
     * Menggunakan HMAC-SHA256 karena bcrypt ada batas 72 karakter,
     * output HMAC selalu 64 char hex — aman & konsisten.
     */
    public function make($value, array $options = []): string
    {
        $pepperedValue = $this->applyPepper($value);
        return parent::make($pepperedValue, $options);
    }

    /**
     * Verifikasi password dengan pepper yang sama.
     */
    public function check($value, $hashedValue, array $options = []): bool
    {
        if (empty($hashedValue)) {
            return false;
        }
        $pepperedValue = $this->applyPepper($value);
        return parent::check($pepperedValue, $hashedValue, $options);
    }

    /**
     * Apply pepper menggunakan HMAC-SHA256.
     */
    private function applyPepper(string $value): string
    {
        return hash_hmac('sha256', $value, $this->pepper);
    }
}
