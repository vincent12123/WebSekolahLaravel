@extends('layouts.app')

@section('title', $event->title . ' - Event')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Breadcrumb -->
    <nav class="mb-6 text-sm">
        <ol class="flex items-center space-x-2 text-gray-500">
            <li><a href="{{ route('home') }}" class="hover:text-gray-900">Beranda</a></li>
            <li><span>/</span></li>
            <li><a href="{{ route('events.index') }}" class="hover:text-gray-900">Event</a></li>
            <li><span>/</span></li>
            <li class="text-gray-900">{{ Str::limit($event->title, 50) }}</li>
        </ol>
    </nav>

    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden shadow-sm">
        @if($event->featured_image)
            <div class="relative">
                <img src="{{ $event->featured_image }}" class="w-full h-96 object-cover" alt="{{ $event->title }}">
                <!-- Status Badge -->
                @if($event->status === 'scheduled')
                    <div class="absolute top-4 right-4 bg-green-500 text-white text-sm font-semibold px-3 py-1 rounded-full shadow-lg">
                        Akan Datang
                    </div>
                @elseif($event->status === 'completed')
                    <div class="absolute top-4 right-4 bg-gray-500 text-white text-sm font-semibold px-3 py-1 rounded-full shadow-lg">
                        Selesai
                    </div>
                @elseif($event->status === 'cancelled')
                    <div class="absolute top-4 right-4 bg-red-500 text-white text-sm font-semibold px-3 py-1 rounded-full shadow-lg">
                        Dibatalkan
                    </div>
                @endif
            </div>
        @endif

        <div class="p-8">
            <!-- Title -->
            <h1 class="text-4xl font-bold text-gray-900 mb-6">{{ $event->title }}</h1>

            <!-- Event Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8 pb-8 border-b border-gray-200">
                <!-- Start Date -->
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-500">Mulai</div>
                        <div class="text-base font-semibold text-gray-900">{{ $event->starts_at?->translatedFormat('d F Y') }}</div>
                        <div class="text-sm text-gray-600">{{ $event->starts_at?->translatedFormat('H:i') }} WIB</div>
                    </div>
                </div>

                <!-- End Date -->
                @if($event->ends_at)
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-500">Selesai</div>
                        <div class="text-base font-semibold text-gray-900">{{ $event->ends_at?->translatedFormat('d F Y') }}</div>
                        <div class="text-sm text-gray-600">{{ $event->ends_at?->translatedFormat('H:i') }} WIB</div>
                    </div>
                </div>
                @endif

                <!-- Location -->
                @if($event->location)
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-500">Lokasi</div>
                        <div class="text-base font-semibold text-gray-900">{{ $event->location }}</div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Description -->
            <div class="prose max-w-none prose-headings:text-gray-900 prose-p:text-gray-700 prose-a:text-indigo-600 prose-strong:text-gray-900">
                {!! $event->description !!}
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="mt-8">
        <a href="{{ route('events.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Event
        </a>
    </div>
</div>
@endsection
