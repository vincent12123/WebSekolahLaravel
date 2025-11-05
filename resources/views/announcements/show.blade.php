@extends('layouts.app')

@section('title', $announcement->title . ' - ' . config('app.name'))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('announcements.index') }}" class="text-indigo-600 hover:text-indigo-700 font-medium inline-flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Announcements
        </a>
    </div>

    <article class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
        @if($announcement->is_important)
            <div class="mb-4">
                <span class="bg-red-100 text-red-800 text-sm font-semibold px-3 py-1 rounded-full">IMPORTANT ANNOUNCEMENT</span>
            </div>
        @endif

        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $announcement->title }}</h1>

        <div class="flex items-center gap-4 text-sm text-gray-500 mb-8 pb-6 border-b border-gray-200">
            <span class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Published: {{ $announcement->published_at->format('F d, Y') }}
            </span>
        </div>

        <div class="prose prose-lg max-w-none">
            {!! $announcement->content !!}
        </div>

        @if($announcement->file_attachment_url)
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Attachment</h3>
                <a href="{{ Storage::url($announcement->file_attachment_url) }}" target="_blank" class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-900 px-4 py-2 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Download Attachment
                </a>
            </div>
        @endif
    </article>
</div>
@endsection
