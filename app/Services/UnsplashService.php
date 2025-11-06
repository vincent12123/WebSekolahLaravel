<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

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
}

