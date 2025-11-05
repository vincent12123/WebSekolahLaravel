<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index()
    {
        $jobs = JobListing::where('status', 'open')
            ->where('deadline', '>=', now())
            ->latest()
            ->paginate(10);

        return view('jobs.index', compact('jobs'));
    }

    public function show(JobListing $job)
    {
        if ($job->status !== 'open' || $job->deadline < now()) {
            return redirect()->route('jobs.index')->with('error', 'This job posting is no longer available.');
        }

        return view('jobs.show', compact('job'));
    }

    public function apply(Request $request, JobListing $job)
    {
        if ($job->status !== 'open' || $job->deadline < now()) {
            return back()->with('error', 'This job posting is no longer available.');
        }

        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:20',
            'cv_file' => 'required|file|mimes:pdf|max:2048',
            'cover_letter' => 'nullable|string'
        ]);

        if ($request->hasFile('cv_file')) {
            $validated['cv_file_url'] = $request->file('cv_file')->store('job-applications', 'public');
        }

        $validated['job_listing_id'] = $job->id;
        $validated['status'] = 'new';

        JobApplication::create($validated);

        return back()->with('success', 'Your application has been submitted successfully!');
    }
}
