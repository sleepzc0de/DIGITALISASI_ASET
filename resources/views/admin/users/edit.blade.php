<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Header Card -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-8">
                <div class="flex items-center space-x-4">
                    <img src="{{ $user->getAvatarUrl() }}" alt="{{ $user->name }}"
                         class="w-20 h-20 rounded-full border-4 border-white shadow-lg">
                    <div class="text-white">
                        <h3 class="text-2xl font-bold">{{ $user->name }}</h3>
                        <p class="text-indigo-100 mt-1">{{ $user->email }}</p>
                        @if($user->is_super_admin)
                        <span class="inline-block mt-2 px-3 py-1 bg-red-500 text-white text-xs font-semibold rounded-full">
                            ⭐ SUPER ADMIN
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Informasi SSO (Read Only) -->
                @if($user->isSSOUser())
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-500 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-semibold text-blue-800">User SSO</h4>
                            <p class="text-sm text-blue-700 mt-1">
                                User ini terdaftar melalui SSO Kemenkeu. Beberapa data tidak dapat diubah.
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Super Admin Warning -->
                @if($user->is_super_admin)
                <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-shield-alt text-red-500 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-semibold text-red-800">Super Admin Protected</h4>
                            <p class="text-sm text-red-700 mt-1">
                                Role Super Admin tidak dapat diubah. Akun ini memiliki akses penuh ke sistem.
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user mr-2 text-gray-400"></i>Nama Lengkap
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('name') border-red-500 @enderror"
                               required>
                        @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="md:col-span-2">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-2 text-gray-400"></i>Email
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('email') border-red-500 @enderror"
                               required>
                        @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NIP (Read Only) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-id-card mr-2 text-gray-400"></i>NIP
                        </label>
                        <input type="text" value="{{ $user->nip ?? '-' }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-600"
                               disabled>
                    </div>

                    <!-- Role -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user-tag mr-2 text-gray-400"></i>Role
                        </label>
                        <select name="role" id="role"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('role') border-red-500 @enderror"
                                {{ $user->is_super_admin ? 'disabled' : '' }} required>
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @if($user->is_super_admin)
                        <p class="mt-1 text-xs text-gray-500">Role Super Admin tidak dapat diubah</p>
                        @endif
                        @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jabatan (Read Only) -->
                    @if($user->jabatan)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-briefcase mr-2 text-gray-400"></i>Jabatan
                        </label>
                        <input type="text" value="{{ $user->jabatan }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-600"
                               disabled>
                    </div>
                    @endif

                    <!-- Unit Kerja (Read Only) -->
                    @if($user->unit_kerja)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-building mr-2 text-gray-400"></i>Unit Kerja
                        </label>
                        <input type="text" value="{{ $user->unit_kerja }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-600"
                               disabled>
                    </div>
                    @endif
                </div>

                <!-- Informasi Tambahan -->
                <div class="bg-gray-50 rounded-xl p-4 space-y-2">
                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Informasi Tambahan</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt text-gray-400 mr-2"></i>
                            <span class="text-gray-600">Terdaftar: </span>
                            <span class="ml-2 font-medium text-gray-800">{{ $user->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock text-gray-400 mr-2"></i>
                            <span class="text-gray-600">Update Terakhir: </span>
                            <span class="ml-2 font-medium text-gray-800">{{ $user->updated_at->format('d M Y') }}</span>
                        </div>
                        @if($user->last_sso_login)
                        <div class="flex items-center md:col-span-2">
                            <i class="fas fa-sign-in-alt text-gray-400 mr-2"></i>
                            <span class="text-gray-600">Login SSO Terakhir: </span>
                            <span class="ml-2 font-medium text-gray-800">{{ $user->last_sso_login->format('d M Y H:i') }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.users.index') }}"
                       class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                    <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg hover:from-indigo-600 hover:to-purple-700 transition-all shadow-lg hover:shadow-xl font-medium">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
