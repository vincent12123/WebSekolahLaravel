@extends('layouts.app')

@section('title', $album->title . ' - Gallery - ' . config('app.name'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('gallery.index') }}" class="text-indigo-600 hover:text-indigo-700 font-medium inline-flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Gallery
        </a>
    </div>

    <!-- Album Header -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-3">{{ $album->title }}</h1>
        @if($album->description)
            <p class="text-gray-600 text-lg mb-4">{{ $album->description }}</p>
        @endif
        <div class="flex items-center gap-4 text-sm text-gray-500">
            @if($album->event_date)
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    {{ $album->event_date->format('F d, Y') }}
                </span>
            @endif
            <span class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                {{ $album->photos->count() }} {{ Str::plural('photo', $album->photos->count()) }}
            </span>
        </div>
    </div>

    <!-- Photos Grid -->
    @if($album->photos->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($album->photos as $photo)
                <div class="group relative aspect-square overflow-hidden rounded-lg bg-gray-100 cursor-pointer" onclick="openLightbox({{ $loop->index }})">
                    <img src="{{ Storage::url($photo->file_url) }}" alt="{{ $photo->description ?? $album->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                        </svg>
                    </div>
                    @if($photo->description)
                        <div class="absolute bottom-0 left-0 right-0 bg-linear-to-t from-black/70 to-transparent p-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <p class="text-white text-sm line-clamp-2">{{ $photo->description }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Lightbox -->
        <div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden items-center justify-center p-4">
            <div class="relative max-w-4xl max-h-full">
                <img id="lightbox-img" src="" alt="Lightbox image" class="max-w-full max-h-[90vh] object-contain">
                <div id="lightbox-caption" class="text-white text-center mt-2"></div>
            </div>
            <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-3xl">&times;</button>
            <button onclick="prevPhoto()" class="absolute left-4 top-1/2 -translate-y-1/2 text-white text-3xl">&#10094;</button>
            <button onclick="nextPhoto()" class="absolute right-4 top-1/2 -translate-y-1/2 text-white text-3xl">&#10095;</button>
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 text-white text-sm" id="lightbox-counter"></div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <p class="text-gray-600 text-lg">No photos in this album yet.</p>
        </div>
    @endif
</div>

@push('scripts')
<script>
    const photos = @json($album->photos->map(function($photo) {
        return [
            'url' => Storage::url($photo->file_url),
            'description' => $photo->description
        ];
    }));
    let currentIndex = 0;

    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const lightboxCounter = document.getElementById('lightbox-counter');

    function openLightbox(index) {
        currentIndex = index;
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        showPhoto();
    }

    function closeLightbox() {
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
    }

    function showPhoto() {
        const photo = photos[currentIndex];
        lightboxImg.src = photo.url;
        lightboxCaption.textContent = photo.description || '';
        lightboxCounter.textContent = `${currentIndex + 1} of ${photos.length}`;
    }

    function nextPhoto() {
        currentIndex = (currentIndex + 1) % photos.length;
        showPhoto();
    }

    function prevPhoto() {
        currentIndex = (currentIndex - 1 + photos.length) % photos.length;
        showPhoto();
    }

    document.addEventListener('keydown', function(e) {
        if (!lightbox.classList.contains('hidden')) {
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowRight') nextPhoto();
            if (e.key === 'ArrowLeft') prevPhoto();
        }
    });
</script>
@endpush
@endsection
