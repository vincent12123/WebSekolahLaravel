<?php

namespace App\Http\Controllers;

use App\Models\GalleryAlbum;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = GalleryAlbum::with(['photos' => function($q) {
                $q->take(1);
            }])
            ->withCount('photos')
            ->latest('event_date')
            ->paginate(12);

        return view('gallery.index', compact('albums'));
    }

    public function show(GalleryAlbum $album)
    {
        $album->load('photos');
        return view('gallery.show', compact('album'));
    }
}
