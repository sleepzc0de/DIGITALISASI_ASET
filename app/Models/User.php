<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Super Admin Credentials (Protected)
    const SUPER_ADMIN_NIP = '199609102018011005';
    const SUPER_ADMIN_EMAIL = 'auliyaputraazhari@kemenkeu.go.id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_super_admin',
        'sso_id',
        'nip',
        'nik',
        'jabatan',
        'unit_kerja',
        'kode_satker',
        'nama_satker',
        'avatar',
        'sso_data',
        'last_sso_login',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'sso_data' => 'array',
            'last_sso_login' => 'datetime',
            'is_super_admin' => 'boolean',
        ];
    }

    /**
     * Check if user is Super Admin
     */
    public function isSuperAdmin(): bool
    {
        return $this->is_super_admin === true;
    }

    /**
     * Check if user is Admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin' || $this->is_super_admin;
    }

    /**
     * Check if user is regular User
     */
    public function isUser(): bool
    {
        return $this->role === 'user' && !$this->is_super_admin;
    }

    /**
     * Check if user is SSO User
     */
    public function isSSOUser(): bool
    {
        return !empty($this->sso_id);
    }

    /**
     * Get Avatar URL
     */
    public function getAvatarUrl(): string
    {
        if ($this->avatar) {
            return $this->avatar;
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=4F46E5&background=EEF2FF&size=200';
    }

    /**
     * Check if this user is Super Admin by NIP or Email
     */
    public static function isSuperAdminCredentials($nip = null, $email = null): bool
    {
        if ($nip && $nip === self::SUPER_ADMIN_NIP) {
            return true;
        }

        if ($email && $email === self::SUPER_ADMIN_EMAIL) {
            return true;
        }

        return false;
    }

    /**
     * Prevent deletion of Super Admin
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            if ($user->is_super_admin) {
                throw new \Exception('Super Admin tidak dapat dihapus!');
            }
        });
    }
}
