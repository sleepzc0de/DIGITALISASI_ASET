<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Detail User') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Profile Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-12 text-center">
                <img src="{{ $user->getAvatarUrl() }}" alt="{{ $user->name }}"
                     class="w-32 h-32 rounded-full border-4 border-white shadow-xl mx-auto mb-4">
                <h3 class="text-3xl font-bold text-white">{{ $user->name }}</h3>
                <p class="text-indigo-100 mt-2">{{ $user->email }}</p>

                <div class="flex items-center justify-center space-x-3 mt-4">
                    @if($user->is_super_admin)
                    <span class="px-4 py-2 bg-red-500 text-white text-sm font-semibold rounded-full shadow-lg">
                        ⭐ SUPER ADMIN
                    </span>
                    @else
                    <span class="px-4 py-2 {{ $user->role == 'admin' ? 'bg-purple-500' : 'bg-blue-500' }} text-white text-sm font-semibold rounded-full shadow-lg">
                        {{ ucfirst($user->role) }}
                    </span>
                    @endif

                    @if($user->isSSOUser())
                    <span class="px-4 py-2 bg-green-500 text-white text-sm font-semibold rounded-full shadow-lg">
                        <i class="fas fa-check-circle mr-1"></i>SSO User
                    </span>
                    @endif
                </div>
            </div>

            <!-- Body -->
            <div class="p-6 space-y-6">
                <!-- Informasi Pribadi -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-user-circle text-indigo-500 mr-2"></i>
                        Informasi Pribadi
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">NIP</label>
                            <p class="text-gray-900 font-semibold mt-1">{{ $user->nip ?? '-' }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">NIK</label>
                            <p class="text-gray-900 font-semibold mt-1">{{ $user->nik ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Informasi Jabatan -->
                @if($user->jabatan || $user->unit_kerja)
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-briefcase text-indigo-500 mr-2"></i>
                        Informasi Jabatan
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if($user->jabatan)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">Jabatan</label>
                            <p class="text-gray-900 font-semibold mt-1">{{ $user->jabatan }}</p>
                        </div>
                        @endif
                        @if($user->unit_kerja)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">Unit Kerja</label>
                            <p class="text-gray-900 font-semibold mt-1">{{ $user->unit_kerja }}</p>
                        </div>
                        @endif
                        @if($user->kode_satker)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">Kode Satker</label>
                            <p class="text-gray-900 font-semibold mt-1">{{ $user->kode_satker }}</p>
                        </div>
                        @endif
                        @if($user->nama_satker)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">Nama Satker</label>
                            <p class="text-gray-900 font-semibold mt-1">{{ $user->nama_satker }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Informasi Akun -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-cog text-indigo-500 mr-2"></i>
                        Informasi Akun
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">Status Akun</label>
                            <p class="text-gray-900 font-semibold mt-1">
                                @if($user->isSSOUser())
                                <span class="text-green-600"><i class="fas fa-shield-alt mr-1"></i>SSO Kemenkeu</span>
                                @else
                                <span class="text-blue-600"><i class="fas fa-user mr-1"></i>Manual</span>
                                @endif
                            </p>
                        </div>
                        @if($user->sso_id)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">SSO ID</label>
                            <p class="text-gray-900 font-semibold mt-1">{{ $user->sso_id }}</p>
                        </div>
                        @endif
                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">Terdaftar Sejak</label>
                            <p class="text-gray-900 font-semibold mt-1">{{ $user->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">Terakhir Diupdate</label>
                            <p class="text-gray-900 font-semibold mt-1">{{ $user->updated_at->format('d M Y H:i') }}</p>
                        </div>
                        @if($user->last_sso_login)
                        <div class="bg-gray-50 rounded-lg p-4 md:col-span-2">
                            <label class="text-xs font-medium text-gray-500 uppercase">Login SSO Terakhir</label>
                            <p class="text-gray-900 font-semibold mt-1">
                                <i class="fas fa-clock text-gray-400 mr-2"></i>
                                {{ $user->last_sso_login->format('d M Y H:i:s') }}
                            </p>
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

                    @if(!$user->is_super_admin)
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.users.edit', $user) }}"
                           class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg hover:from-indigo-600 hover:to-purple-700 transition-all shadow-lg hover:shadow-xl font-medium">
                            <i class="fas fa-edit mr-2"></i>Edit User
                        </a>

                        @if($user->id !== auth()->id())
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus user ini?')"
                                    class="px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors font-medium shadow-lg hover:shadow-xl">
                                <i class="fas fa-trash-alt mr-2"></i>Hapus
                            </button>
                        </form>
                        @endif
                    </div>
                    @else
                    <span class="text-gray-400 font-medium">
                        <i class="fas fa-lock mr-2"></i>Protected Account
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
