@extends('layouts.app')

@section('title', 'Gallery - ' . config('app.name'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Gallery</h1>
        <p class="text-gray-600">Browse our collection of memorable moments and events</p>
    </div>

    @if($albums->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($albums as $album)
                <a href="{{ route('gallery.show', $album) }}" class="group block bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="relative aspect-video overflow-hidden">
                        @if($album->cover_image_path)
                            <div class="aspect-video bg-gray-100">
                                <img src="{{ Storage::url($album->cover_image_path) }}" alt="{{ $album->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            </div>
                        @else
                            <div class="aspect-video bg-linear-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition flex items-end p-4">
                            <div class="absolute inset-x-0 bottom-0 h-1/2 bg-linear-to-t from-black to-transparent opacity-70"></div>
                            <div class="relative z-10 text-white">
                                <h3 class="font-bold text-lg">{{ $album->name }}</h3>
                                <span class="text-sm">{{ $album->photos_count }} Photos</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition">{{ $album->title }}</h2>
                        @if($album->description)
                            <p class="text-gray-600 text-sm line-clamp-2 mb-3">{{ $album->description }}</p>
                        @endif
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $album->event_date ? $album->event_date->format('M d, Y') : 'No date' }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $albums->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <p class="text-gray-600 text-lg">No gallery albums available yet.</p>
        </div>
    @endif
</div>
@endsection
