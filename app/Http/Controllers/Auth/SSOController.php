<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SSOController extends Controller
{
    protected $clientId;
    protected $clientSecret;
    protected $redirectUri;
    protected $authorizeUrl;
    protected $tokenUrl;
    protected $userInfoUrl;
    protected $logoutUrl;
    protected $scope;

    public function __construct()
    {
        $this->clientId = config('services.sso.client_id');
        $this->clientSecret = config('services.sso.client_secret');
        $this->redirectUri = config('services.sso.redirect_uri');
        $this->authorizeUrl = config('services.sso.authorize_url');
        $this->tokenUrl = config('services.sso.token_url');
        $this->userInfoUrl = config('services.sso.userinfo_url');
        $this->logoutUrl = config('services.sso.logout_url');
        $this->scope = config('services.sso.scope');
    }

    /**
     * Redirect ke SSO Login
     */
    public function redirectToSSO()
    {
        $state = Str::random(40);
        $nonce = Str::random(40);

        session([
            'sso_state' => $state,
            'sso_nonce' => $nonce,
        ]);

        $params = [
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUri,
            'response_type' => 'code',
            'scope' => $this->scope,
            'state' => $state,
            'nonce' => $nonce,
        ];

        $authorizeUrl = $this->authorizeUrl . '?' . http_build_query($params);

        return redirect($authorizeUrl);
    }

    /**
     * Handle SSO Callback
     */
    public function handleCallback(Request $request)
    {
        try {
            // Validasi state untuk CSRF protection
            if ($request->state !== session('sso_state')) {
                return redirect()->route('login')->with('error', 'Invalid state parameter. Possible CSRF attack.');
            }

            // Cek apakah ada error dari SSO
            if ($request->has('error')) {
                Log::error('SSO Error: ' . $request->error_description);
                return redirect()->route('login')->with('error', 'SSO Authentication failed: ' . $request->error_description);
            }

            // Cek apakah ada authorization code
            if (!$request->has('code')) {
                return redirect()->route('login')->with('error', 'Authorization code not found.');
            }

            // Exchange authorization code untuk access token
            $tokenResponse = $this->getAccessToken($request->code);

            if (!$tokenResponse || !isset($tokenResponse['access_token'])) {
                Log::error('Failed to get access token', ['response' => $tokenResponse]);
                return redirect()->route('login')->with('error', 'Failed to obtain access token.');
            }

            // Get user info dari SSO
            $userInfo = $this->getUserInfo($tokenResponse['access_token']);

            if (!$userInfo) {
                Log::error('Failed to get user info');
                return redirect()->route('login')->with('error', 'Failed to obtain user information.');
            }

            // Create atau update user
            $user = $this->createOrUpdateUser($userInfo, $tokenResponse);

            // Login user
            Auth::login($user, true);

            // Clear session SSO
            session()->forget(['sso_state', 'sso_nonce']);

            return redirect()->intended(route('dashboard'))->with('success', 'Berhasil login dengan SSO Kemenkeu!');
        } catch (\Exception $e) {
            Log::error('SSO Callback Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login SSO: ' . $e->getMessage());
        }
    }

    /**
     * Get Access Token dari authorization code
     */
    protected function getAccessToken($code)
    {
        try {
            $response = Http::asForm()->post($this->tokenUrl, [
                'grant_type' => 'authorization_code',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'code' => $code,
                'redirect_uri' => $this->redirectUri,
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Token request failed', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('Token request exception: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Get User Info dari SSO
     */
    protected function getUserInfo($accessToken)
    {
        try {
            $response = Http::withToken($accessToken)->get($this->userInfoUrl);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('UserInfo request failed', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('UserInfo request exception: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Create atau Update User dari SSO data
     */
    protected function createOrUpdateUser($userInfo, $tokenResponse)
    {
        // Mapping SSO fields (sesuaikan dengan response SSO Kemenkeu)
        $ssoId = $userInfo['sub'] ?? $userInfo['id'] ?? null;
        $email = $userInfo['email'] ?? null;
        $name = $userInfo['name'] ?? $userInfo['preferred_username'] ?? 'SSO User';
        $nip = $userInfo['nip'] ?? $userInfo['employee_id'] ?? null;
        $nik = $userInfo['nik'] ?? null;
        $jabatan = $userInfo['position'] ?? $userInfo['jabatan'] ?? null;
        $unitKerja = $userInfo['unit_kerja'] ?? $userInfo['organization'] ?? null;
        $kodeSatker = $userInfo['kode_satker'] ?? null;
        $namaSatker = $userInfo['satker'] ?? null;
        $avatar = $userInfo['gravatar'] ?? null;

        if (!$ssoId) {
            throw new \Exception('SSO ID not found in user info');
        }

        // Check if this is Super Admin
        $isSuperAdmin = User::isSuperAdminCredentials($nip, $email);
        $role = $isSuperAdmin ? 'admin' : 'user';

        // Cari user berdasarkan SSO ID atau email atau NIP
        $user = User::where('sso_id', $ssoId)
            ->orWhere('email', $email)
            ->orWhere('nip', $nip)
            ->first();

        if ($user) {
            // Update existing user
            $user->update([
                'sso_id' => $ssoId,
                'name' => $name,
                'email' => $email,
                'nip' => $nip,
                'nik' => $nik,
                'jabatan' => $jabatan,
                'unit_kerja' => $unitKerja,
                'kode_satker' => $kodeSatker,
                'nama_satker' => $namaSatker,
                'avatar' => $avatar,
                'role' => $role,
                'is_super_admin' => $isSuperAdmin,
                'sso_data' => $userInfo,
                'last_sso_login' => now(),
            ]);
        } else {
            // Create new user
            $user = User::create([
                'sso_id' => $ssoId,
                'name' => $name,
                'email' => $email,
                'nip' => $nip,
                'nik' => $nik,
                'jabatan' => $jabatan,
                'unit_kerja' => $unitKerja,
                'kode_satker' => $kodeSatker,
                'nama_satker' => $namaSatker,
                'avatar' => $avatar,
                'role' => $role,
                'is_super_admin' => $isSuperAdmin,
                'sso_data' => $userInfo,
                'last_sso_login' => now(),
                'password' => null, // SSO users don't need password
            ]);
        }

        // Log Super Admin login
        if ($isSuperAdmin) {
            \Log::info('Super Admin logged in via SSO', [
                'user_id' => $user->id,
                'nip' => $nip,
                'email' => $email,
                'name' => $name
            ]);
        }

        return $user;
    }

    /**
     * Logout dari SSO
     */
    public function logout(Request $request)
    {
        $user = Auth::user();

        // Logout dari aplikasi
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Jika user login via SSO, redirect ke SSO logout
        if ($user && $user->isSSOUser()) {
            $logoutUrl = $this->logoutUrl . '?' . http_build_query([
                'post_logout_redirect_uri' => url('/'),
                'client_id' => $this->clientId,
            ]);

            return redirect($logoutUrl);
        }

        return redirect('/')->with('success', 'Berhasil logout.');
    }
}
