{{-- <x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-6 bg-green-500/20 backdrop-blur-sm border border-green-500/30 rounded-xl p-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-400 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-100">{{ session('status') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="mb-6 bg-red-500/20 backdrop-blur-sm border border-red-500/30 rounded-xl p-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-400 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-semibold text-red-100 mb-2">Terdapat beberapa kesalahan:</p>
                    <ul class="list-disc list-inside text-sm text-red-200 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Registration Form -->
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-blue-100/90 mb-2">
                <i class="fas fa-user mr-2 text-blue-300"></i>Nama Lengkap
            </label>
            <input id="name"
                   type="text"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   autofocus
                   autocomplete="name"
                   class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-blue-200/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 backdrop-blur-sm"
                   placeholder="Masukkan nama lengkap">
            @error('name')
                <p class="mt-2 text-sm text-red-300 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-blue-100/90 mb-2">
                <i class="fas fa-envelope mr-2 text-blue-300"></i>Email
            </label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autocomplete="username"
                   class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-blue-200/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 backdrop-blur-sm"
                   placeholder="nama@example.com">
            @error('email')
                <p class="mt-2 text-sm text-red-300 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-blue-100/90 mb-2">
                <i class="fas fa-lock mr-2 text-blue-300"></i>Password
            </label>
            <div class="relative">
                <input id="password"
                       type="password"
                       name="password"
                       required
                       autocomplete="new-password"
                       class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-blue-200/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 backdrop-blur-sm pr-12"
                       placeholder="Minimal 8 karakter">
                <button type="button"
                        onclick="togglePassword('password')"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-blue-300 hover:text-white transition-colors">
                    <i id="passwordIcon" class="fas fa-eye"></i>
                </button>
            </div>
            @error('password')
                <p class="mt-2 text-sm text-red-300 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
            <!-- Password Strength Indicator -->
            <div class="mt-2">
                <div class="flex gap-1">
                    <div id="strength-bar-1" class="h-1 flex-1 bg-white/10 rounded transition-all duration-300"></div>
                    <div id="strength-bar-2" class="h-1 flex-1 bg-white/10 rounded transition-all duration-300"></div>
                    <div id="strength-bar-3" class="h-1 flex-1 bg-white/10 rounded transition-all duration-300"></div>
                    <div id="strength-bar-4" class="h-1 flex-1 bg-white/10 rounded transition-all duration-300"></div>
                </div>
                <p id="strength-text" class="text-xs text-blue-200/60 mt-1">Password minimal 8 karakter</p>
            </div>
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-blue-100/90 mb-2">
                <i class="fas fa-lock mr-2 text-blue-300"></i>Konfirmasi Password
            </label>
            <div class="relative">
                <input id="password_confirmation"
                       type="password"
                       name="password_confirmation"
                       required
                       autocomplete="new-password"
                       class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-blue-200/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 backdrop-blur-sm pr-12"
                       placeholder="Ulangi password">
                <button type="button"
                        onclick="togglePassword('password_confirmation')"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-blue-300 hover:text-white transition-colors">
                    <i id="passwordConfirmationIcon" class="fas fa-eye"></i>
                </button>
            </div>
            @error('password_confirmation')
                <p class="mt-2 text-sm text-red-300 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <!-- Terms and Conditions -->
        <div class="flex items-start">
            <div class="flex items-center h-5 mt-1">
                <input id="terms"
                       type="checkbox"
                       required
                       class="w-4 h-4 rounded border-white/30 bg-white/10 text-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-offset-0 transition-colors cursor-pointer">
            </div>
            <label for="terms" class="ml-3 text-sm text-blue-100/80">
                Saya setuju dengan
                <a href="#" class="text-blue-300 hover:text-white font-medium transition-colors">Syarat dan Ketentuan</a>
                serta
                <a href="#" class="text-blue-300 hover:text-white font-medium transition-colors">Kebijakan Privasi</a>
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="group relative w-full flex items-center justify-center gap-3 px-6 py-4 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 rounded-xl font-semibold text-white shadow-lg shadow-purple-500/30 hover:shadow-xl hover:shadow-purple-500/40 transition-all duration-300 transform hover:scale-[1.02] overflow-hidden">
            <!-- Shine Effect -->
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent translate-x-[-200%] group-hover:translate-x-[200%] transition-transform duration-1000"></div>

            <span class="text-sm uppercase tracking-wider relative z-10">Daftar Sekarang</span>
            <i class="fas fa-user-plus relative z-10 group-hover:translate-x-1 transition-transform"></i>
        </button>

        <!-- Already Registered Link -->
        <div class="text-center pt-4 border-t border-white/10">
            <p class="text-sm text-blue-100/70">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-white font-semibold hover:text-blue-300 transition-colors ml-1">
                    Masuk di sini
                </a>
            </p>
        </div>
    </form>

    <script>
        // Toggle Password Visibility
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleIcon = document.getElementById(fieldId + 'Icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Password Strength Checker
        document.getElementById('password').addEventListener('input', function(e) {
            const password = e.target.value;
            const strengthBars = [
                document.getElementById('strength-bar-1'),
                document.getElementById('strength-bar-2'),
                document.getElementById('strength-bar-3'),
                document.getElementById('strength-bar-4')
            ];
            const strengthText = document.getElementById('strength-text');

            // Reset bars
            strengthBars.forEach(bar => {
                bar.className = 'h-1 flex-1 bg-white/10 rounded transition-all duration-300';
            });

            let strength = 0;
            let message = '';
            let color = '';

            if (password.length === 0) {
                message = 'Password minimal 8 karakter';
                color = 'text-blue-200/60';
            } else if (password.length < 8) {
                strength = 1;
                message = 'Terlalu lemah';
                color = 'text-red-400';
            } else {
                strength = 1;
                if (password.length >= 10) strength++;
                if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
                if (/[0-9]/.test(password)) strength++;
                if (/[^a-zA-Z0-9]/.test(password)) strength++;

                if (strength <= 2) {
                    message = 'Lemah';
                    color = 'text-orange-400';
                } else if (strength === 3) {
                    message = 'Sedang';
                    color = 'text-yellow-400';
                } else if (strength === 4) {
                    message = 'Kuat';
                    color = 'text-green-400';
                } else {
                    message = 'Sangat Kuat';
                    color = 'text-green-300';
                }
            }

            // Update bars
            const colors = {
                1: 'bg-red-500',
                2: 'bg-orange-500',
                3: 'bg-yellow-500',
                4: 'bg-green-500'
            };

            for (let i = 0; i < Math.min(strength, 4); i++) {
                strengthBars[i].className = `h-1 flex-1 ${colors[Math.min(strength, 4)]} rounded transition-all duration-300`;
            }

            strengthText.textContent = message;
            strengthText.className = `text-xs ${color} mt-1 font-medium`;
        });

        // Match Password Confirmation
        document.getElementById('password_confirmation').addEventListener('input', function(e) {
            const password = document.getElementById('password').value;
            const confirmation = e.target.value;
            const field = e.target;

            if (confirmation.length > 0) {
                if (password === confirmation) {
                    field.classList.remove('border-red-500/50');
                    field.classList.add('border-green-500/50');
                } else {
                    field.classList.remove('border-green-500/50');
                    field.classList.add('border-red-500/50');
                }
            } else {
                field.classList.remove('border-red-500/50', 'border-green-500/50');
            }
        });
    </script>
</x-guest-layout> --}}
