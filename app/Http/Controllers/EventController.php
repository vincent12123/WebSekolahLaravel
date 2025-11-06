<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::query()
            ->where(function($q){
                $q->whereNull('published_at')->orWhere('published_at', '<=', now());
            })
            ->orderBy('starts_at')
            ->paginate(9);

        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }
}
