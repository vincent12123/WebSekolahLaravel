@extends('layouts.app')

@section('title', $extracurricular->name . ' - Ekstrakurikuler')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
    <a href="{{ route('extracurriculars.index') }}" class="text-indigo-600 hover:text-indigo-700 font-medium inline-flex items-center gap-2 mb-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Ekstrakurikuler
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-8">
        @php($logoUrl = $extracurricular->logo_public_url)
        @if($logoUrl)
            <div class="h-64 bg-gray-100 flex items-center justify-center p-12">
                <img src="{{ $logoUrl }}" alt="{{ $extracurricular->name }}" class="max-h-full max-w-full object-contain">
            </div>
        @else
            <div class="h-64 bg-linear-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                <span class="text-white text-6xl font-bold">{{ substr($extracurricular->name, 0, 1) }}</span>
            </div>
        @endif

        <div class="p-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-6">{{ $extracurricular->name }}</h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                @if($extracurricular->coach)
                    <div class="flex items-start gap-3">
                        <div class="p-2 bg-indigo-50 rounded-lg">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Pelatih</p>
                            <p class="font-semibold text-gray-900">{{ $extracurricular->coach }}</p>
                        </div>
                    </div>
                @endif

                @if($extracurricular->schedule)
                    <div class="flex items-start gap-3">
                        <div class="p-2 bg-indigo-50 rounded-lg">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Jadwal</p>
                            <p class="font-semibold text-gray-900">{{ $extracurricular->schedule }}</p>
                        </div>
                    </div>
                @endif

                @if($extracurricular->location)
                    <div class="flex items-start gap-3">
                        <div class="p-2 bg-indigo-50 rounded-lg">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Lokasi</p>
                            <p class="font-semibold text-gray-900">{{ $extracurricular->location }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="prose max-w-none mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Tentang Kegiatan Ini</h2>
                <div class="text-gray-700 leading-relaxed">{!! $extracurricular->description !!}</div>
            </div>

            @if($extracurricular->contact_person)
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Kontak</h3>
                    <p class="text-gray-700">{{ $extracurricular->contact_person }}</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Gallery Photos -->
    @if($extracurricular->galleryAlbum && $extracurricular->galleryAlbum->photos->count())
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Galeri Foto</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($extracurricular->galleryAlbum->photos as $photo)
                    <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden group cursor-pointer">
                        <img src="{{ Storage::url($photo->image_path) }}" alt="{{ $photo->caption ?? $extracurricular->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                    </div>
                @endforeach
            </div>
            <div class="mt-6 text-center">
                <a href="{{ route('gallery.show', $extracurricular->galleryAlbum) }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition font-medium">
                    Lihat Galeri Lengkap
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
