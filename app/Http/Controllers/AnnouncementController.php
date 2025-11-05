<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $query = Announcement::where('published_at', '<=', now());

        if ($request->has('important') && $request->important === '1') {
            $query->where('is_important', true);
        }

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        $announcements = $query->orderBy('is_important', 'desc')
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('announcements.index', compact('announcements'));
    }

    public function show(Announcement $announcement)
    {
        if ($announcement->published_at > now()) {
            abort(404);
        }

        return view('announcements.show', compact('announcement'));
    }
}
