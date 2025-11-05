<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::where('status', 'published')
            ->where('published_at', '<=', now())
            ->with(['author', 'category']);

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        $articles = $query->latest('published_at')->paginate(12);
        $categories = Category::withCount('articles')->get();

        return view('articles.index', compact('articles', 'categories'));
    }

    public function category(Category $category)
    {
        $articles = Article::where('status', 'published')
            ->where('published_at', '<=', now())
            ->where('category_id', $category->id)
            ->with(['author', 'category'])
            ->latest('published_at')
            ->paginate(12);

        $categories = Category::withCount('articles')->get();

        return view('articles.category', compact('articles', 'category', 'categories'));
    }

    public function show(Article $article)
    {
        if ($article->status !== 'published' || $article->published_at > now()) {
            abort(404);
        }

        $article->load(['author', 'category', 'comments' => function($q) {
            $q->where('status', 'approved')
              ->whereNull('parent_id')
              ->with(['replies' => function($r) {
                  $r->where('status', 'approved');
              }])
              ->latest();
        }]);

        $relatedArticles = Article::where('status', 'published')
            ->where('id', '!=', $article->id)
            ->where('category_id', $article->category_id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }

    public function storeComment(Request $request, Article $article)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $validated['article_id'] = $article->id;
        $validated['status'] = 'pending';

        Comment::create($validated);

        return back()->with('success', 'Your comment has been submitted and is awaiting moderation.');
    }
}
