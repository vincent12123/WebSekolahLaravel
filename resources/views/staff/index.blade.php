@extends('layouts.app')

@section('title', 'Our Staff - ' . config('app.name'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Our Staff</h1>
        <p class="text-gray-600">Meet the dedicated team behind our educational excellence</p>
    </div>

    @if($staff->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($staff as $member)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition group">
                    @if($member->photo_path)
                        <div class="aspect-square bg-gray-100">
                            <img src="{{ Storage::url($member->photo_path) }}" alt="{{ $member->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        </div>
                    @else
                        <div class="aspect-square bg-linear-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                            <span class="text-white text-5xl font-bold">{{ substr($member->name, 0, 1) }}</span>
                        </div>
                    @endif

                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $member->name }}</h3>
                        <p class="text-indigo-600 font-medium mb-4">{{ $member->position }}</p>

                        @if($member->department)
                            <div class="flex items-center gap-2 text-sm text-gray-600 mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <span>{{ $member->department }}</span>
                            </div>
                        @endif

                        @if($member->email)
                            <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <a href="mailto:{{ $member->email }}" class="hover:text-indigo-600 transition truncate">{{ $member->email }}</a>
                            </div>
                        @endif

                        @if($member->phone)
                            <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <a href="tel:{{ $member->phone }}" class="hover:text-indigo-600 transition">{{ $member->phone }}</a>
                            </div>
                        @endif

                        @if($member->bio)
                            <p class="text-gray-600 text-sm mt-4 line-clamp-3">{{ $member->bio }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <p class="text-gray-600 text-lg">No staff members listed yet.</p>
        </div>
    @endif
</div>
@endsection
