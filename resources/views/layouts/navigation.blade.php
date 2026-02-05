<nav x-data="{ open: false, adminOpen: false, manajemenOpen: false }"
    class="sticky top-0 z-40 bg-white/95 backdrop-blur-md shadow-lg shadow-blue-100/30 border-b border-gray-200">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                        <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center shadow-lg shadow-blue-500/30">
                            <i class="fas fa-chart-bar text-white text-lg"></i>
                        </div>
                        <div>
                            <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                Digitalisasi Aset
                            </span>
                            <p class="text-xs text-gray-500 mt-0.5">Kementerian Keuangan RI</p>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-1 ml-10">
                    <!-- Dashboard -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="group">
                        <div class="flex items-center space-x-2 px-4 py-2.5 rounded-xl transition-all duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-gray-700' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                            </div>
                            <span class="font-medium">{{ __('Dashboard Aset') }}</span>
                        </div>
                    </x-nav-link>

                    <!-- Kinerja BMN -->
                    <x-nav-link :href="route('kinerja')" :active="request()->routeIs('kinerja')" class="group">
                        <div class="flex items-center space-x-2 px-4 py-2.5 rounded-xl transition-all duration-200 hover:bg-green-50 hover:text-green-600 {{ request()->routeIs('kinerja') ? 'bg-green-50 text-green-600 shadow-sm' : 'text-gray-700' }}">
                            <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <span class="font-medium">{{ __('Kinerja BMN') }}</span>
                        </div>
                    </x-nav-link>

                    <!-- Aplikasi BMN -->
                    <x-nav-link :href="route('aplikasi-bmn.index')" :active="request()->routeIs('aplikasi-bmn.*')" class="group">
                        <div class="flex items-center space-x-2 px-4 py-2.5 rounded-xl transition-all duration-200 hover:bg-indigo-50 hover:text-indigo-600 {{ request()->routeIs('aplikasi-bmn.*') ? 'bg-indigo-50 text-indigo-600 shadow-sm' : 'text-gray-700' }}">
                            <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                                </svg>
                            </div>
                            <span class="font-medium">{{ __('Aplikasi BMN') }}</span>
                        </div>
                    </x-nav-link>

                    <!-- Manajemen BMN Dropdown -->
                    <div class="relative" x-data="{ manajemenOpen: false }" @mouseenter="manajemenOpen = true" @mouseleave="manajemenOpen = false">
                        <button @click="manajemenOpen = !manajemenOpen"
                            class="flex items-center space-x-2 px-4 py-2.5 rounded-xl transition-all duration-200 hover:bg-purple-50 text-gray-700 group">
                            <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                            <span class="font-medium">{{ __('Manajemen BMN') }}</span>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': manajemenOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="manajemenOpen" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute left-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-gray-200 py-2 z-40">
                            <div class="px-3 py-2 mb-1">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Manajemen BMN</p>
                            </div>
                            <a href="{{ route('manajemen-bmn.perencanaan.index') }}"
                                class="flex items-center space-x-3 px-4 py-3 hover:bg-gray-50 text-gray-700 group/item">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium">Perencanaan BMN</p>
                                    <p class="text-xs text-gray-500">Perencanaan kebutuhan aset</p>
                                </div>
                            </a>
                            <a href="{{ route('manajemen-bmn.pemanfaatan.index') }}"
                                class="flex items-center space-x-3 px-4 py-3 hover:bg-gray-50 text-gray-700 group/item">
                                <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium">Pemanfaatan BMN</p>
                                    <p class="text-xs text-gray-500">Penggunaan optimal aset</p>
                                </div>
                            </a>
                            <a href="{{ route('manajemen-bmn.pemindahtanganan.index') }}"
                                class="flex items-center space-x-3 px-4 py-3 hover:bg-gray-50 text-gray-700 group/item">
                                <div class="w-8 h-8 rounded-lg bg-yellow-50 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium">Pemindahtanganan</p>
                                    <p class="text-xs text-gray-500">Alih kelola aset</p>
                                </div>
                            </a>
                            <a href="{{ route('manajemen-bmn.penghapusan.index') }}"
                                class="flex items-center space-x-3 px-4 py-3 hover:bg-gray-50 text-gray-700 group/item">
                                <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium">Penghapusan BMN</p>
                                    <p class="text-xs text-gray-500">Penghapusan aset</p>
                                </div>
                            </a>
                            <a href="{{ route('manajemen-bmn.penatausahaan.index') }}"
                                class="flex items-center space-x-3 px-4 py-3 hover:bg-gray-50 text-gray-700 group/item">
                                <div class="w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium">Penatausahaan BMN</p>
                                    <p class="text-xs text-gray-500">Administrasi aset</p>
                                </div>
                            </a>
                            <a href="{{ route('manajemen-bmn.wasdal.index') }}"
                                class="flex items-center space-x-3 px-4 py-3 hover:bg-gray-50 text-gray-700 group/item">
                                <div class="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium">Wasdal BMN</p>
                                    <p class="text-xs text-gray-500">Pengawasan dan pengendalian</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Admin Menu -->
                    @if (auth()->user()->isAdmin())
                        <div class="relative" x-data="{ adminOpen: false }" @mouseenter="adminOpen = true" @mouseleave="adminOpen = false">
                            <button @click="adminOpen = !adminOpen"
                                class="flex items-center space-x-2 px-4 py-2.5 rounded-xl transition-all duration-200 hover:bg-orange-50 text-gray-700 group">
                                <div class="w-8 h-8 rounded-lg bg-orange-100 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <span class="font-medium">{{ __('Administrator') }}</span>
                                <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': adminOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div x-show="adminOpen" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute left-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-gray-200 py-2 z-40">
                                <div class="px-3 py-2 mb-1">
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Panel Admin</p>
                                </div>
                                <a href="{{ route('admin.dashboard-aset.index') }}"
                                    class="flex items-center space-x-3 px-4 py-3 hover:bg-gray-50 text-gray-700">
                                    <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium">Kelola Aset</p>
                                        <p class="text-xs text-gray-500">Manajemen data aset</p>
                                    </div>
                                </a>
                                <a href="{{ route('admin.kinerja-bmn.index') }}"
                                    class="flex items-center space-x-3 px-4 py-3 hover:bg-gray-50 text-gray-700">
                                    <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium">Kelola Kinerja</p>
                                        <p class="text-xs text-gray-500">Analisis kinerja BMN</p>
                                    </div>
                                </a>
                                <a href="{{ route('admin.aplikasi-bmn.index') }}"
                                    class="flex items-center space-x-3 px-4 py-3 hover:bg-gray-50 text-gray-700">
                                    <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium">Kelola Aplikasi</p>
                                        <p class="text-xs text-gray-500">Manajemen aplikasi BMN</p>
                                    </div>
                                </a>
                                 <a href="{{ route('admin.users.index') }}"
                                    class="flex items-center space-x-3 px-4 py-3 hover:bg-gray-50 text-gray-700">
                                    <div class="w-8 h-8 rounded-lg bg-pink-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium">Kelola User</p>
                                        <p class="text-xs text-gray-500">Manajemen User</p>
                                    </div>
                                </a>

                                <!-- Admin Manajemen BMN Submenu -->
                                <div class="border-t border-gray-100 mt-2 pt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Kelola Manajemen BMN</p>
                                    </div>
                                    <div class="grid grid-cols-2 gap-1 px-2">
                                        <a href="{{ route('admin.manajemen-bmn.perencanaan.index') }}" class="px-3 py-2 text-xs hover:bg-gray-50 rounded-lg text-gray-700 text-center">
                                            Perencanaan
                                        </a>
                                        <a href="{{ route('admin.manajemen-bmn.pemanfaatan.index') }}" class="px-3 py-2 text-xs hover:bg-gray-50 rounded-lg text-gray-700 text-center">
                                            Pemanfaatan
                                        </a>
                                        <a href="{{ route('admin.manajemen-bmn.pemindahtanganan.index') }}" class="px-3 py-2 text-xs hover:bg-gray-50 rounded-lg text-gray-700 text-center">
                                            Pemindahtanganan
                                        </a>
                                        <a href="{{ route('admin.manajemen-bmn.penghapusan.index') }}" class="px-3 py-2 text-xs hover:bg-gray-50 rounded-lg text-gray-700 text-center">
                                            Penghapusan
                                        </a>
                                        <a href="{{ route('admin.manajemen-bmn.penatausahaan.index') }}" class="px-3 py-2 text-xs hover:bg-gray-50 rounded-lg text-gray-700 text-center">
                                            Penatausahaan
                                        </a>
                                        <a href="{{ route('admin.manajemen-bmn.wasdal.index') }}" class="px-3 py-2 text-xs hover:bg-gray-50 rounded-lg text-gray-700 text-center">
                                            Wasdal
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Side - User Menu -->
            <div class="hidden lg:flex items-center space-x-4">
                <!-- Notification Bell -->
                <button class="relative h-10 w-10 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-colors group">
                    <svg class="w-5 h-5 text-gray-600 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span class="absolute top-1 right-1 h-2 w-2 bg-red-500 rounded-full animate-pulse"></span>
                </button>

                <!-- User Dropdown -->
                <div class="relative" x-data="{ userOpen: false }" @click.outside="userOpen = false">
                    <button @click="userOpen = !userOpen" class="flex items-center space-x-3 group">
                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center shadow-md">
                            <span class="text-white font-semibold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        </div>
                        <div class="text-left">
                            <p class="font-medium text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': userOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="userOpen" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-3 w-64 bg-white rounded-xl shadow-xl border border-gray-200 py-2 z-40">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="font-medium text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                        </div>

                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center space-x-3 px-4 py-3 hover:bg-gray-50 text-gray-700 group/item">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <span>Profil Saya</span>
                        </a>

                        <a href="#" class="flex items-center space-x-3 px-4 py-3 hover:bg-gray-50 text-gray-700 group/item">
                            <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                </svg>
                            </div>
                            <span>Pengaturan</span>
                        </a>

                        <div class="border-t border-gray-100 mt-2 pt-2">
                            <form method="POST" action="{{ route('logout') }}" class="contents">
                                @csrf
                                <button type="submit"
                                    class="flex items-center space-x-3 px-4 py-3 hover:bg-red-50 text-red-600 w-full group/item">
                                    <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                    </div>
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="lg:hidden flex items-center">
                <button @click="open = !open"
                    class="h-10 w-10 rounded-lg bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition-colors">
                    <svg class="w-6 h-6 text-gray-600" x-show="!open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg class="w-6 h-6 text-gray-600" x-show="open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="lg:hidden bg-white border-t border-gray-100 shadow-xl">
        <div class="px-4 py-3 space-y-1">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center space-x-3 px-3 py-3 rounded-lg hover:bg-blue-50 text-gray-700 {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : '' }}">
                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <div>
                    <p class="font-medium">Dashboard Aset</p>
                    <p class="text-xs text-gray-500">Overview aset BMN</p>
                </div>
            </a>

            <!-- Kinerja -->
            <a href="{{ route('kinerja') }}"
                class="flex items-center space-x-3 px-3 py-3 rounded-lg hover:bg-green-50 text-gray-700 {{ request()->routeIs('kinerja') ? 'bg-green-50 text-green-600' : '' }}">
                <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-medium">Kinerja BMN</p>
                    <p class="text-xs text-gray-500">Analisis performa</p>
                </div>
            </a>

            <!-- Aplikasi BMN -->
            <a href="{{ route('aplikasi-bmn.index') }}"
                class="flex items-center space-x-3 px-3 py-3 rounded-lg hover:bg-indigo-50 text-gray-700 {{ request()->routeIs('aplikasi-bmn.*') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                <div class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-medium">Aplikasi BMN</p>
                    <p class="text-xs text-gray-500">Daftar aplikasi BMN</p>
                </div>
            </a>

            <!-- Manajemen BMN Mobile -->
            <div class="border-t border-gray-100 pt-3">
                <div class="px-3 py-2">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Manajemen BMN</p>
                </div>
                <div class="grid grid-cols-2 gap-2 px-2">
                    <a href="{{ route('manajemen-bmn.perencanaan.index') }}"
                        class="px-3 py-2 text-sm hover:bg-blue-50 rounded-lg text-gray-700 text-center border border-gray-100">
                        Perencanaan
                    </a>
                    <a href="{{ route('manajemen-bmn.pemanfaatan.index') }}"
                        class="px-3 py-2 text-sm hover:bg-green-50 rounded-lg text-gray-700 text-center border border-gray-100">
                        Pemanfaatan
                    </a>
                    <a href="{{ route('manajemen-bmn.pemindahtanganan.index') }}"
                        class="px-3 py-2 text-sm hover:bg-yellow-50 rounded-lg text-gray-700 text-center border border-gray-100">
                        Pemindahtanganan
                    </a>
                    <a href="{{ route('manajemen-bmn.penghapusan.index') }}"
                        class="px-3 py-2 text-sm hover:bg-red-50 rounded-lg text-gray-700 text-center border border-gray-100">
                        Penghapusan
                    </a>
                    <a href="{{ route('manajemen-bmn.penatausahaan.index') }}"
                        class="px-3 py-2 text-sm hover:bg-indigo-50 rounded-lg text-gray-700 text-center border border-gray-100">
                        Penatausahaan
                    </a>
                    <a href="{{ route('manajemen-bmn.wasdal.index') }}"
                        class="px-3 py-2 text-sm hover:bg-purple-50 rounded-lg text-gray-700 text-center border border-gray-100">
                        Wasdal
                    </a>
                </div>
            </div>

            @if (auth()->user()->isAdmin())
                <div class="border-t border-gray-100 pt-3">
                    <div class="px-3 py-2">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Panel Admin</p>
                    </div>
                    <a href="{{ route('admin.dashboard-aset.index') }}"
                        class="flex items-center space-x-3 px-3 py-3 rounded-lg hover:bg-orange-50 text-gray-700">
                        <div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">Kelola Aset</p>
                            <p class="text-xs text-gray-500">Manajemen data aset</p>
                        </div>
                    </a>
                    <a href="{{ route('admin.kinerja-bmn.index') }}"
                        class="flex items-center space-x-3 px-3 py-3 rounded-lg hover:bg-orange-50 text-gray-700">
                        <div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">Kelola Kinerja</p>
                            <p class="text-xs text-gray-500">Analisis kinerja BMN</p>
                        </div>
                    </a>
                    <a href="{{ route('admin.aplikasi-bmn.index') }}"
                        class="flex items-center space-x-3 px-3 py-3 rounded-lg hover:bg-orange-50 text-gray-700">
                        <div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">Kelola Aplikasi</p>
                            <p class="text-xs text-gray-500">Manajemen aplikasi BMN</p>
                        </div>
                    </a>

                    <!-- Admin Manajemen BMN Mobile -->
                    <div class="px-3 pt-2">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Kelola Manajemen BMN</p>
                        <div class="grid grid-cols-3 gap-2">
                            <a href="{{ route('admin.manajemen-bmn.perencanaan.index') }}" class="px-2 py-1.5 text-xs hover:bg-gray-50 rounded-lg text-gray-700 text-center border border-gray-100">
                                Perencanaan
                            </a>
                            <a href="{{ route('admin.manajemen-bmn.pemanfaatan.index') }}" class="px-2 py-1.5 text-xs hover:bg-gray-50 rounded-lg text-gray-700 text-center border border-gray-100">
                                Pemanfaatan
                            </a>
                            <a href="{{ route('admin.manajemen-bmn.pemindahtanganan.index') }}" class="px-2 py-1.5 text-xs hover:bg-gray-50 rounded-lg text-gray-700 text-center border border-gray-100">
                                Pemindahtanganan
                            </a>
                            <a href="{{ route('admin.manajemen-bmn.penghapusan.index') }}" class="px-2 py-1.5 text-xs hover:bg-gray-50 rounded-lg text-gray-700 text-center border border-gray-100">
                                Penghapusan
                            </a>
                            <a href="{{ route('admin.manajemen-bmn.penatausahaan.index') }}" class="px-2 py-1.5 text-xs hover:bg-gray-50 rounded-lg text-gray-700 text-center border border-gray-100">
                                Penatausahaan
                            </a>
                            <a href="{{ route('admin.manajemen-bmn.wasdal.index') }}" class="px-2 py-1.5 text-xs hover:bg-gray-50 rounded-lg text-gray-700 text-center border border-gray-100">
                                Wasdal
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Mobile User Menu -->
        <div class="border-t border-gray-100 px-4 py-4 bg-gray-50">
            <div class="flex items-center space-x-3 mb-4">
                <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center shadow-md">
                    <span class="text-white font-semibold text-lg">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
                <div>
                    <p class="font-medium text-gray-900">{{ Auth::user()->name }}</p>
                    <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <div class="space-y-2">
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-white text-gray-700">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span>Profil Saya</span>
                </a>

                <form method="POST" action="{{ auth()->user()->isSSOUser() ? route('sso.logout') : route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-red-50 text-red-600 w-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
