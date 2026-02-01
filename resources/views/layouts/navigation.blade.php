<nav x-data="{ open: false, dropdownOpen: false }"
    class="sticky top-0 z-30 bg-white/90 backdrop-blur-md shadow-lg shadow-blue-100/50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                        <div
                            class="h-10 w-10 rounded-xl bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center shadow-lg shadow-blue-500/30">
                            <i class="fas fa-chart-bar text-white text-lg"></i>
                        </div>
                        <div>
                            <span
                                class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                Digitalisasi Aset
                            </span>
                            <p class="text-xs text-gray-500 mt-1">Sistem Manajemen BMN</p>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-1 ml-10">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="group">
                        <div
                            class="flex items-center space-x-2 px-4 py-2 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }}">
                            <i class="fas fa-tachometer-alt text-lg"></i>
                            <span class="font-medium">{{ __('Dashboard Aset') }}</span>
                        </div>
                    </x-nav-link>

                    <x-nav-link :href="route('kinerja')" :active="request()->routeIs('kinerja')" class="group">
                        <div
                            class="flex items-center space-x-2 px-4 py-2 rounded-lg transition-all duration-200 hover:bg-green-50 hover:text-green-600 {{ request()->routeIs('kinerja') ? 'bg-green-50 text-green-600' : 'text-gray-700' }}">
                            <i class="fas fa-chart-line text-lg"></i>
                            <span class="font-medium">{{ __('Kinerja BMN') }}</span>
                        </div>
                    </x-nav-link>

                    <x-nav-link :href="route('aplikasi-bmn.index')" :active="request()->routeIs('aplikasi-bmn.*')" class="group">
                        <div
                            class="flex items-center space-x-2 px-4 py-2 rounded-lg transition-all duration-200 hover:bg-indigo-50 hover:text-indigo-600 {{ request()->routeIs('aplikasi-bmn.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700' }}">
                            <i class="fas fa-chart-line text-lg"></i>
                            <span class="font-medium">{{ __('Aplikasi BMN') }}</span>
                        </div>
                    </x-nav-link>

                    @if (auth()->user()->isAdmin())
                        <div class="relative" x-data="{ adminOpen: false }" @mouseenter="adminOpen = true"
                            @mouseleave="adminOpen = false">
                            <button
                                class="flex items-center space-x-2 px-4 py-2 rounded-lg transition-all duration-200 hover:bg-purple-50 text-gray-700">
                                <i class="fas fa-cog text-lg"></i>
                                <span class="font-medium">{{ __('Administrator') }}</span>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                                    :class="{ 'rotate-180': adminOpen }"></i>
                            </button>

                            <div x-show="adminOpen" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute left-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-200 py-2 z-40">
                                <a href="{{ route('admin.dashboard-aset.index') }}"
                                    class="flex items-center space-x-3 px-4 py-3 hover:bg-gray-50 text-gray-700">
                                    <div class="h-8 w-8 rounded-lg bg-blue-100 flex items-center justify-center">
                                        <i class="fas fa-boxes text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">Kelola Aset</p>
                                        <p class="text-xs text-gray-500">Manajemen data aset</p>
                                    </div>
                                </a>
                                <a href="{{ route('admin.kinerja-bmn.index') }}"
                                    class="flex items-center space-x-3 px-4 py-3 hover:bg-gray-50 text-gray-700">
                                    <div class="h-8 w-8 rounded-lg bg-green-100 flex items-center justify-center">
                                        <i class="fas fa-chart-pie text-green-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">Kelola Kinerja</p>
                                        <p class="text-xs text-gray-500">Analisis kinerja BMN</p>
                                    </div>
                                </a>

                                  <a href="{{ route('admin.aplikasi-bmn.index') }}"
                                    class="flex items-center space-x-3 px-4 py-3 hover:bg-gray-50 text-gray-700">
                                    <div class="h-8 w-8 rounded-lg bg-green-100 flex items-center justify-center">
                                        <i class="fas fa-chart-pie text-green-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">Kelola Aplikasi</p>
                                        <p class="text-xs text-gray-500">Manajemen Aplikasi BMN dan Pengadaan</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- User Menu Desktop -->
            <div class="hidden md:flex items-center space-x-4">
                <!-- Notification Bell -->
                <button
                    class="relative h-10 w-10 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-colors">
                    <i class="fas fa-bell text-gray-600"></i>
                    <span class="absolute top-1 right-1 h-2 w-2 bg-red-500 rounded-full"></span>
                </button>

                <!-- User Dropdown -->
                <div class="relative" x-data="{ userOpen: false }" @click.outside="userOpen = false">
                    <button @click="userOpen = !userOpen" class="flex items-center space-x-3 group">
                        <div
                            class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center shadow-md">
                            <span
                                class="text-white font-semibold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        </div>
                        <div class="text-left">
                            <p class="font-medium text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                        <i class="fas fa-chevron-down text-gray-400 text-sm transition-transform duration-200"
                            :class="{ 'rotate-180': userOpen }"></i>
                    </button>

                    <div x-show="userOpen" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-3 w-64 bg-white rounded-xl shadow-xl border border-gray-200 py-2 z-40">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="font-medium text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                        </div>

                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center space-x-3 px-4 py-3 hover:bg-gray-50 text-gray-700">
                            <div class="h-8 w-8 rounded-lg bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-user text-blue-600"></i>
                            </div>
                            <span>Profil Saya</span>
                        </a>

                        <a href="#" class="flex items-center space-x-3 px-4 py-3 hover:bg-gray-50 text-gray-700">
                            <div class="h-8 w-8 rounded-lg bg-green-100 flex items-center justify-center">
                                <i class="fas fa-cog text-green-600"></i>
                            </div>
                            <span>Pengaturan</span>
                        </a>

                        <div class="border-t border-gray-100 mt-2 pt-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center space-x-3 px-4 py-3 hover:bg-red-50 text-red-600 w-full">
                                    <div class="h-8 w-8 rounded-lg bg-red-100 flex items-center justify-center">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </div>
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button @click="open = !open"
                    class="h-10 w-10 rounded-lg bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition-colors">
                    <i class="fas fa-bars text-gray-600" x-show="!open"></i>
                    <i class="fas fa-times text-gray-600" x-show="open"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="md:hidden bg-white border-t border-gray-100 shadow-lg">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('dashboard') }}"
                class="flex items-center space-x-3 px-3 py-3 rounded-lg hover:bg-blue-50 text-gray-700">
                <div class="h-10 w-10 rounded-lg bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-tachometer-alt text-blue-600"></i>
                </div>
                <div>
                    <p class="font-medium">Dashboard Aset</p>
                    <p class="text-xs text-gray-500">Overview aset BMN</p>
                </div>
            </a>

            <a href="{{ route('kinerja') }}"
                class="flex items-center space-x-3 px-3 py-3 rounded-lg hover:bg-green-50 text-gray-700">
                <div class="h-10 w-10 rounded-lg bg-green-100 flex items-center justify-center">
                    <i class="fas fa-chart-line text-green-600"></i>
                </div>
                <div>
                    <p class="font-medium">Kinerja BMN</p>
                    <p class="text-xs text-gray-500">Analisis performa</p>
                </div>
            </a>

              <a href="{{ route('aplikasi-bmn.index') }}"
                class="flex items-center space-x-3 px-3 py-3 rounded-lg hover:bg-indigo-50 text-gray-700">
                <div class="h-10 w-10 rounded-lg bg-indigo-100 flex items-center justify-center">
                    <i class="fas fa-chart-line text-indigo-600"></i>
                </div>
                <div>
                    <p class="font-medium">Aplikasi BMN dan Pengadaan</p>
                    <p class="text-xs text-gray-500">Daftar Aplikasi BMN dan Pengadaan</p>
                </div>
            </a>

            @if (auth()->user()->isAdmin())
                <div class="border-t border-gray-100 pt-3 mt-3">
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Administrator</p>

                    <a href="{{ route('admin.dashboard-aset.index') }}"
                        class="flex items-center space-x-3 px-3 py-3 rounded-lg hover:bg-purple-50 text-gray-700">
                        <div class="h-10 w-10 rounded-lg bg-purple-100 flex items-center justify-center">
                            <i class="fas fa-boxes text-purple-600"></i>
                        </div>
                        <div>
                            <p class="font-medium">Kelola Aset</p>
                            <p class="text-xs text-gray-500">Manajemen data aset</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.kinerja-bmn.index') }}"
                        class="flex items-center space-x-3 px-3 py-3 rounded-lg hover:bg-purple-50 text-gray-700">
                        <div class="h-10 w-10 rounded-lg bg-purple-100 flex items-center justify-center">
                            <i class="fas fa-chart-pie text-purple-600"></i>
                        </div>
                        <div>
                            <p class="font-medium">Kelola Kinerja</p>
                            <p class="text-xs text-gray-500">Analisis kinerja BMN</p>
                        </div>
                    </a>

                     <a href="{{ route('admin.aplikasi-bmn.index') }}"
                        class="flex items-center space-x-3 px-3 py-3 rounded-lg hover:bg-purple-50 text-gray-700">
                        <div class="h-10 w-10 rounded-lg bg-purple-100 flex items-center justify-center">
                            <i class="fas fa-chart-pie text-purple-600"></i>
                        </div>
                        <div>
                            <p class="font-medium">Kelola Aplikasi BMN dan Pengadaan</p>
                            <p class="text-xs text-gray-500">Manajemen Aplikasi BMN dan Pengadaan</p>
                        </div>
                    </a>
                </div>
            @endif
        </div>

        <div class="border-t border-gray-100 px-4 py-4 bg-gray-50">
            <div class="flex items-center space-x-3 mb-4">
                <div
                    class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center shadow-md">
                    <span
                        class="text-white font-semibold text-lg">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
                <div>
                    <p class="font-medium text-gray-900">{{ Auth::user()->name }}</p>
                    <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <div class="space-y-2">
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-white text-gray-700">
                    <i class="fas fa-user text-blue-500"></i>
                    <span>Profil Saya</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-red-50 text-red-600 w-full">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
