@extends('layouts.app')

@section('title', 'Event - ' . config('app.name'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Event Sekolah</h1>
        <p class="text-gray-600">Jangan lewatkan berbagai kegiatan dan acara menarik di sekolah kami</p>
    </div>

    @if($events->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($events as $event)
                <a href="{{ route('events.show', $event) }}" class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-lg hover:border-gray-300 transition-all duration-200 block group">
                    @if($event->featured_image)
                        <div class="relative overflow-hidden">
                            <img src="{{ $event->featured_image }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-200" alt="{{ $event->title }}">
                            @if($event->status === 'scheduled')
                                <div class="absolute top-2 right-2 bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded">
                                    Akan Datang
                                </div>
                            @elseif($event->status === 'completed')
                                <div class="absolute top-2 right-2 bg-gray-500 text-white text-xs font-semibold px-2 py-1 rounded">
                                    Selesai
                                </div>
                            @elseif($event->status === 'cancelled')
                                <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded">
                                    Dibatalkan
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    <div class="p-5">
                        <!-- Date and Location -->
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ $event->starts_at?->translatedFormat('d F Y, H:i') }}</span>
                        </div>
                        @if($event->location)
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ $event->location }}</span>
                            </div>
                        @endif
                        <!-- Title -->
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors">{{ $event->title }}</h3>
                        <!-- Description -->
                        <p class="text-gray-600 text-sm line-clamp-2">{{ Str::limit(strip_tags($event->description), 120) }}</p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-8">{{ $events->links() }}</div>
    @else
        <div class="bg-white border border-gray-200 rounded-lg p-16 text-center">
            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <p class="text-gray-600 text-lg">Belum ada event yang dijadwalkan.</p>
        </div>
    @endif
</div>
@endsection
