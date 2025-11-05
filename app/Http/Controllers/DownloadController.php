<?php

namespace App\Http\Controllers;

use App\Models\DownloadFile;
use App\Models\DownloadCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function index(Request $request)
    {
        $query = DownloadFile::with('category');

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('file_name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $files = $query->latest()->paginate(15);
        $categories = DownloadCategory::withCount('files')->get();

        return view('downloads.index', compact('files', 'categories'));
    }

    public function category(DownloadCategory $category)
    {
        $files = $category->files()->with('category')->latest()->paginate(15);
        $categories = DownloadCategory::withCount('files')->get();

        return view('downloads.category', compact('files', 'category', 'categories'));
    }
}
