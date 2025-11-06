<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AiArticleService
{
    public function improveDraft(string $draft): array
    {
        $apiKey = config('services.gemini.api_key');
        $model = config('services.gemini.model');
        $endpoint = rtrim(config('services.gemini.endpoint'), '/');

        if (!$apiKey) {
            throw new \RuntimeException('GEMINI_API_KEY is not configured');
        }

        $prompt = <<<PROMPT
Anda adalah penulis artikel blog profesional. Tugas Anda adalah menyempurnakan artikel berikut agar lebih menarik, informatif, dan mudah dibaca.

Petunjuk perbaikan:
- Perbaiki struktur kalimat dan paragraf agar lebih mengalir
- Tambahkan detail dan penjelasan yang relevan jika diperlukan
- Pastikan penggunaan Bahasa Indonesia yang baik dan benar
- Buat konten lebih engaging dengan gaya penulisan yang natural
- Perbaiki tata bahasa, ejaan, dan tanda baca
- Pertahankan format HTML yang sudah ada (jangan hapus tag HTML)
- Jangan ubah makna atau inti dari artikel

Kembalikan HANYA konten artikel yang sudah diperbaiki dalam format HTML. Jangan tambahkan penjelasan apapun di luar konten artikel.

Draf artikel yang perlu diperbaiki:
{$draft}
PROMPT;

        $url = "$endpoint/$model:generateContent?key=" . urlencode($apiKey);

        $payload = [
            'contents' => [
                ['parts' => [['text' => $prompt]]],
            ],
            'generationConfig' => [
                'temperature' => 0.7,
                'topP' => 0.9,
                'topK' => 40,
            ],
        ];

        $resp = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->timeout(60)->post($url, $payload);

        if ($resp->failed()) {
            throw new \RuntimeException('Gemini API error: ' . $resp->status() . ' ' . $resp->body());
        }

        $improvedContent = data_get($resp->json(), 'candidates.0.content.parts.0.text');

        if (!is_string($improvedContent) || $improvedContent === '') {
            throw new \RuntimeException('Gemini returned empty result');
        }

        // Bersihkan markdown code blocks jika ada
        // Hapus baris pembuka/penutup kode seperti ``` atau ```lang
        $improvedContent = preg_replace('/^\s*```.*$/m', '', $improvedContent);
        $improvedContent = trim($improvedContent);

        return [
            'content' => $improvedContent,
            'excerpt' => Str::limit(strip_tags($improvedContent), 180),
        ];
    }
}
