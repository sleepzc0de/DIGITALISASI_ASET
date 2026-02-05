<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Error Messages -->
    @if (session('error'))
        <div class="mb-6 bg-red-500/20 backdrop-blur-sm border border-red-500/30 rounded-xl p-4" role="alert" id="errorAlert">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-400 text-xl" aria-hidden="true"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-100">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- SSO Login Button -->
    <div class="mb-6">
        <a href="{{ route('sso.login') }}"
           class="group relative w-full flex items-center justify-center gap-3 px-6 py-4 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 rounded-xl font-semibold text-white shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 transition-all duration-300 transform hover:scale-[1.02] overflow-hidden"
           aria-label="Login dengan SSO Kemenkeu">
            <!-- Shine Effect -->
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000" aria-hidden="true"></div>
            <i class="fas fa-shield-alt text-xl relative z-10" aria-hidden="true"></i>
            <span class="text-sm uppercase tracking-wider relative z-10">Login dengan SSO Kemenkeu</span>
        </a>
    </div>

    <!-- Manual Login Toggle Button -->
    <div class="mb-6">
        <button type="button"
                id="toggleManualLogin"
                class="group relative w-full flex items-center justify-center gap-3 px-6 py-4 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 rounded-xl font-semibold text-white shadow-lg shadow-purple-500/30 hover:shadow-xl hover:shadow-purple-500/40 transition-all duration-300 transform hover:scale-[1.02] overflow-hidden"
                aria-expanded="false"
                aria-controls="manualLoginForm">
            <!-- Shine Effect -->
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000" aria-hidden="true"></div>
            <i class="fas fa-key text-xl relative z-10" aria-hidden="true"></i>
            <span class="text-sm uppercase tracking-wider relative z-10">Login Manual</span>
            <i id="toggleIcon" class="fas fa-chevron-down relative z-10 transition-transform duration-300" aria-hidden="true"></i>
        </button>
    </div>

    <!-- Manual Login Form (Hidden by default) -->
    <div id="manualLoginForm"
         class="hidden opacity-0 transform transition-all duration-500 ease-out"
         style="max-height: 0; overflow: hidden;"
         aria-hidden="true">

        <!-- Divider -->
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

        <!-- Regular Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5" id="loginForm">
            @csrf

            <!-- Email Address -->
            <div class="transform transition-all duration-300 translate-y-0">
                <label for="email" class="block text-sm font-medium text-blue-100/90 mb-2">
                    <i class="fas fa-envelope mr-2 text-blue-300" aria-hidden="true"></i>Email
                </label>
                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autocomplete="username"
                       class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-blue-200/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 backdrop-blur-sm"
                       placeholder="nama@kemenkeu.go.id"
                       aria-describedby="{{ $errors->has('email') ? 'email-error' : '' }}">
                @error('email')
                    <p id="email-error" class="mt-2 text-sm text-red-300 flex items-center" role="alert">
                        <i class="fas fa-exclamation-circle mr-1" aria-hidden="true"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password -->
            <div class="transform transition-all duration-300 translate-y-0">
                <label for="password" class="block text-sm font-medium text-blue-100/90 mb-2">
                    <i class="fas fa-lock mr-2 text-blue-300" aria-hidden="true"></i>Password
                </label>
                <div class="relative">
                    <input id="password"
                           type="password"
                           name="password"
                           required
                           autocomplete="current-password"
                           class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-blue-200/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 backdrop-blur-sm pr-12"
                           placeholder="••••••••"
                           aria-describedby="{{ $errors->has('password') ? 'password-error' : '' }}">
                    <button type="button"
                            id="togglePassword"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-blue-300 hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 rounded p-1"
                            aria-label="Toggle password visibility">
                        <i id="passwordIcon" class="fas fa-eye" aria-hidden="true"></i>
                    </button>
                </div>
                @error('password')
                    <p id="password-error" class="mt-2 text-sm text-red-300 flex items-center" role="alert">
                        <i class="fas fa-exclamation-circle mr-1" aria-hidden="true"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between transform transition-all duration-300 translate-y-0">
                <label class="flex items-center cursor-pointer group">
                    <input type="checkbox"
                           name="remember"
                           id="remember_me"
                           class="w-4 h-4 rounded border-white/30 bg-white/10 text-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-offset-0 transition-colors cursor-pointer">
                    <span class="ml-2 text-sm text-blue-100/80 group-hover:text-white transition-colors">
                        Ingat saya
                    </span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-sm text-blue-300 hover:text-white transition-colors font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 rounded px-2 py-1">
                        Lupa password?
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit"
                    id="submitBtn"
                    class="group relative w-full flex items-center justify-center gap-3 px-6 py-4 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 rounded-xl font-semibold text-white shadow-lg shadow-green-500/30 hover:shadow-xl hover:shadow-green-500/40 transition-all duration-300 transform hover:scale-[1.02] overflow-hidden disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                <!-- Shine Effect -->
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000" aria-hidden="true"></div>
                <span id="btnText" class="text-sm uppercase tracking-wider relative z-10">Masuk</span>
                <i id="btnIcon" class="fas fa-arrow-right relative z-10 group-hover:translate-x-1 transition-transform" aria-hidden="true"></i>
            </button>

            <!-- Back Button -->
            <button type="button"
                    id="hideManualLogin"
                    class="w-full flex items-center justify-center gap-2 px-4 py-3 text-blue-100/80 hover:text-white transition-colors rounded-xl hover:bg-white/5">
                <i class="fas fa-arrow-left" aria-hidden="true"></i>
                <span class="text-sm">Kembali ke pilihan login</span>
            </button>
        </form>
    </div>

    <!-- Optimized JavaScript -->
    <script>
        (function() {
            'use strict';

            const toggleBtn = document.getElementById('toggleManualLogin');
            const hideBtn = document.getElementById('hideManualLogin');
            const manualForm = document.getElementById('manualLoginForm');
            const toggleIcon = document.getElementById('toggleIcon');
            const emailInput = document.getElementById('email');

            // Show Manual Login Form
            function showManualForm() {
                if (!manualForm) return;

                // Update button state
                toggleBtn.setAttribute('aria-expanded', 'true');
                manualForm.setAttribute('aria-hidden', 'false');

                // Animate icon
                toggleIcon.style.transform = 'rotate(180deg)';

                // Show form with animation
                manualForm.classList.remove('hidden');
                manualForm.style.maxHeight = '0';

                // Force reflow
                manualForm.offsetHeight;

                // Animate
                requestAnimationFrame(() => {
                    manualForm.style.maxHeight = '1000px';
                    manualForm.classList.remove('opacity-0');
                    manualForm.classList.add('opacity-100');
                });

                // Focus on email input after animation
                setTimeout(() => {
                    emailInput?.focus();
                }, 500);
            }

            // Hide Manual Login Form
            function hideManualForm() {
                if (!manualForm) return;

                // Update button state
                toggleBtn.setAttribute('aria-expanded', 'false');
                manualForm.setAttribute('aria-hidden', 'true');

                // Animate icon
                toggleIcon.style.transform = 'rotate(0deg)';

                // Hide form with animation
                manualForm.classList.remove('opacity-100');
                manualForm.classList.add('opacity-0');
                manualForm.style.maxHeight = '0';

                setTimeout(() => {
                    manualForm.classList.add('hidden');
                }, 500);
            }

            // Event Listeners
            if (toggleBtn) {
                toggleBtn.addEventListener('click', showManualForm, { passive: true });
            }

            if (hideBtn) {
                hideBtn.addEventListener('click', hideManualForm, { passive: true });
            }

            // Toggle Password Visibility
            const passwordInput = document.getElementById('password');
            const togglePasswordBtn = document.getElementById('togglePassword');
            const passwordIcon = document.getElementById('passwordIcon');

            if (togglePasswordBtn && passwordInput && passwordIcon) {
                togglePasswordBtn.addEventListener('click', function() {
                    const isPassword = passwordInput.type === 'password';
                    passwordInput.type = isPassword ? 'text' : 'password';
                    passwordIcon.className = isPassword ? 'fas fa-eye-slash' : 'fas fa-eye';
                    togglePasswordBtn.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
                }, { passive: true });
            }

            // Form Submit Loading State
            const loginForm = document.getElementById('loginForm');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnIcon = document.getElementById('btnIcon');

            if (loginForm && submitBtn) {
                loginForm.addEventListener('submit', function() {
                    submitBtn.disabled = true;
                    btnText.textContent = 'Memproses...';
                    btnIcon.className = 'fas fa-spinner fa-spin relative z-10';
                }, { once: true });
            }

            // Auto-show form if there are validation errors
            @if ($errors->any())
                showManualForm();
            @endif

            // Auto-hide error messages after 5 seconds
            const errorAlert = document.getElementById('errorAlert');
            if (errorAlert) {
                setTimeout(function() {
                    errorAlert.style.transition = 'opacity 0.5s ease-out';
                    errorAlert.style.opacity = '0';
                    setTimeout(() => errorAlert.remove(), 500);
                }, 5000);
            }
        })();
    </script>
</x-guest-layout>
