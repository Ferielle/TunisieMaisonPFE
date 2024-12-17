<?php

use Illuminate\Support\Facades\Cache;

class KonnectService {
    protected $apiUrl;
    protected $apiKey;

    public function __construct() {
        $this->apiUrl = env('KONNECT_API_URL');
        $this->apiKey = env('KONNECT_API_KEY');
    }

    public function getCachedData($endpoint, $params = [], $cacheKey, $ttl = 3600) {
        return Cache::remember($cacheKey, $ttl, function() use ($endpoint, $params) {
            return $this->getData($endpoint, $params);
        });
    }

    public function getData($endpoint, $params = []) {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->get($this->apiUrl . $endpoint, $params);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('API Error: ' . $response->body());
    }
}
