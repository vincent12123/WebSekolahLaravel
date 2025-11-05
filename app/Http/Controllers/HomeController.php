<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Article;
use App\Models\GalleryAlbum;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latestAnnouncements = Announcement::where('published_at', '<=', now())
            ->orderBy('is_important', 'desc')
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        $latestArticles = Article::where('status', 'published')
            ->where('published_at', '<=', now())
            ->with(['author', 'category'])
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get();

        $featuredAlbums = GalleryAlbum::with(['photos' => function($q) {
                $q->take(4);
            }])
            ->latest('event_date')
            ->take(4)
            ->get();

        return view('home', compact('latestAnnouncements', 'latestArticles', 'featuredAlbums'));
    }
}
