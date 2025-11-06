@extends('layouts.app')

@section('title', 'Lowongan Pekerjaan - ' . config('app.name'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Lowongan Pekerjaan</h1>
        <p class="text-gray-600">Bergabunglah dengan tim kami dan berkontribusi pada pendidikan</p>
    </div>

    @if($jobs->count())
        <div class="space-y-6">
            @foreach($jobs as $job)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-4">
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $job->title }}</h3>
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
                                        @php($typeMap = ['full_time' => 'Penuh Waktu', 'part_time' => 'Paruh Waktu', 'contract' => 'Kontrak', 'internship' => 'Magang', 'temporary' => 'Sementara'])
                                        {{ $typeMap[$job->type] ?? Str::headline($job->type) }}
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
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $job->status === 'open' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    @php($statusMap = ['open' => 'Dibuka', 'closed' => 'Ditutup'])
                                    {{ $statusMap[$job->status] ?? Str::headline($job->status) }}
                                </span>
                                @if($job->deadline)
                                    <span class="text-sm text-gray-500">
                                        Batas Lamaran: {{ $job->deadline->translatedFormat('d F Y') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <p class="text-gray-700 mb-4 line-clamp-3">{{ Str::limit(strip_tags($job->description), 160) }}</p>

                        @if($job->requirements)
                            <div class="mb-4">
                                <h4 class="font-semibold text-gray-900 text-sm mb-2">Persyaratan Utama:</h4>
                                <p class="text-sm text-gray-600 line-clamp-2">{{ Str::limit(strip_tags($job->requirements), 160) }}</p>
                            </div>
                        @endif

                        @if($job->salary_range)
                            <div class="mb-4">
                                <span class="inline-flex items-center gap-1 text-sm text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="font-medium">Kisaran Gaji: {{ $job->salary_range }}</span>
                                </span>
                            </div>
                        @endif

                        <div class="flex items-center gap-3 pt-4 border-t border-gray-200">
                            <a href="{{ route('jobs.show', $job) }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition font-medium">
                                Lihat Detail & Lamar
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                            <span class="text-xs text-gray-500">Diposting {{ $job->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $jobs->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            <p class="text-gray-600 text-lg">Belum ada lowongan pekerjaan saat ini.</p>
            <p class="text-gray-500 text-sm mt-2">Silakan cek kembali di lain waktu untuk kesempatan baru.</p>
        </div>
    @endif
</div>
@endsection
