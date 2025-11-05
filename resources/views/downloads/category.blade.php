@extends('layouts.app')

@section('title', $category->name . ' Downloads - ' . config('app.name'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <a href="{{ route('downloads.index') }}" class="text-indigo-600 hover:text-indigo-700 font-medium inline-flex items-center gap-2 mb-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to All Downloads
        </a>
        <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $category->name }}</h1>
        @if($category->description)
            <p class="text-gray-600">{{ $category->description }}</p>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar - Categories -->
        <aside class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-20">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Categories</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('downloads.index') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 transition">
                            <span>All Files</span>
                        </a>
                    </li>
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('downloads.category', $cat) }}" class="flex items-center justify-between px-3 py-2 rounded-lg {{ $cat->id === $category->id ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-gray-600 hover:bg-gray-50' }} transition">
                                <span>{{ $cat->name }}</span>
                                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">{{ $cat->files_count }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="lg:col-span-3">
            @if($files->count())
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-8">
                    <div class="divide-y divide-gray-200">
                        @foreach($files as $file)
                            <div class="p-6 hover:bg-gray-50 transition">
                                <div class="flex items-start gap-4">
                                    <div class="shrink-0">
                                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $file->file_name }}</h3>
                                        @if($file->description)
                                            <p class="text-gray-600 text-sm mb-3">{{ $file->description }}</p>
                                        @endif
                                        <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500">
                                            <span>{{ strtoupper($file->file_type) }}</span>
                                            @if($file->file_size_kb)
                                                <span>{{ number_format($file->file_size_kb, 0) }} KB</span>
                                            @endif
                                            <span>{{ $file->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="shrink-0">
                                        <a href="{{ Storage::url($file->file_path) }}" download class="inline-flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition font-medium">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                            </svg>
                                            Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $files->links() }}
                </div>
            @else
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-gray-600 text-lg">No files in this category yet.</p>
                </div>
            @endif
        </main>
    </div>
</div>
@endsection
