<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use Illuminate\Http\Request;

class ExtracurricularController extends Controller
{
    public function index()
    {
        $extracurriculars = Extracurricular::with('galleryAlbum')->get();
        return view('extracurriculars.index', compact('extracurriculars'));
    }

    public function show(Extracurricular $extracurricular)
    {
        $extracurricular->load('galleryAlbum.photos');
        return view('extracurriculars.show', compact('extracurricular'));
    }
}
