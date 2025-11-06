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

            $upcomingEvents = \App\Models\Event::query()
                ->where(function($q){
                    $q->whereNull('published_at')->orWhere('published_at', '<=', now());
                })
                ->where('starts_at', '>=', now()->startOfDay())
                ->orderBy('starts_at')
                ->take(6)
                ->get();

    // Optional configurable hero image via config('app.hero_image_url') or env('HERO_IMAGE_URL')
    $heroImageUrl = config('app.hero_image_url', env('HERO_IMAGE_URL'));

    // Read school name from settings once (avoid querying in Blade)
    $schoolName = optional(\App\Models\Setting::first())->nama_sekolah ?? config('app.name');

            return view('home', compact('latestAnnouncements', 'latestArticles', 'featuredAlbums', 'upcomingEvents', 'heroImageUrl', 'schoolName'));
    }
}
