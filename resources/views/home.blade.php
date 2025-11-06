@extends('layouts.app')

@section('title', 'Beranda - ' . config('app.name'))

@section('content')
<!-- Hero Section -->
<div class="relative">
    <div class="relative h-[560px] sm:h-[640px] lg:h-[720px]">
        @if(!empty($heroImageUrl))
            <img src="{{ $heroImageUrl }}" alt="Hero" class="absolute inset-0 w-full h-full object-cover" />
            <!-- Dark overlay to improve text contrast -->
            <div class="absolute inset-0 bg-black/60"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-black/40 to-black/30"></div>
        @else
            <div class="absolute inset-0 bg-gradient-to-r from-purple-700 to-indigo-700"></div>
            <div class="absolute inset-0 bg-black/40"></div>
        @endif

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
            <div class="max-w-3xl text-left text-white">
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold leading-tight drop-shadow-md">
                    Selamat Datang di
                    <span class="block">{{ $schoolName }}</span>
                </h1>
                <p class="mt-5 text-lg sm:text-xl text-white/90">
                    Memberdayakan siswa untuk mencapai keunggulan melalui pendidikan berkualitas dan pengembangan holistik
                </p>
                <div class="mt-8 flex flex-wrap items-center gap-4">
                    <a href="{{ route('articles.index') }}" class="inline-flex items-center justify-center rounded-md bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 sm:px-7 py-3 shadow-lg shadow-black/20 transition" aria-label="Jelajahi berita">
                        Jelajahi Berita
                    </a>
                    <a href="{{ route('complaints.create') }}" class="inline-flex items-center justify-center rounded-md bg-white/10 hover:bg-white/20 text-white border border-white/30 backdrop-blur px-6 sm:px-7 py-3 font-semibold transition" aria-label="Hubungi kami">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Latest Announcements -->
    <section class="py-12">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Pengumuman Terbaru</h2>
            <a href="{{ route('announcements.index') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold" aria-label="Lihat semua pengumuman">Lihat Semua →</a>
        </div>

        @if($latestAnnouncements->count())
            <div class="space-y-4">
                @foreach($latestAnnouncements as $announcement)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-xl font-semibold text-gray-900">
                                        <a href="{{ route('announcements.show', $announcement) }}" class="hover:text-indigo-600">
                                            {{ $announcement->title }}
                                        </a>
                                    </h3>
                                    @if($announcement->is_important)
                                        <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">PENTING</span>
                                    @endif
                                </div>
                                <p class="text-gray-600 line-clamp-2">{{ Str::limit(strip_tags($announcement->content), 200) }}</p>
                                <p class="text-sm text-gray-500 mt-2">{{ $announcement->published_at->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <p class="mt-4 text-gray-500">Belum ada pengumuman saat ini.</p>
            </div>
        @endif
    </section>

    <!-- Latest Articles -->
    <section class="py-12 border-t border-gray-200">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Artikel Terbaru</h2>
            <a href="{{ route('articles.index') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold" aria-label="Lihat semua artikel">Lihat Semua →</a>
        </div>

        @if($latestArticles->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($latestArticles as $article)
                    <article class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">
                        @if($article->featured_image)
                            <img src="{{ $article->featured_image }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-indigo-500 to-purple-600"></div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-xs font-semibold text-indigo-600 bg-indigo-50 px-2 py-1 rounded">
                                    {{ $article->category->name }}
                                </span>
                                <span class="text-sm text-gray-500">{{ $article->published_at->translatedFormat('d M Y') }}</span>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                                <a href="{{ route('articles.show', $article) }}" class="hover:text-indigo-600">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 text-sm line-clamp-3 mb-4">{{ Str::limit(strip_tags($article->content), 150) }}</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <span>Oleh {{ $article->author->name }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <p class="mt-4 text-gray-500">Belum ada artikel saat ini.</p>
            </div>
        @endif
    </section>

    @if(isset($upcomingEvents) && $upcomingEvents->count())
    <!-- Upcoming Events -->
    <section class="py-12 border-t border-gray-200">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Event Mendatang</h2>
            <a href="{{ route('events.index') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold" aria-label="Lihat semua event">Lihat Semua →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($upcomingEvents as $event)
                <a href="{{ route('events.show', $event) }}" class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition block">
                    @if($event->featured_image)
                        <img src="{{ $event->featured_image }}" class="w-full h-44 object-cover" alt="{{ $event->title }}">
                    @endif
                    <div class="p-5">
                        <div class="text-sm text-gray-500 mb-1">{{ $event->starts_at?->translatedFormat('d F Y, H:i') }} @if($event->location) • {{ $event->location }} @endif</div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $event->title }}</h3>
                        <p class="text-gray-600 text-sm line-clamp-2">{{ Str::limit(strip_tags($event->description), 140) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Featured Gallery Albums -->
    <section class="py-12 border-t border-gray-200">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Galeri</h2>
            <a href="{{ route('gallery.index') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold" aria-label="Lihat semua album galeri">Lihat Semua →</a>
        </div>

        @if($featuredAlbums->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredAlbums as $album)
                    <a href="{{ route('gallery.show', $album) }}" class="group block">
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">
                            @if($album->cover_image)
                                <img src="{{ Storage::url($album->cover_image) }}" alt="{{ $album->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            @elseif($album->photos->first())
                                <img src="{{ Storage::url($album->photos->first()->file_url) }}" alt="{{ $album->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-900 mb-1 group-hover:text-indigo-600">{{ $album->title }}</h3>
                                <p class="text-sm text-gray-500">{{ $album->event_date?->translatedFormat('d F Y') ?? 'Tanpa tanggal' }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <p class="mt-4 text-gray-500">Belum ada album galeri saat ini.</p>
            </div>
        @endif
    </section>

    <!-- Quick Links -->
    <section class="py-12 border-t border-gray-200">
    <h2 class="text-3xl font-bold text-gray-900 mb-8">Akses Cepat</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('downloads.index') }}" class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-indigo-300 transition group" aria-label="Akses bagian unduhan">
                <div class="flex items-center gap-4">
                    <div class="bg-indigo-100 text-indigo-600 p-3 rounded-lg group-hover:bg-indigo-600 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 group-hover:text-indigo-600">Unduhan</h3>
                        <p class="text-sm text-gray-600">Akses berkas dan dokumen</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('jobs.index') }}" class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-indigo-300 transition group" aria-label="Lihat lowongan kerja">
                <div class="flex items-center gap-4">
                    <div class="bg-green-100 text-green-600 p-3 rounded-lg group-hover:bg-green-600 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 group-hover:text-green-600">Lowongan Kerja</h3>
                        <p class="text-sm text-gray-600">Lihat posisi yang tersedia</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('complaints.create') }}" class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-indigo-300 transition group" aria-label="Kirim masukan atau hubungi kami">
                <div class="flex items-center gap-4">
                    <div class="bg-purple-100 text-purple-600 p-3 rounded-lg group-hover:bg-purple-600 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 group-hover:text-purple-600">Kontak Kami</h3>
                        <p class="text-sm text-gray-600">Kirim masukan Anda</p>
                    </div>
                </div>
            </a>
        </div>
    </section>
</div>
@endsection
