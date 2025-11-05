@extends('layouts.app')

@section('title', $job->title . ' - Job Opening')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <a href="{{ route('jobs.index') }}" class="text-indigo-600 hover:text-indigo-700 font-medium inline-flex items-center gap-2 mb-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Job Openings
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-8">
        <div class="p-8">
            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $job->title }}</h1>
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                        @if($job->department)
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                {{ $job->department }}
                            </span>
                        @endif
                        <span class="inline-flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            {{ ucfirst($job->type) }}
                        </span>
                        @if($job->location)
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $job->location }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="flex flex-col items-end gap-2">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold {{ $job->status === 'open' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($job->status) }}
                    </span>
                    @if($job->deadline)
                        <span class="text-sm text-gray-500">
                            Apply by: {{ $job->deadline->format('M d, Y') }}
                        </span>
                    @endif
                </div>
            </div>

            @if($job->salary_range)
                <div class="bg-indigo-50 rounded-lg p-4 mb-6">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold text-indigo-900">Salary Range:</span>
                        <span class="text-indigo-700">{{ $job->salary_range }}</span>
                    </div>
                </div>
            @endif

            <div class="prose max-w-none mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Job Description</h2>
                <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $job->description }}</p>
            </div>

            @if($job->requirements)
                <div class="prose max-w-none mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Requirements</h2>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $job->requirements }}</p>
                </div>
            @endif

            @if($job->responsibilities)
                <div class="prose max-w-none mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Responsibilities</h2>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $job->responsibilities }}</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Application Form -->
    @if($job->status === 'open' && (!$job->deadline || $job->deadline >= now()))
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Apply for this Position</h2>

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('jobs.apply', $job) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required class="w-full px-4 py-2 border @error('phone') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('phone')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="cv" class="block text-sm font-medium text-gray-700 mb-2">Upload CV/Resume (PDF only, max 2MB) *</label>
                    <input type="file" id="cv" name="cv" accept=".pdf" required class="w-full px-4 py-2 border @error('cv') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('cv')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-sm text-gray-500 mt-1">Please upload your CV in PDF format (maximum 2MB)</p>
                </div>

                <div>
                    <label for="cover_letter" class="block text-sm font-medium text-gray-700 mb-2">Cover Letter</label>
                    <textarea id="cover_letter" name="cover_letter" rows="6" class="w-full px-4 py-2 border @error('cover_letter') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ old('cover_letter') }}</textarea>
                    @error('cover_letter')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-700 transition font-medium">
                        Submit Application
                    </button>
                    <p class="text-sm text-gray-500">* Required fields</p>
                </div>
            </form>
        </div>
    @else
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-8 text-center">
            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            <p class="text-gray-600 text-lg font-medium">Applications are currently closed</p>
            <p class="text-gray-500 text-sm mt-2">This position is no longer accepting applications.</p>
        </div>
    @endif
</div>
@endsection
