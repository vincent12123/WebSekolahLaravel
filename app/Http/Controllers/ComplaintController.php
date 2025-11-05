<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function create()
    {
        return view('complaints.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'category' => 'required|max:255',
            'subject' => 'required|max:255',
            'message' => 'required'
        ]);

        $validated['status'] = 'new';

        Complaint::create($validated);

        return back()->with('success', 'Your complaint has been submitted successfully. We will review it soon.');
    }
}
