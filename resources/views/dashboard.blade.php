<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Dashboard Greeting -->
            <div class="bg-indigo-600 shadow-xl rounded-2xl p-8 mb-8 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-2xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="opacity-80">Kelola konten berita dan iklan Anda dalam satu panel kendali yang modern.</p>
                </div>
                <div class="absolute right-0 top-0 opacity-10 transform translate-x-1/4 -translate-y-1/4">
                    <svg width="300" height="300" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/></svg>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Stat 1 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Berita</p>
                    <div class="flex items-baseline gap-2">
                        <h4 class="text-2xl font-bold text-gray-900">{{ $stats['total_berita'] }}</h4>
                        <span class="text-xs text-green-600 font-bold">Terbit: {{ $stats['published_berita'] }}</span>
                    </div>
                </div>
                <!-- Stat 2 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Iklan</p>
                    <div class="flex items-baseline gap-2">
                        <h4 class="text-2xl font-bold text-gray-900">{{ $stats['total_iklan'] }}</h4>
                        <span class="text-xs text-indigo-600 font-bold">Aktif: {{ $stats['active_iklan'] }}</span>
                    </div>
                </div>
                <!-- Stat 3 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 mb-1">Status Server</p>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                        <h4 class="text-lg font-bold text-gray-900">Online</h4>
                    </div>
                </div>
                <!-- Stat 4 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 mb-1">Queue Worker</p>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-indigo-500 rounded-full"></div>
                        <h4 class="text-lg font-bold text-gray-900">Running</h4>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- News Card -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-blue-100 p-3 rounded-xl text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM14 2v4h4"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-gray-400">NEWS</span>
                    </div>
                    <h4 class="text-lg font-bold mb-1">Manajemen Berita</h4>
                    <p class="text-gray-500 text-sm mb-6">Publikasikan, edit, atau hapus konten berita Anda.</p>
                    <a href="{{ route('admin.berita.index') }}" class="inline-flex items-center text-blue-600 font-bold hover:underline">
                        Pergi ke Berita
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>

                <!-- Ad Card -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-purple-100 p-3 rounded-xl text-purple-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-gray-400">ADS</span>
                    </div>
                    <h4 class="text-lg font-bold mb-1">Manajemen Iklan</h4>
                    <p class="text-gray-500 text-sm mb-6">Kelola penempatan iklan di berbagai posisi kreatif.</p>
                    <a href="{{ route('admin.iklan.index') }}" class="inline-flex items-center text-purple-600 font-bold hover:underline">
                        Kelola Iklan
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>

                <!-- Profile Card -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-orange-100 p-3 rounded-xl text-orange-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-gray-400">ACCOUNT</span>
                    </div>
                    <h4 class="text-lg font-bold mb-1">Pengaturan Akun</h4>
                    <p class="text-gray-500 text-sm mb-6">Perbarui profil dan keamanan akun administrator.</p>
                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center text-orange-600 font-bold hover:underline">
                        Edit Profil
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
