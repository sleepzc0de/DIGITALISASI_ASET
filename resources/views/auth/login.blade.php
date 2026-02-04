<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6 p-4 rounded-xl bg-gradient-to-r from-green-500/20 to-emerald-500/20 border border-green-400/30 text-green-100" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" id="loginForm" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div data-aos="fade-up" data-aos-delay="100">
            <label for="email" class="block text-sm font-semibold text-white mb-2">
                <i class="fas fa-envelope mr-2 text-blue-300"></i>Alamat Email
            </label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-user text-blue-400/70 group-hover:text-blue-300 transition-colors"></i>
                </div>
                <input id="email"
                       name="email"
                       type="email"
                       required
                       autofocus
                       autocomplete="email"
                       value="{{ old('email') }}"
                       class="pl-10 w-full px-4 py-3.5 bg-white/5 border border-white/10 rounded-xl text-white placeholder-blue-200/50 focus:outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-500/30 focus:bg-white/10 transition-all duration-300 group-hover:border-blue-300/50"
                       placeholder="nama@example.com"
                       onfocus="this.parentElement.classList.add('input-focused')"
                       onblur="this.parentElement.classList.remove('input-focused')">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <span id="emailStatus" class="hidden">
                        <i class="fas fa-check-circle text-green-400"></i>
                    </span>
                </div>
            </div>
            @error('email')
                <div class="mt-2 flex items-center text-red-300 text-sm animate-fade-in">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Password -->
        <div data-aos="fade-up" data-aos-delay="200">
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-sm font-semibold text-white">
                    <i class="fas fa-lock mr-2 text-blue-300"></i>Kata Sandi
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-sm text-blue-300 hover:text-white transition-colors duration-300 flex items-center">
                        <i class="fas fa-key mr-1"></i> Lupa sandi?
                    </a>
                @endif
            </div>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-blue-400/70 group-hover:text-blue-300 transition-colors"></i>
                </div>
                <input id="password"
                       name="password"
                       type="password"
                       required
                       autocomplete="current-password"
                       class="pl-10 w-full px-4 py-3.5 bg-white/5 border border-white/10 rounded-xl text-white placeholder-blue-200/50 focus:outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-500/30 focus:bg-white/10 transition-all duration-300 group-hover:border-blue-300/50"
                       placeholder="Masukkan kata sandi"
                       onfocus="this.parentElement.classList.add('input-focused')"
                       onblur="this.parentElement.classList.remove('input-focused')">
                <button type="button"
                        id="togglePassword"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-blue-300 hover:text-white transition-colors">
                    <i class="fas fa-eye" id="eyeIcon"></i>
                </button>
            </div>
            @error('password')
                <div class="mt-2 flex items-center text-red-300 text-sm animate-fade-in">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ $message }}
                </div>
            @enderror

            <!-- Password Strength Indicator -->
            <div id="passwordStrength" class="mt-2 hidden">
                <div class="flex items-center space-x-2 mb-1">
                    <div class="h-1 flex-1 bg-gray-600 rounded-full overflow-hidden">
                        <div id="strengthBar" class="h-full bg-red-500 w-0 transition-all duration-300"></div>
                    </div>
                    <span id="strengthText" class="text-xs font-medium text-gray-300"></span>
                </div>
            </div>
        </div>

        <!-- Remember Me -->
        <div class="flex items-center" data-aos="fade-up" data-aos-delay="300">
            <div class="relative">
                <input id="remember_me"
                       name="remember"
                       type="checkbox"
                       class="sr-only peer"
                       {{ old('remember') ? 'checked' : '' }}>
                <div class="w-5 h-5 bg-white/10 border border-white/20 rounded-md flex items-center justify-center peer-checked:bg-blue-500 peer-checked:border-blue-500 transition-all duration-200">
                    <i class="fas fa-check text-white text-xs opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                </div>
            </div>
            <label for="remember_me" class="ml-3 text-sm text-blue-100/80 cursor-pointer hover:text-white transition-colors">
                Ingat saya di perangkat ini
            </label>
        </div>

        <!-- Submit Button -->
        <div data-aos="fade-up" data-aos-delay="400">
            <button type="submit"
                    id="submitBtn"
                    class="w-full py-3.5 px-4 bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:ring-offset-2 focus:ring-offset-gray-900 group relative overflow-hidden animate-pulse-glow">
                <div class="relative z-10 flex items-center justify-center space-x-2">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Masuk ke Sistem</span>
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="absolute top-0 -inset-full h-full w-1/2 z-5 block transform -skew-x-12 bg-gradient-to-r from-transparent via-white to-transparent opacity-40 group-hover:animate-shine" style="animation-duration: 1.5s;"></div>
            </button>
        </div>

        <!-- Loading Spinner for Button -->
        <div id="loadingSpinner" class="hidden">
            <div class="flex items-center justify-center space-x-2 text-blue-300">
                <div class="w-5 h-5 border-2 border-blue-300 border-t-transparent rounded-full animate-spin"></div>
                <span>Memproses...</span>
            </div>
        </div>
    </form>

    <style>
        @keyframes shine {
            0% { left: -100%; }
            100% { left: 200%; }
        }
        .animate-shine {
            animation: shine 1.5s ease-in-out infinite;
        }
        .input-focused {
            transform: translateY(-2px);
        }
    </style>

    <script>
        // Toggle Password Visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
        });

        // Email Validation
        const emailInput = document.getElementById('email');
        const emailStatus = document.getElementById('emailStatus');

        emailInput.addEventListener('input', function() {
            const email = this.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (emailRegex.test(email)) {
                emailStatus.classList.remove('hidden');
                emailStatus.innerHTML = '<i class="fas fa-check-circle text-green-400"></i>';
            } else if (email.length > 0) {
                emailStatus.classList.remove('hidden');
                emailStatus.innerHTML = '<i class="fas fa-exclamation-circle text-red-400"></i>';
            } else {
                emailStatus.classList.add('hidden');
            }
        });

        // Password Strength Indicator
        const passwordInputField = document.getElementById('password');
        const passwordStrength = document.getElementById('passwordStrength');
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('strengthText');

        passwordInputField.addEventListener('input', function() {
            const password = this.value;

            if (password.length === 0) {
                passwordStrength.classList.add('hidden');
                return;
            }

            passwordStrength.classList.remove('hidden');

            let strength = 0;
            let text = 'Sangat Lemah';
            let color = 'bg-red-500';

            // Length check
            if (password.length >= 8) strength += 25;
            if (password.length >= 12) strength += 25;

            // Complexity checks
            if (/[A-Z]/.test(password)) strength += 25;
            if (/[0-9]/.test(password)) strength += 15;
            if (/[^A-Za-z0-9]/.test(password)) strength += 10;

            // Set strength level
            if (strength >= 75) {
                text = 'Sangat Kuat';
                color = 'bg-green-500';
            } else if (strength >= 50) {
                text = 'Kuat';
                color = 'bg-green-400';
            } else if (strength >= 25) {
                text = 'Cukup';
                color = 'bg-yellow-500';
            } else {
                text = 'Lemah';
                color = 'bg-red-500';
            }

            strengthBar.style.width = `${Math.min(strength, 100)}%`;
            strengthBar.className = `h-full ${color} w-0 transition-all duration-300`;
            strengthText.textContent = text;
        });

        // Form Submission with Animation
        const loginForm = document.getElementById('loginForm');
        const submitBtn = document.getElementById('submitBtn');
        const loadingSpinner = document.getElementById('loadingSpinner');

        loginForm.addEventListener('submit', function(e) {
            // Show loading animation
            submitBtn.classList.add('hidden');
            loadingSpinner.classList.remove('hidden');
            loadingSpinner.classList.add('flex');

            // Optional: Add slight delay for better UX
            setTimeout(() => {
                // The form will submit normally
            }, 500);
        });

        // Add floating label effect
        const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-blue-500/30');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-blue-500/30');
            });
        });

        // Auto focus on email field
        document.addEventListener('DOMContentLoaded', function() {
            if (emailInput.value === '') {
                emailInput.focus();
            }
        });

        // Demo credentials fill
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'd') {
                e.preventDefault();
                emailInput.value = 'admin@example.com';
                passwordInput.value = 'password';

                // Trigger input events
                emailInput.dispatchEvent(new Event('input'));
                passwordInput.dispatchEvent(new Event('input'));

                // Show notification
                const notification = document.createElement('div');
                notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50 animate-fade-in-down';
                notification.innerHTML = '<i class="fas fa-info-circle mr-2"></i>Demo credentials filled!';
                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.remove();
                }, 3000);
            }
        });
    </script>
</x-guest-layout>
