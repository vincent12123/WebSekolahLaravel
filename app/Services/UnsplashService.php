<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class UnsplashService
{
	/**
	 * Search Unsplash photos.
	 *
	 * @return array<int, array{ id:string, url:string, thumb:string, alt:string|null, author:string|null, link:string|null }>
	 */
	public function search(string $query, int $perPage = 6): array
	{
		$accessKey = config('services.unsplash.access_key');
		$endpoint = rtrim(config('services.unsplash.endpoint'), '/');

		if (!$accessKey) {
			throw new \RuntimeException('UNSPLASH_ACCESS_KEY is not configured');
		}

		$resp = Http::withHeaders([
			'Accept-Version' => 'v1',
			'Authorization' => 'Client-ID ' . $accessKey,
		])->get($endpoint . '/search/photos', [
			'query' => $query,
			'per_page' => max(1, min($perPage, 30)),
			'orientation' => 'landscape',
		]);

		if ($resp->failed()) {
			throw new \RuntimeException('Unsplash API error: ' . $resp->status() . ' ' . $resp->body());
		}

		$results = [];
		foreach ((array) data_get($resp->json(), 'results', []) as $item) {
			$results[] = [
				'id' => (string) data_get($item, 'id'),
				'url' => (string) data_get($item, 'urls.regular'),
				'thumb' => (string) data_get($item, 'urls.thumb'),
				'alt' => data_get($item, 'alt_description'),
				'author' => data_get($item, 'user.name'),
				'link' => data_get($item, 'links.html'),
			];
		}

		return $results;
	}

	/** Get the first search result (if any). */
	public function searchOne(string $query): ?array
	{
		$list = $this->search($query, 1);
		return $list[0] ?? null;
	}

	/**
	 * Download a remote image URL to the public disk and return the stored relative path.
	 */
	public function downloadToPublic(string $url, string $directory = 'articles', ?string $filename = null): string
	{
		$response = Http::timeout(60)->get($url);
		if ($response->failed()) {
			throw new \RuntimeException('Failed to download image from Unsplash URL.');
		}

		$mime = $response->header('Content-Type') ?? 'image/jpeg';
		$ext = match (true) {
			str_contains($mime, 'png') => 'png',
			str_contains($mime, 'webp') => 'webp',
			str_contains($mime, 'gif') => 'gif',
			default => 'jpg',
		};

		$name = $filename ?: (uniqid('unsplash_') . '.' . $ext);
		$path = trim($directory, '/').'/'.$name;

		Storage::disk('public')->put($path, $response->body());

		return $path;
	}
}

