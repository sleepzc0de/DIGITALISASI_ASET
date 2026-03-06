<x-guest-layout>
    {{-- Session Status --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- Error Messages --}}
    @if (session('error'))
        <div class="mb-6 bg-red-500/20 backdrop-blur-sm border border-red-500/30 rounded-xl p-4" role="alert"
            id="errorAlert">
            <div class="flex items-start">
                <i class="fas fa-exclamation-circle text-red-400 text-xl flex-shrink-0" aria-hidden="true"></i>
                <p class="ml-3 text-sm text-red-100">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    {{-- SSO Login Button --}}
    <div class="mb-6">
        <a href="{{ route('sso.login') }}"
            class="group relative w-full flex items-center justify-center gap-3 px-6 py-4 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 rounded-xl font-semibold text-white shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 transition-all duration-300 transform hover:scale-[1.02] overflow-hidden"
            aria-label="Login dengan SSO Kemenkeu">
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"
                aria-hidden="true"></div>
            <i class="fas fa-shield-alt text-xl relative z-10" aria-hidden="true"></i>
            <span class="text-sm uppercase tracking-wider relative z-10">Login dengan SSO Kemenkeu</span>
        </a>
    </div>

    {{-- Toggle Manual Login Button --}}
    <div class="mb-6">
        <button type="button" id="toggleManualLogin"
            class="group relative w-full flex items-center justify-center gap-3 px-6 py-4 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 rounded-xl font-semibold text-white shadow-lg shadow-purple-500/30 hover:shadow-xl hover:shadow-purple-500/40 transition-all duration-300 transform hover:scale-[1.02] overflow-hidden"
            aria-expanded="false" aria-controls="manualLoginForm">
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"
                aria-hidden="true"></div>
            <i class="fas fa-key text-xl relative z-10" aria-hidden="true"></i>
            <span class="text-sm uppercase tracking-wider relative z-10">Login Manual</span>
            <i id="toggleIcon" class="fas fa-chevron-down relative z-10 transition-transform duration-300"
                aria-hidden="true"></i>
        </button>
    </div>

    {{-- Manual Login Form (Hidden by default) --}}
    <div id="manualLoginForm" class="hidden opacity-0 transform transition-all duration-500 ease-out"
        style="max-height: 0; overflow: hidden;" aria-hidden="true">

        {{-- Divider --}}
        <div class="relative mb-6" role="separator">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-white/20"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-4 bg-white/5 text-blue-100/70 backdrop-blur-sm rounded-full">
                    Masukkan kredensial Anda
                </span>
            </div>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5" id="loginForm">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-blue-100/90 mb-2">
                    <i class="fas fa-envelope mr-2 text-blue-300" aria-hidden="true"></i>Email
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    autocomplete="username"
                    class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-blue-200/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 backdrop-blur-sm"
                    placeholder="nama@kemenkeu.go.id">
                @error('email')
                    <p class="mt-2 text-sm text-red-300 flex items-center" role="alert">
                        <i class="fas fa-exclamation-circle mr-1" aria-hidden="true"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-blue-100/90 mb-2">
                    <i class="fas fa-lock mr-2 text-blue-300" aria-hidden="true"></i>Password
                </label>
                <div class="relative">
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-blue-200/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 backdrop-blur-sm pr-12"
                        placeholder="••••••••">
                    <button type="button" id="togglePassword"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-blue-300 hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 rounded p-1"
                        aria-label="Toggle password visibility">
                        <i id="passwordIcon" class="fas fa-eye" aria-hidden="true"></i>
                    </button>
                </div>
                @error('password')
                    <p class="mt-2 text-sm text-red-300 flex items-center" role="alert">
                        <i class="fas fa-exclamation-circle mr-1" aria-hidden="true"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Remember Me & Forgot Password --}}
            <div class="flex items-center justify-between">
                <label class="flex items-center cursor-pointer group">
                    <input type="checkbox" name="remember" id="remember_me"
                        class="w-4 h-4 rounded border-white/30 bg-white/10 text-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-offset-0 transition-colors cursor-pointer">
                    <span class="ml-2 text-sm text-blue-100/80 group-hover:text-white transition-colors">Ingat
                        saya</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-blue-300 hover:text-white transition-colors font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 rounded px-2 py-1">
                        Lupa password?
                    </a>
                @endif
            </div>

            {{-- ══ CAPTCHA ══════════════════════════════════════════════ --}}
            <div>
                <label class="block text-sm font-medium text-blue-100/90 mb-2">
                    <i class="fas fa-robot mr-2 text-blue-300" aria-hidden="true"></i>Verifikasi Captcha
                </label>

                {{-- Wrapper gambar + tombol refresh --}}
                <div class="flex items-center gap-3 mb-3">
                    {{-- Gambar captcha dibungkus div dengan id untuk target refresh --}}
                    <div id="captchaImageWrapper"
                        class="rounded-xl overflow-hidden border border-white/20 flex-shrink-0" style="line-height:0;">
                        {!! captcha_img('login') !!}
                    </div>

                    {{-- Tombol refresh --}}
                    <button type="button" id="refreshCaptcha"
                        class="flex-shrink-0 flex items-center justify-center w-11 h-11 rounded-xl bg-white/10 border border-white/20 text-blue-300 hover:text-white hover:bg-white/20 active:scale-95 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        aria-label="Refresh captcha" title="Muat ulang captcha">
                        <i class="fas fa-sync-alt text-base" id="refreshIcon" aria-hidden="true"></i>
                    </button>
                </div>

                {{-- Input kode captcha --}}
                <input type="text" name="captcha" id="captchaInput" required autocomplete="off"
                    spellcheck="false" maxlength="6"
                    class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-blue-200/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 backdrop-blur-sm tracking-[0.4em] text-center text-lg font-mono"
                    placeholder="_ _ _ _ _">

                @error('captcha')
                    <p class="mt-2 text-sm text-red-300 flex items-center" role="alert" id="captchaError">
                        <i class="fas fa-exclamation-circle mr-1" aria-hidden="true"></i>{{ $message }}
                    </p>
                @enderror
            </div>
            {{-- ══════════════════════════════════════════════════════════ --}}

            {{-- Submit Button --}}
            <button type="submit" id="submitBtn"
                class="group relative w-full flex items-center justify-center gap-3 px-6 py-4 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 rounded-xl font-semibold text-white shadow-lg shadow-green-500/30 hover:shadow-xl hover:shadow-green-500/40 transition-all duration-300 transform hover:scale-[1.02] overflow-hidden disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"
                    aria-hidden="true"></div>
                <span id="btnText" class="text-sm uppercase tracking-wider relative z-10">Masuk</span>
                <i id="btnIcon"
                    class="fas fa-arrow-right relative z-10 group-hover:translate-x-1 transition-transform"
                    aria-hidden="true"></i>
            </button>

            {{-- Back Button --}}
            <button type="button" id="hideManualLogin"
                class="w-full flex items-center justify-center gap-2 px-4 py-3 text-blue-100/80 hover:text-white transition-colors rounded-xl hover:bg-white/5">
                <i class="fas fa-arrow-left" aria-hidden="true"></i>
                <span class="text-sm">Kembali ke pilihan login</span>
            </button>
        </form>
    </div>

    <script>
        (function() {
            'use strict';

            // ── Element references ────────────────────────────────────────
            const toggleBtn = document.getElementById('toggleManualLogin');
            const hideBtn = document.getElementById('hideManualLogin');
            const manualForm = document.getElementById('manualLoginForm');
            const toggleIcon = document.getElementById('toggleIcon');
            const emailInput = document.getElementById('email');

            // ── Show / Hide form ──────────────────────────────────────────
            function showManualForm() {
                toggleBtn.setAttribute('aria-expanded', 'true');
                manualForm.setAttribute('aria-hidden', 'false');
                toggleIcon.style.transform = 'rotate(180deg)';

                manualForm.classList.remove('hidden');
                manualForm.style.maxHeight = '0';
                manualForm.offsetHeight; // force reflow

                requestAnimationFrame(() => {
                    manualForm.style.maxHeight = '1200px';
                    manualForm.classList.remove('opacity-0');
                    manualForm.classList.add('opacity-100');
                });

                setTimeout(() => emailInput?.focus(), 500);
            }

            function hideManualForm() {
                toggleBtn.setAttribute('aria-expanded', 'false');
                manualForm.setAttribute('aria-hidden', 'true');
                toggleIcon.style.transform = 'rotate(0deg)';

                manualForm.classList.remove('opacity-100');
                manualForm.classList.add('opacity-0');
                manualForm.style.maxHeight = '0';

                setTimeout(() => manualForm.classList.add('hidden'), 500);
            }

            toggleBtn?.addEventListener('click', showManualForm, {
                passive: true
            });
            hideBtn?.addEventListener('click', hideManualForm, {
                passive: true
            });

            // ── Toggle Password Visibility ────────────────────────────────
            const passwordInput = document.getElementById('password');
            const togglePassBtn = document.getElementById('togglePassword');
            const passwordIcon = document.getElementById('passwordIcon');

            togglePassBtn?.addEventListener('click', function() {
                const show = passwordInput.type === 'password';
                passwordInput.type = show ? 'text' : 'password';
                passwordIcon.className = show ? 'fas fa-eye-slash' : 'fas fa-eye';
                this.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
            }, {
                passive: true
            });


            // ── Form Submit Loading State ─────────────────────────────────
            const loginForm = document.getElementById('loginForm');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnIcon = document.getElementById('btnIcon');

            loginForm?.addEventListener('submit', function() {
                submitBtn.disabled = true;
                btnText.textContent = 'Memproses...';
                btnIcon.className = 'fas fa-spinner fa-spin relative z-10';
            }, {
                once: true
            });

            // ── Auto-show form jika ada validation error ──────────────────
            @if ($errors->any())
                showManualForm();
            @endif

            // ── Auto-hide error alert setelah 5 detik ────────────────────
            const errorAlert = document.getElementById('errorAlert');
            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.style.transition = 'opacity 0.5s ease-out';
                    errorAlert.style.opacity = '0';
                    setTimeout(() => errorAlert.remove(), 500);
                }, 5000);
            }
        })();
        // ── Refresh Captcha via AJAX ──────────────────────────────────
        const refreshBtn = document.getElementById('refreshCaptcha');
        const refreshIcon = document.getElementById('refreshIcon');
        const captchaInput = document.getElementById('captchaInput');
        const captchaWrapper = document.getElementById('captchaImageWrapper');
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

        function rotateSyncIcon(active) {
            if (active) {
                refreshIcon.style.transition = 'transform 0.6s linear';
                refreshIcon.style.transform = 'rotate(360deg)';
            } else {
                refreshIcon.style.transition = 'none';
                refreshIcon.style.transform = 'rotate(0deg)';
            }
        }

        refreshBtn?.addEventListener('click', function() {
            if (refreshBtn.disabled) return;
            refreshBtn.disabled = true;
            rotateSyncIcon(true);

            fetch('{{ route('captcha.refresh') }}', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                })
                .then(res => {
                    if (!res.ok) throw new Error('HTTP ' + res.status);
                    return res.json();
                })
                .then(data => {
                    console.log('Captcha response:', data); // debug — hapus setelah fix

                    if (!data.success || !data.img) {
                        throw new Error('Invalid response');
                    }

                    const imgValue = data.img;
                    const existingImg = captchaWrapper.querySelector('img');

                    // Cek apakah img adalah base64 atau URL
                    // mews/captcha kadang return <img ...> HTML tag, kadang base64, kadang URL
                    if (imgValue.startsWith('<img')) {
                        // Case 1: mews/captcha return HTML tag langsung
                        // Parse src dari HTML string
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(imgValue, 'text/html');
                        const newSrc = doc.querySelector('img')?.src;
                        if (newSrc && existingImg) {
                            existingImg.src = newSrc;
                        } else {
                            captchaWrapper.innerHTML = imgValue;
                        }

                    } else if (imgValue.startsWith('data:image')) {
                        // Case 2: return base64 string
                        if (existingImg) {
                            existingImg.src = imgValue;
                        } else {
                            const img = document.createElement('img');
                            img.src = imgValue;
                            img.alt = 'captcha';
                            captchaWrapper.innerHTML = '';
                            captchaWrapper.appendChild(img);
                        }

                    } else {
                        // Case 3: return URL biasa
                        if (existingImg) {
                            existingImg.src = imgValue + '?t=' + Date.now();
                        } else {
                            const img = document.createElement('img');
                            img.src = imgValue + '?t=' + Date.now();
                            img.alt = 'captcha';
                            captchaWrapper.innerHTML = '';
                            captchaWrapper.appendChild(img);
                        }
                    }
                })
                .catch(err => {
                    console.error('Captcha refresh error:', err);
                    window.location.reload();
                })
                .finally(() => {
                    setTimeout(() => rotateSyncIcon(false), 650);
                    refreshBtn.disabled = false;
                    if (captchaInput) {
                        captchaInput.value = '';
                        captchaInput.focus();
                    }
                });
        }, {
            passive: true
        });
    </script>
</x-guest-layout>
