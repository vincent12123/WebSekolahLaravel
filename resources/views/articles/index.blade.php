@extends('layouts.app')

@section('title', 'Articles - ' . config('app.name'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Articles</h1>
        <p class="text-gray-600">Explore our collection of insightful articles and stories</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar - Categories -->
        <aside class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-20">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Categories</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('articles.index') }}" class="flex items-center justify-between px-3 py-2 rounded-lg {{ !request()->is('articles/category/*') ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-gray-600 hover:bg-gray-50' }} transition">
                            <span>All Articles</span>
                        </a>
                    </li>
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('articles.category', $cat) }}" class="flex items-center justify-between px-3 py-2 rounded-lg {{ request()->is('articles/category/' . $cat->slug) ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-gray-600 hover:bg-gray-50' }} transition">
                                <span>{{ $cat->name }}</span>
                                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">{{ $cat->articles_count }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="lg:col-span-3">
            <!-- Search -->
            <div class="mb-6">
                <form method="GET" action="{{ route('articles.index') }}">
                    <div class="flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search articles..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition font-medium">
                            Search
                        </button>
                    </div>
                </form>
            </div>

            <!-- Articles Grid -->
            @if($articles->count())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    @foreach($articles as $article)
                        <article class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow duration-300 group">
                            <a href="{{ route('articles.show', $article) }}" class="block">
                                @if($article->featured_image)
                                    <div class="aspect-video overflow-hidden">
                                        <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                @else
                                    <div class="aspect-video bg-linear-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                        <span class="text-white text-4xl font-bold">{{ substr($article->title, 0, 1) }}</span>
                                    </div>
                                @endif

                                <div class="p-6">
                                    <div class="flex items-center gap-2 mb-3">
                                        <span class="text-xs font-semibold text-indigo-600 bg-indigo-50 px-2 py-1 rounded">
                                            {{ $article->category->name }}
                                        </span>
                                        <span class="text-sm text-gray-500">{{ $article->published_at->format('M d, Y') }}</span>
                                    </div>

                                    <h2 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-indigo-600 transition">
                                        {{ $article->title }}
                                    </h2>

                                    <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                                        {{ Str::limit(strip_tags($article->content), 150) }}
                                    </p>

                                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                        <div class="flex items-center text-sm text-gray-500">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            {{ $article->author->name }}
                                        </div>
                                        <span class="text-indigo-600 font-medium text-sm group-hover:gap-2 inline-flex items-center gap-1 transition-all">
                                            Read more
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $articles->links() }}
                </div>
            @else
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-gray-600 text-lg">No articles found.</p>
                </div>
            @endif
        </main>
    </div>
</div>
@endsection
