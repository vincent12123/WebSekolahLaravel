@extends('layouts.app')

@section('title', $article->title . ' - ' . config('app.name'))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('articles.index') }}" class="text-indigo-600 hover:text-indigo-700 font-medium inline-flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Artikel
        </a>
    </div>

    <!-- Article -->
    <article class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-8">
        @if($article->featured_image)
            <img src="{{ $article->featured_image }}" alt="{{ $article->title }}" class="w-full h-96 object-cover">
        @endif

        <div class="p-8">
            <div class="mb-6">
                <a href="{{ route('articles.category', $article->category) }}" class="inline-block text-sm font-semibold text-indigo-600 bg-indigo-50 px-3 py-1 rounded hover:bg-indigo-100 transition">
                    {{ $article->category->name }}
                </a>
            </div>

            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $article->title }}</h1>

            <div class="flex items-center gap-4 text-sm text-gray-500 mb-8 pb-6 border-b border-gray-200">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span>Oleh {{ $article->author->name }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>{{ $article->published_at->translatedFormat('d F Y') }}</span>
                </div>
            </div>

            <div class="prose prose-lg max-w-none">
                {!! $article->content !!}
            </div>

            @if($article->tags && $article->tags->count())
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex flex-wrap gap-2">
                        @foreach($article->tags as $tag)
                            <span class="bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full">{{ $tag->name_label }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </article>

    <!-- Related Articles -->
    @if($relatedArticles->count())
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Artikel Terkait</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedArticles as $related)
                    <a href="{{ route('articles.show', $related) }}" class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition group">
                        @if($related->featured_image)
                            <img src="{{ Storage::url($related->featured_image) }}" alt="{{ $related->title }}" class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="aspect-video w-full bg-linear-to-br from-indigo-500 to-purple-600 rounded-lg"></div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 line-clamp-2 group-hover:text-indigo-600 transition">{{ $related->title }}</h3>
                            <p class="text-sm text-gray-500 mt-2">{{ $related->published_at->translatedFormat('d M Y') }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Comments Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Komentar ({{ $article->comments->count() }})</h2>

        <!-- Comment Form -->
        <div class="mb-8 pb-8 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tinggalkan Komentar</h3>

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('articles.comments.store', $article) }}" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full px-3 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full px-3 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Komentar</label>
                    <textarea name="content" id="content" rows="4" required class="w-full px-3 py-2 border @error('content') border-red-500 @else border-gray-300 @enderror rounded-md focus:ring-indigo-500 focus:border-indigo-500">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Kirim Komentar
                </button>
            </form>
        </div>

        <!-- Comments List -->
        @if($article->comments->count())
            <div class="space-y-6">
                @foreach($article->comments as $comment)
                    <div class="border-l-4 border-indigo-500 pl-4">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <h4 class="font-semibold text-gray-900">{{ $comment->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $comment->created_at->translatedFormat('d F Y \p\u\k\u\l H:i') }}</p>
                            </div>
                        </div>
                        <p class="text-gray-700 mb-3">{{ $comment->content }}</p>

                        <!-- Replies -->
                        @if($comment->replies && $comment->replies->count())
                            <div class="ml-6 space-y-4 mt-4 pt-4 border-t border-gray-100">
                                @foreach($comment->replies as $reply)
                                    <div class="border-l-2 border-gray-300 pl-4">
                                        <div class="flex items-start justify-between mb-2">
                                            <div>
                                                <h5 class="font-semibold text-gray-900 text-sm">{{ $reply->name }}</h5>
                                                <p class="text-xs text-gray-500">{{ $reply->created_at->translatedFormat('d F Y \p\u\k\u\l H:i') }}</p>
                                            </div>
                                        </div>
                                        <p class="text-gray-700 text-sm">{{ $reply->content }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center py-8">Belum ada komentar. Jadilah yang pertama!</p>
        @endif
    </div>
</div>
@endsection
