<x-guest-layout>

    {{-- ── Session Status ──────────────────────────────────── --}}
    <x-auth-session-status class="mb-5" :status="session('status')" />

    {{-- ── Error Alert ─────────────────────────────────────── --}}
    @if (session('error'))
        <div id="errorAlert" role="alert"
            class="mb-5 flex items-start gap-3 rounded-xl
                    bg-red-500/10 border border-red-500/20
                    px-4 py-3 animate-fade-in">
            <i class="fas fa-circle-exclamation text-red-400 mt-0.5 flex-shrink-0" aria-hidden="true"></i>
            <p class="text-sm text-red-300 leading-relaxed">{{ session('error') }}</p>
        </div>
    @endif

    {{-- ══════════════════════════════════════════════════════
         SSO BUTTON
    ══════════════════════════════════════════════════════ --}}
    <a href="{{ route('sso.login') }}"
        class="group relative w-full flex items-center justify-center gap-3
              px-5 py-3.5 rounded-xl font-semibold text-sm text-white
              bg-blue-600 hover:bg-blue-500
              transition-all duration-200 overflow-hidden mb-3
              focus:outline-none focus-visible:ring-2
              focus-visible:ring-blue-400 focus-visible:ring-offset-2
              focus-visible:ring-offset-slate-900"
        aria-label="Login dengan SSO Kemenkeu">
        <span
            class="absolute inset-0 -translate-x-full
                      bg-gradient-to-r from-transparent via-white/10 to-transparent
                      group-hover:translate-x-full transition-transform duration-700
                      pointer-events-none"
            aria-hidden="true"></span>
        <i class="fas fa-shield-halved text-base relative z-10" aria-hidden="true"></i>
        <span class="tracking-wide relative z-10">Login dengan SSO Kemenkeu</span>
    </a>

    {{-- ── Divider ──────────────────────────────────────────── --}}
    <div class="relative my-5" aria-hidden="true">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-slate-700/60"></div>
        </div>
        <div class="relative flex justify-center">
            <span class="px-3 text-xs text-slate-500 bg-slate-900 tracking-wide">
                atau login manual
            </span>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════
         TOGGLE MANUAL LOGIN
    ══════════════════════════════════════════════════════ --}}
    <button type="button" id="toggleManualLogin"
        class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl
                   bg-slate-800 border border-slate-700/80
                   text-slate-300 hover:text-white hover:border-slate-600
                   transition-all duration-200 mb-1
                   focus:outline-none focus-visible:ring-2
                   focus-visible:ring-slate-500"
        aria-expanded="false" aria-controls="manualLoginForm">
        {{-- Icon --}}
        <span
            class="w-8 h-8 rounded-lg bg-slate-700/60 flex items-center
                      justify-center flex-shrink-0">
            <i class="fas fa-key text-slate-400 text-sm" aria-hidden="true"></i>
        </span>
        <span class="text-sm font-medium">Login Manual</span>
        <i id="toggleIcon"
            class="fas fa-chevron-down text-xs text-slate-500 ml-auto
                  transition-transform duration-300"
            aria-hidden="true"></i>
    </button>

    {{-- ══════════════════════════════════════════════════════
         MANUAL LOGIN FORM
    ══════════════════════════════════════════════════════ --}}
    <div id="manualLoginForm" class="hidden opacity-0 transition-all duration-400 ease-out"
        style="max-height:0; overflow:hidden;" aria-hidden="true">

        {{-- Wrapper form dengan border atas tipis sebagai penanda --}}
        <div class="mt-4 rounded-xl border border-slate-700/60
                    bg-slate-800/40 p-5 space-y-1">

            <form method="POST" action="{{ route('login') }}" id="loginForm" novalidate>
                @csrf

                {{-- ════════════════════════════════════════
                     EMAIL
                ════════════════════════════════════════ --}}
                <div class="mb-4">
                    <label for="email"
                        class="block text-[11px] font-semibold text-slate-400
                                  uppercase tracking-widest mb-2">
                        Email
                    </label>
                    <div class="relative">
                        {{-- Icon prefix --}}
                        <div
                            class="absolute inset-y-0 left-0 flex items-center
                                    pl-3.5 pointer-events-none">
                            <i class="fas fa-envelope text-slate-500 text-xs" aria-hidden="true"></i>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autocomplete="username" placeholder="nama@kemenkeu.go.id"
                            @error('email') aria-describedby="emailErr" @enderror
                            class="w-full pl-10 pr-4 py-2.5
                                      bg-slate-800 border rounded-lg
                                      text-sm text-slate-200
                                      placeholder-slate-500
                                      transition-all duration-150 outline-none
                                      @error('email')
                                          border-red-500/50
                                          focus:border-red-500/70
                                          focus:ring-2 focus:ring-red-500/10
                                      @else
                                          border-slate-600/60
                                          focus:border-slate-500
                                          focus:ring-2 focus:ring-slate-500/10
                                      @enderror">
                    </div>
                    @error('email')
                        <p id="emailErr" role="alert"
                            class="mt-1.5 flex items-center gap-1.5
                                  text-xs text-red-400">
                            <i class="fas fa-circle-exclamation flex-shrink-0" aria-hidden="true"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- ════════════════════════════════════════
                     PASSWORD
                ════════════════════════════════════════ --}}
                <div class="mb-4">
                    <label for="password"
                        class="block text-[11px] font-semibold text-slate-400
                                  uppercase tracking-widest mb-2">
                        Password
                    </label>
                    <div class="relative">
                        {{-- Icon prefix --}}
                        <div
                            class="absolute inset-y-0 left-0 flex items-center
                                    pl-3.5 pointer-events-none">
                            <i class="fas fa-lock text-slate-500 text-xs" aria-hidden="true"></i>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            placeholder="Masukkan password" @error('password') aria-describedby="passwordErr" @enderror
                            class="w-full pl-10 pr-11 py-2.5
                                      bg-slate-800 border rounded-lg
                                      text-sm text-slate-200
                                      placeholder-slate-500
                                      transition-all duration-150 outline-none
                                      @error('password')
                                          border-red-500/50
                                          focus:border-red-500/70
                                          focus:ring-2 focus:ring-red-500/10
                                      @else
                                          border-slate-600/60
                                          focus:border-slate-500
                                          focus:ring-2 focus:ring-slate-500/10
                                      @enderror">
                        {{-- Toggle visibility --}}
                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-0 flex items-center
                                       pr-3.5 text-slate-500 hover:text-slate-300
                                       transition-colors duration-150
                                       focus:outline-none focus-visible:ring-1
                                       focus-visible:ring-slate-500 rounded-r-lg"
                            aria-label="Tampilkan password" aria-pressed="false">
                            <i id="passwordIcon" class="fas fa-eye text-xs" aria-hidden="true"></i>
                        </button>
                    </div>
                    @error('password')
                        <p id="passwordErr" role="alert"
                            class="mt-1.5 flex items-center gap-1.5
                                  text-xs text-red-400">
                            <i class="fas fa-circle-exclamation flex-shrink-0" aria-hidden="true"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- ════════════════════════════════════════
                     REMEMBER ME & FORGOT PASSWORD
                ════════════════════════════════════════ --}}
                <div class="flex items-center justify-between gap-2 mb-5">
                    <label
                        class="flex items-center gap-2 cursor-pointer
                                   group select-none">
                        <div class="relative flex items-center">
                            <input type="checkbox" name="remember" id="remember_me"
                                class="peer w-4 h-4 rounded border-slate-600
                                          bg-slate-800 text-blue-500 cursor-pointer
                                          focus:ring-1 focus:ring-blue-500/50
                                          focus:ring-offset-0 transition-colors">
                        </div>
                        <span
                            class="text-xs text-slate-400 group-hover:text-slate-300
                                      transition-colors">
                            Ingat saya
                        </span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-xs text-slate-400 hover:text-blue-400
                                  transition-colors font-medium
                                  focus:outline-none focus-visible:ring-1
                                  focus-visible:ring-blue-400 rounded px-1">
                            Lupa password?
                        </a>
                    @endif
                </div>

                {{-- ════════════════════════════════════════
                     CAPTCHA
                ════════════════════════════════════════ --}}
                <div class="mb-5">
                    {{-- Label --}}
                    <label for="captchaInput"
                        class="block text-[11px] font-semibold text-slate-400
                                  uppercase tracking-widest mb-2">
                        Verifikasi Captcha
                    </label>

                    {{-- Captcha image + refresh dalam satu baris --}}
                    <div class="flex items-stretch gap-2.5 mb-2.5">
                        {{-- Gambar captcha --}}
                        <div id="captchaImageWrapper"
                            class="flex-1 rounded-lg overflow-hidden
                                    border border-slate-600/60
                                    bg-slate-800 relative"
                            style="line-height:0; min-height:48px;" aria-live="polite" aria-label="Gambar captcha">
                            {!! captcha_img('login') !!}
                            {{-- Loading overlay --}}
                            <div id="captchaOverlay"
                                class="absolute inset-0 bg-slate-900/80
                                        flex items-center justify-center
                                        opacity-0 pointer-events-none
                                        transition-opacity duration-200">
                                <i class="fas fa-spinner fa-spin text-slate-400 text-sm" aria-hidden="true"></i>
                            </div>
                        </div>

                        {{-- Tombol refresh --}}
                        <button type="button" id="refreshCaptcha"
                            class="flex-shrink-0 w-10 rounded-lg
                                       bg-slate-800 border border-slate-600/60
                                       text-slate-400 hover:text-slate-200
                                       hover:border-slate-500
                                       active:scale-95 transition-all duration-150
                                       focus:outline-none focus-visible:ring-1
                                       focus-visible:ring-slate-500
                                       disabled:opacity-40 disabled:cursor-not-allowed
                                       flex items-center justify-center"
                            aria-label="Muat ulang captcha" title="Muat ulang captcha">
                            <i class="fas fa-rotate text-xs" id="refreshIcon" aria-hidden="true"></i>
                        </button>
                    </div>

                    {{-- Input kode captcha --}}
                    <input type="text" name="captcha" id="captchaInput" required autocomplete="off"
                        spellcheck="false" maxlength="6" inputmode="text" placeholder="Ketik kode di atas"
                        @error('captcha') aria-describedby="captchaErr" @enderror
                        class="w-full px-4 py-2.5
                                  bg-slate-800 border rounded-lg
                                  text-sm text-slate-200 text-center
                                  placeholder-slate-500
                                  tracking-[0.45em] font-mono
                                  transition-all duration-150 outline-none
                                  @error('captcha')
                                      border-red-500/50
                                      focus:border-red-500/70
                                      focus:ring-2 focus:ring-red-500/10
                                  @else
                                      border-slate-600/60
                                      focus:border-slate-500
                                      focus:ring-2 focus:ring-slate-500/10
                                  @enderror">
                    @error('captcha')
                        <p id="captchaErr" role="alert"
                            class="mt-1.5 flex items-center gap-1.5
                                  text-xs text-red-400">
                            <i class="fas fa-circle-exclamation flex-shrink-0" aria-hidden="true"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- ════════════════════════════════════════
                     SUBMIT BUTTON
                ════════════════════════════════════════ --}}
                <button type="submit" id="submitBtn"
                    class="group relative w-full flex items-center
                               justify-center gap-2.5 px-5 py-3 rounded-xl
                               bg-blue-600 hover:bg-blue-500
                               font-semibold text-sm text-white
                               shadow-lg shadow-blue-500/20
                               hover:shadow-blue-500/30
                               hover:scale-[1.01] transition-all duration-200
                               focus:outline-none focus-visible:ring-2
                               focus-visible:ring-blue-400
                               focus-visible:ring-offset-2
                               focus-visible:ring-offset-slate-900
                               disabled:opacity-50 disabled:cursor-not-allowed
                               disabled:scale-100 overflow-hidden">
                    <span
                        class="absolute inset-0 -translate-x-full
                                  bg-gradient-to-r from-transparent
                                  via-white/10 to-transparent
                                  group-hover:translate-x-full
                                  transition-transform duration-700
                                  pointer-events-none"
                        aria-hidden="true"></span>
                    <span id="btnText" class="relative z-10 tracking-wide">
                        Masuk ke Sistem
                    </span>
                    <i id="btnIcon"
                        class="fas fa-arrow-right text-xs relative z-10
                              group-hover:translate-x-0.5
                              transition-transform duration-200"
                        aria-hidden="true"></i>
                </button>

                {{-- ── Back Button ─────────────────────── --}}
                <button type="button" id="hideManualLogin"
                    class="w-full flex items-center justify-center gap-2
                               mt-3 py-2.5 rounded-lg
                               text-xs text-slate-500 hover:text-slate-300
                               hover:bg-slate-800/60
                               transition-all duration-150
                               focus:outline-none focus-visible:ring-1
                               focus-visible:ring-slate-600">
                    <i class="fas fa-arrow-left text-[10px]" aria-hidden="true"></i>
                    <span>Kembali ke pilihan login</span>
                </button>

            </form>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════
         SCRIPTS
    ══════════════════════════════════════════════════════ --}}
    <script>
        (function() {
            'use strict';

            const $ = id => document.getElementById(id);

            const toggleBtn = $('toggleManualLogin');
            const hideBtn = $('hideManualLogin');
            const manualForm = $('manualLoginForm');
            const toggleIcon = $('toggleIcon');
            const emailInput = $('email');
            const passwordInput = $('password');
            const togglePassBtn = $('togglePassword');
            const passwordIcon = $('passwordIcon');
            const loginForm = $('loginForm');
            const submitBtn = $('submitBtn');
            const btnText = $('btnText');
            const btnIcon = $('btnIcon');
            const refreshBtn = $('refreshCaptcha');
            const refreshIcon = $('refreshIcon');
            const captchaInput = $('captchaInput');
            const captchaWrapper = $('captchaImageWrapper');
            const captchaOverlay = $('captchaOverlay');
            const errorAlert = $('errorAlert');

            // ── Show / Hide Manual Form ────────────────────────────────
            function showManualForm() {
                toggleBtn.setAttribute('aria-expanded', 'true');
                manualForm.setAttribute('aria-hidden', 'false');
                toggleIcon.style.transform = 'rotate(180deg)';
                toggleBtn.classList.add('border-slate-500', 'text-white');

                manualForm.classList.remove('hidden');
                void manualForm.offsetHeight;

                requestAnimationFrame(() => {
                    manualForm.style.maxHeight = '1400px';
                    manualForm.classList.remove('opacity-0');
                    manualForm.classList.add('opacity-100');
                });

                setTimeout(() => emailInput?.focus(), 420);
            }

            function hideManualForm() {
                toggleBtn.setAttribute('aria-expanded', 'false');
                manualForm.setAttribute('aria-hidden', 'true');
                toggleIcon.style.transform = 'rotate(0deg)';
                toggleBtn.classList.remove('border-slate-500', 'text-white');

                manualForm.classList.remove('opacity-100');
                manualForm.classList.add('opacity-0');
                manualForm.style.maxHeight = '0';
                setTimeout(() => manualForm.classList.add('hidden'), 420);
                toggleBtn?.focus();
            }

            toggleBtn?.addEventListener('click', function() {
                const isOpen = toggleBtn.getAttribute('aria-expanded') === 'true';
                isOpen ? hideManualForm() : showManualForm();
            }, {
                passive: true
            });
            hideBtn?.addEventListener('click', hideManualForm, {
                passive: true
            });

            document.addEventListener('keydown', e => {
                if (e.key === 'Escape' &&
                    toggleBtn?.getAttribute('aria-expanded') === 'true') {
                    hideManualForm();
                }
            });

            // ── Toggle Password ────────────────────────────────────────
            togglePassBtn?.addEventListener('click', function() {
                const show = passwordInput.type === 'password';
                passwordInput.type = show ? 'text' : 'password';
                passwordIcon.className = show ?
                    'fas fa-eye-slash text-xs' :
                    'fas fa-eye text-xs';
                this.setAttribute('aria-label',
                    show ? 'Sembunyikan password' : 'Tampilkan password');
                this.setAttribute('aria-pressed', show ? 'true' : 'false');
            }, {
                passive: true
            });

            // ── Submit Loading State ───────────────────────────────────
            loginForm?.addEventListener('submit', function() {
                submitBtn.disabled = true;
                btnText.textContent = 'Memproses...';
                btnIcon.className = 'fas fa-spinner fa-spin text-xs relative z-10';

                setTimeout(() => {
                    if (!submitBtn.disabled) return;
                    submitBtn.disabled = false;
                    btnText.textContent = 'Masuk ke Sistem';
                    btnIcon.className =
                        'fas fa-arrow-right text-xs relative z-10 group-hover:translate-x-0.5 transition-transform duration-200';
                }, 15_000);
            });

            // ── Auto-show form jika ada error ──────────────────────────
            @if ($errors->any())
                showManualForm();
            @endif

            // ── Auto-dismiss error alert ───────────────────────────────
            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                    errorAlert.style.opacity = '0';
                    errorAlert.style.transform = 'translateY(-6px)';
                    setTimeout(() => errorAlert.remove(), 420);
                }, 5000);
            }

            // ── Refresh Captcha ────────────────────────────────────────
            let captchaDebounce = null;

            refreshBtn?.addEventListener('click', () => {
                clearTimeout(captchaDebounce);
                captchaDebounce = setTimeout(doRefreshCaptcha, 60);
            }, {
                passive: true
            });

            function doRefreshCaptcha() {
                if (refreshBtn.disabled) return;

                refreshBtn.disabled = true;
                captchaOverlay.style.opacity = '1';
                captchaOverlay.style.pointerEvents = 'auto';
                refreshIcon.classList.add('fa-spin');

                const csrf = document.querySelector('meta[name="csrf-token"]')
                    ?.content ?? '';

                fetch('{{ route('captcha.refresh') }}', {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrf,
                            'Accept': 'application/json',
                        },
                        signal: AbortSignal.timeout(8000),
                    })
                    .then(r => {
                        if (!r.ok) throw new Error('HTTP ' + r.status);
                        return r.json();
                    })
                    .then(data => {
                        if (!data.success || !data.img) throw new Error('Invalid response');

                        const imgVal = data.img;
                        const existImg = captchaWrapper.querySelector('img');

                        const setSrc = src => {
                            if (existImg) {
                                existImg.src = src;
                            } else {
                                const img = Object.assign(
                                    document.createElement('img'), {
                                        src,
                                        alt: 'captcha'
                                    });
                                captchaWrapper.appendChild(img);
                            }
                        };

                        if (imgVal.startsWith('<img')) {
                            const doc = new DOMParser().parseFromString(imgVal, 'text/html');
                            const src = doc.querySelector('img')?.src;
                            src ? setSrc(src) : (captchaWrapper.innerHTML = imgVal);
                        } else if (imgVal.startsWith('data:image')) {
                            setSrc(imgVal);
                        } else {
                            setSrc(imgVal + '?t=' + Date.now());
                        }
                    })
                    .catch(() => showToast('Gagal memuat captcha, silakan coba lagi.', 'error'))
                    .finally(() => {
                        captchaOverlay.style.opacity = '0';
                        captchaOverlay.style.pointerEvents = 'none';
                        refreshIcon.classList.remove('fa-spin');
                        refreshBtn.disabled = false;
                        if (captchaInput) {
                            captchaInput.value = '';
                            captchaInput.focus();
                        }
                    });
            }

            // ── Toast ──────────────────────────────────────────────────
            function showToast(message, type = 'info') {
                const cfg = {
                    error: 'bg-slate-900 border-red-800/50 text-red-300',
                    success: 'bg-slate-900 border-green-800/50 text-green-300',
                    info: 'bg-slate-900 border-slate-700 text-slate-300',
                };
                const icons = {
                    error: 'fa-circle-exclamation text-red-400',
                    success: 'fa-circle-check text-green-400',
                    info: 'fa-circle-info text-blue-400',
                };

                const toast = document.createElement('div');
                toast.setAttribute('role', 'alert');
                toast.className = `fixed bottom-6 right-6 z-[9999] flex items-center gap-3
                               px-4 py-3 rounded-xl border shadow-2xl text-sm
                               translate-y-3 opacity-0 transition-all duration-300
                               ${cfg[type] ?? cfg.info}`;
                toast.innerHTML = `<i class="fas ${icons[type] ?? icons.info} flex-shrink-0"></i>
                                <span>${message}</span>`;
                document.body.appendChild(toast);

                requestAnimationFrame(() => {
                    toast.classList.replace('translate-y-3', 'translate-y-0');
                    toast.classList.replace('opacity-0', 'opacity-100');
                });
                setTimeout(() => {
                    toast.classList.replace('translate-y-0', 'translate-y-3');
                    toast.classList.replace('opacity-100', 'opacity-0');
                    setTimeout(() => toast.remove(), 320);
                }, 3500);
            }

        })();
    </script>

</x-guest-layout>
