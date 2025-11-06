@extends('layouts.app')

@section('title', 'Kirim Pengaduan - ' . config('app.name'))

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Kirim Pengaduan</h1>
        <p class="text-gray-600">Kami menghargai masukan Anda dan berkomitmen menindaklanjuti setiap pengaduan. Silakan isi formulir di bawah ini untuk mengirim pengaduan atau masukan.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-8">
            <div class="flex items-start gap-3">
                <svg class="w-6 h-6 text-green-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h3 class="text-green-900 font-semibold mb-1">Pengaduan Berhasil Dikirim</h3>
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
        <form method="POST" action="{{ route('complaints.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('name') border-red-500 @else border-gray-300 @enderror">
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Alamat Email *</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('email') border-red-500 @else border-gray-300 @enderror">
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('phone') border-red-500 @else border-gray-300 @enderror">
                @error('phone')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                <select id="category" name="category" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('category') border-red-500 @else border-gray-300 @enderror">
                    <option value="">Pilih kategori</option>
                    <option value="academic" @if(old('category') == 'academic') selected @endif>Akademik</option>
                    <option value="facilities" @if(old('category') == 'facilities') selected @endif>Fasilitas</option>
                    <option value="staff" @if(old('category') == 'staff') selected @endif>Perilaku Staf</option>
                    <option value="safety" @if(old('category') == 'safety') selected @endif>Keamanan & Keselamatan</option>
                    <option value="other" @if(old('category') == 'other') selected @endif>Lainnya</option>
                </select>
                @error('category')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subjek *</label>
                <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('subject') border-red-500 @else border-gray-300 @enderror" placeholder="Deskripsi singkat pengaduan Anda">
                @error('subject')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Pesan Lengkap *</label>
                <textarea id="message" name="message" rows="8" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('message') border-red-500 @else border-gray-300 @enderror" placeholder="Mohon jelaskan pengaduan Anda sedetail mungkin...">{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex gap-3">
                    <svg class="w-5 h-5 text-blue-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="text-sm text-blue-800">
                        <p class="font-semibold mb-1">Pemberitahuan Privasi</p>
                        <p>Informasi pribadi Anda akan dijaga kerahasiaannya dan hanya digunakan untuk keperluan penanganan pengaduan. Kami akan merespons pengaduan Anda dalam 5 hari kerja.</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4 pt-4">
                <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-700 transition font-medium inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    Kirim Pengaduan
                </button>
                <p class="text-sm text-gray-500">* Wajib diisi</p>
            </div>
        </form>
    </div>

    <!-- Contact Information -->
    <div class="mt-8 bg-gray-50 rounded-lg p-6">
        @php($setting = \App\Models\Setting::first())
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Metode Kontak Alternatif</h3>
        <div class="space-y-3 text-sm text-gray-600">
            @if($setting && $setting->email_kontak)
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span>Email: {{ $setting->email_kontak }}</span>
                </div>
            @endif
            @if($setting && $setting->telepon)
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <span>Telepon: {{ $setting->telepon }}</span>
                </div>
            @endif
            @if($setting && ($setting->alamat || $setting->jam_operasional))
                <div class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-gray-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>
                        @if($setting->alamat)
                            Kantor: {{ $setting->alamat }}<br>
                        @endif
                        @if($setting->jam_operasional)
                            Buka: {{ $setting->jam_operasional }}
                        @endif
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
