@extends('layouts.app')

@section('title', 'Ekstrakurikuler - ' . config('app.name'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Hero heading -->
    <div class="py-10">
        <h1 class="text-5xl font-extrabold text-gray-900 mb-3 tracking-tight">Kegiatan Ekstrakurikuler</h1>
        <p class="text-gray-600 text-lg">Temukan peluang untuk mengeksplorasi minat dan mengembangkan keterampilan baru</p>
    </div>

    @if($extracurriculars->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($extracurriculars as $extracurricular)
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition group">
                    @php($logoUrl = $extracurricular->logo_public_url)
                    @if($logoUrl)
                        <img src="{{ $logoUrl }}" alt="{{ $extracurricular->name }}" class="w-full h-56 object-cover">
                    @else
                        <div class="w-full h-56 bg-gray-100 flex items-center justify-center">
                            <span class="text-gray-400 text-5xl font-bold">{{ substr($extracurricular->name, 0, 1) }}</span>
                        </div>
                    @endif

                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-3 group-hover:text-indigo-600 transition">{{ $extracurricular->name }}</h3>

                        @if($extracurricular->instructor_name)
                            <div class="flex items-center gap-2 text-gray-700 mb-2">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>Pelatih {{ $extracurricular->instructor_name }}</span>
                            </div>
                        @endif

                        @if($extracurricular->schedule)
                            <div class="flex items-center gap-2 text-gray-700 mb-3">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span>{{ $extracurricular->schedule }}</span>
                            </div>
                        @endif

                        @php($desc = trim(Str::limit(strip_tags($extracurricular->description ?? ''), 80)))
                        @if($desc !== '')
                            <div class="flex items-start gap-2 text-gray-700 mb-5">
                                <svg class="w-5 h-5 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M4 21h16M5 8l7-3 7 3m-7 13V5"/></svg>
                                <p class="text-sm leading-6">{{ $desc }}</p>
                            </div>
                        @endif

                        @if($extracurricular->galleryAlbum && $extracurricular->galleryAlbum->photos_count > 0)
                            <div class="mb-4">
                                <span class="inline-flex items-center gap-1 text-xs bg-indigo-50 text-indigo-700 px-2.5 py-1 rounded-full font-medium">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $extracurricular->galleryAlbum->photos_count }} Foto
                                </span>
                            </div>
                        @endif

                        <a href="{{ route('extracurriculars.show', $extracurricular) }}" class="mt-2 block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md py-2.5 transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <p class="text-gray-600 text-lg">Belum ada data ekstrakurikuler.</p>
        </div>
    @endif
</div>
@endsection
