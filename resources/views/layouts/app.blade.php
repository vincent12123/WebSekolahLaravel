<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo -->
                    <div class="shrink-0">
                        <a href="{{ route('home') }}">
                            <x-application-logo class="block h-9 w-auto" />
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <!-- Home -->
                        <a href="{{ route('home') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('home') ? 'text-gray-900' : 'text-gray-500 hover:text-gray-900' }}">Beranda</a>
                        <!-- Announcements -->
                        <a href="{{ route('announcements.index') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('announcements.*') ? 'text-gray-900' : 'text-gray-500 hover:text-gray-900' }}">Pengumuman</a>
                        <!-- Articles -->
                        <a href="{{ route('articles.index') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('articles.*') ? 'text-gray-900' : 'text-gray-500 hover:text-gray-900' }}">Artikel</a>
                        <!-- Gallery -->
                        <a href="{{ route('gallery.index') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('gallery.*') ? 'text-gray-900' : 'text-gray-500 hover:text-gray-900' }}">Galeri</a>
                        <!-- Downloads -->
                        <a href="{{ route('downloads.index') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('downloads.*') ? 'text-gray-900' : 'text-gray-500 hover:text-gray-900' }}">Unduhan</a>
                        <!-- Extracurriculars -->
                        <a href="{{ route('extracurriculars.index') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('extracurriculars.*') ? 'text-gray-900' : 'text-gray-500 hover:text-gray-900' }}">Ekstrakurikuler</a>
                        <!-- Events -->
                        <a href="{{ route('events.index') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('events.*') ? 'text-gray-900' : 'text-gray-500 hover:text-gray-900' }}">Event</a>
                        <!-- Jobs -->
                        <a href="{{ route('jobs.index') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('jobs.*') ? 'text-gray-900' : 'text-gray-500 hover:text-gray-900' }}">Lowongan</a>
                        <!-- Staff -->
                        <a href="{{ route('staff.index') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('staff.*') ? 'text-gray-900' : 'text-gray-500 hover:text-gray-900' }}">Staf</a>
                        <!-- Complaints -->
                        <a href="{{ route('complaints.create') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('complaints.*') ? 'text-gray-900' : 'text-gray-500 hover:text-gray-900' }}">Pengaduan</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="sm:hidden" id="mobile-menu" style="display: none;">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('home') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">Beranda</a>
                <a href="{{ route('announcements.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('announcements.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">Pengumuman</a>
                <a href="{{ route('articles.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('articles.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">Artikel</a>
                <a href="{{ route('gallery.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('gallery.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">Galeri</a>
                <a href="{{ route('downloads.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('downloads.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">Unduhan</a>
                <a href="{{ route('extracurriculars.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('extracurriculars.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">Ekstrakurikuler</a>
                <a href="{{ route('events.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('events.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">Event</a>
                <a href="{{ route('jobs.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('jobs.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">Lowongan</a>
                <a href="{{ route('staff.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('staff.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">Staf</a>
                <a href="{{ route('complaints.create') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('complaints.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">Pengaduan</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            @php($setting = \App\Models\Setting::first())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ config('app.name') }}</h3>
                    <p class="text-gray-400">Website resmi dengan informasi terkini seputar pengumuman, artikel, galeri, dan lainnya.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('announcements.index') }}" class="text-gray-400 hover:text-white">Pengumuman</a></li>
                        <li><a href="{{ route('articles.index') }}" class="text-gray-400 hover:text-white">Artikel</a></li>
                        <li><a href="{{ route('gallery.index') }}" class="text-gray-400 hover:text-white">Galeri</a></li>
                        <li><a href="{{ route('downloads.index') }}" class="text-gray-400 hover:text-white">Unduhan</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-gray-400">
                        @if($setting && $setting->alamat)
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-gray-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span>{{ $setting->alamat }}</span>
                            </li>
                        @endif
                        @if($setting && $setting->telepon)
                            <li class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <span>Telepon: {{ $setting->telepon }}</span>
                            </li>
                        @endif
                        @if($setting && $setting->email_kontak)
                            <li class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span>Email: {{ $setting->email_kontak }}</span>
                            </li>
                        @endif
                        @if($setting && $setting->jam_operasional)
                            <li class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>Jam Operasional: {{ $setting->jam_operasional }}</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Toggle Script -->
    <script>
        document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>
</html>
