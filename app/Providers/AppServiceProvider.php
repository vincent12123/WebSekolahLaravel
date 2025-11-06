<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Stephenjude\FilamentBlog\Models\Post as BlogPost;
use App\Observers\BlogPostObserver;
use App\Models\GalleryAlbum;
use App\Models\Extracurricular;
use App\Models\DownloadFile;
use App\Models\Category;
use App\Models\Article;
use App\Observers\SlugObserver;
use App\Observers\DownloadFileObserver;
use App\Models\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    // Auto-slug for blog posts
    BlogPost::observe(BlogPostObserver::class);

    // Auto-slug for album & extracurricular
    GalleryAlbum::observe(SlugObserver::class);
    Extracurricular::observe(SlugObserver::class);
    Category::observe(SlugObserver::class);
    Article::observe(SlugObserver::class);
    Event::observe(SlugObserver::class);

    // Auto file metadata for downloads
    DownloadFile::observe(DownloadFileObserver::class);
    }
}
