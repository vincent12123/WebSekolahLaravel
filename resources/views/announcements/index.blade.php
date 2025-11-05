@extends('layouts.app')

@section('title', 'Announcements - ' . config('app.name'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Announcements</h1>
        <p class="text-gray-600">Stay informed with our latest updates and important notices</p>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
        <form method="GET" action="{{ route('announcements.index') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search announcements..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>
            <div class="flex items-center gap-2">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="important" value="1" {{ request('important') === '1' ? 'checked' : '' }} class="rounded text-indigo-600">
                    <span class="text-sm font-medium text-gray-700">Important only</span>
                </label>
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition font-medium">
                Search
            </button>
        </form>
    </div>

    <!-- Announcements List -->
    @if($announcements->count())
        <div class="space-y-6">
            @foreach($announcements as $announcement)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                    <div class="flex items-start gap-4">
                        @if($announcement->is_important)
                            <div class="shrink-0 mt-1">
                                <span class="bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded-full">IMPORTANT</span>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <h2 class="text-2xl font-semibold text-gray-900 mb-2">
                                <a href="{{ route('announcements.show', $announcement) }}" class="hover:text-indigo-600">
                                    {{ $announcement->title }}
                                </a>
                            </h2>
                            <div class="text-gray-600 mb-4 line-clamp-3">
                                {!! Str::limit(strip_tags($announcement->content), 300) !!}
                            </div>
                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $announcement->published_at->format('F d, Y') }}
                                </span>
                                <a href="{{ route('announcements.show', $announcement) }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
                                    Read more →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $announcements->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
            <p class="text-gray-600 text-lg">No announcements found.</p>
        </div>
    @endif
</div>
@endsection
