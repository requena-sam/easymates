<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TwitchService
{
    private string $clientId;
    private string $clientSecret;
    private string $baseUrl = 'https://api.twitch.tv/helix';

    public function __construct()
    {
        $this->clientId = config('services.twitch.client_id');
        $this->clientSecret = config('services.twitch.client_secret');
    }


    private function getAccessToken(): ?string
    {
        return Cache::remember('twitch_access_token', 3600, function () {
            try {
                $response = Http::post('https://id.twitch.tv/oauth2/token', [
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'grant_type' => 'client_credentials'
                ]);

                if ($response->successful()) {
                    return $response->json()['access_token'];
                }

                Log::error('Twitch Token Error', ['response' => $response->body()]);
                return null;
            } catch (\Exception $e) {
                Log::error('Twitch Token Exception', ['error' => $e->getMessage()]);
                return null;
            }
        });
    }

    public function getUserStream(string $username): ?array
    {
        $token = $this->getAccessToken();

        if (!$token) {
            return null;
        }

        try {
            $response = Http::withHeaders([
                'Client-ID' => $this->clientId,
                'Authorization' => "Bearer {$token}"
            ])->get("{$this->baseUrl}/streams", [
                'user_login' => $username
            ]);

            if ($response->successful()) {
                $data = $response->json();

                // Si le stream existe
                if (!empty($data['data'])) {
                    $stream = $data['data'][0];
                    return [
                        'is_streaming' => true,
                        'viewer_count' => $stream['viewer_count'],
                        'stream_title' => $stream['title'],
                        'game_name' => $stream['game_name'] ?? null,
                        'started_at' => $stream['started_at']
                    ];
                }

                return [
                    'is_streaming' => false,
                    'viewer_count' => 0,
                    'stream_title' => null,
                    'game_name' => null,
                    'started_at' => null
                ];
            }

            Log::error('Twitch API Error', [
                'username' => $username,
                'response' => $response->body()
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('Twitch Stream Check Exception', [
                'username' => $username,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    public function getMultipleStreams(array $usernames): array
    {
        $token = $this->getAccessToken();

        if (!$token || empty($usernames)) {
            return [];
        }

        try {
            $chunks = array_chunk($usernames, 100);
            $results = [];

            foreach ($chunks as $chunk) {
                $response = Http::withHeaders([
                    'Client-ID' => $this->clientId,
                    'Authorization' => "Bearer {$token}"
                ])->get("{$this->baseUrl}/streams", [
                    'user_login' => $chunk
                ]);

                if ($response->successful()) {
                    $data = $response->json();

                    foreach ($data['data'] as $stream) {
                        $results[$stream['user_login']] = [
                            'is_streaming' => true,
                            'viewer_count' => $stream['viewer_count'],
                            'stream_title' => $stream['title'],
                            'game_name' => $stream['game_name'] ?? null,
                            'started_at' => $stream['started_at']
                        ];
                    }
                }
            }

            foreach ($usernames as $username) {
                if (!isset($results[$username])) {
                    $results[$username] = [
                        'is_streaming' => false,
                        'viewer_count' => 0,
                        'stream_title' => null,
                        'game_name' => null,
                        'started_at' => null
                    ];
                }
            }

            return $results;
        } catch (\Exception $e) {
            Log::error('Twitch Multiple Streams Exception', [
                'error' => $e->getMessage()
            ]);
            return [];
        }
    }
}
