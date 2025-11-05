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
                        <a href="{{ route('home') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('home') ? 'text-gray-900' : 'text-gray-500 hover:text-gray-900' }}">Home</a>
                        <!-- Announcements -->
                        <a href="{{ route('announcements.index') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('announcements.*') ? 'text-gray-900' : 'text-gray-500 hover:text-gray-900' }}">Announcements</a>
                        <!-- Articles -->
                        <a href="{{ route('articles.index') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('articles.*') ? 'text-gray-900' : 'text-gray-500 hover:text-gray-900' }}">Articles</a>
                        <!-- Gallery -->
                        <a href="{{ route('gallery.index') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('gallery.*') ? 'text-gray-900' : 'text-gray-500 hover:text-gray-900' }}">Gallery</a>
                        <!-- Downloads -->
                        <a href="{{ route('downloads.index') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('downloads.*') ? 'text-gray-900' : 'text-gray-500 hover:text-gray-900' }}">Downloads</a>
                        <!-- Extracurriculars -->
                        <a href="{{ route('extracurriculars.index') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('extracurriculars.*') ? 'text-gray-900' : 'text-gray-500 hover:text-gray-900' }}">Extracurriculars</a>
                        <!-- Jobs -->
                        <a href="{{ route('jobs.index') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('jobs.*') ? 'text-gray-900' : 'text-gray-500 hover:text-gray-900' }}">Jobs</a>
                        <!-- Staff -->
                        <a href="{{ route('staff.index') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('staff.*') ? 'text-gray-900' : 'text-gray-500 hover:text-gray-900' }}">Staff</a>
                        <!-- Complaints -->
                        <a href="{{ route('complaints.create') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('complaints.*') ? 'text-gray-900' : 'text-gray-500 hover:text-gray-900' }}">Complaints</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="sm:hidden" id="mobile-menu" style="display: none;">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('home') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">Home</a>
                <a href="{{ route('announcements.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('announcements.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">Announcements</a>
                <a href="{{ route('articles.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('articles.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">Articles</a>
                <a href="{{ route('gallery.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('gallery.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">Gallery</a>
                <a href="{{ route('downloads.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('downloads.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">Downloads</a>
                <a href="{{ route('extracurriculars.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('extracurriculars.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">Extracurriculars</a>
                <a href="{{ route('jobs.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('jobs.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">Jobs</a>
                <a href="{{ route('staff.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('staff.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">Staff</a>
                <a href="{{ route('complaints.create') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('complaints.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">Complaints</a>
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ config('app.name') }}</h3>
                    <p class="text-gray-400">Website resmi dengan informasi terkini seputar pengumuman, artikel, galeri, dan lainnya.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('announcements.index') }}" class="text-gray-400 hover:text-white">Announcements</a></li>
                        <li><a href="{{ route('articles.index') }}" class="text-gray-400 hover:text-white">Articles</a></li>
                        <li><a href="{{ route('gallery.index') }}" class="text-gray-400 hover:text-white">Gallery</a></li>
                        <li><a href="{{ route('downloads.index') }}" class="text-gray-400 hover:text-white">Downloads</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('jobs.index') }}" class="hover:text-white">Career Opportunities</a></li>
                        <li><a href="{{ route('complaints.create') }}" class="hover:text-white">Submit Complaint</a></li>
                        <li><a href="{{ route('staff.index') }}" class="hover:text-white">Our Team</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
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
