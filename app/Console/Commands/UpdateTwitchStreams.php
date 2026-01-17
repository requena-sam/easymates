<?php

namespace App\Console\Commands;

use App\Models\Player;
use App\Services\TwitchService;
use Illuminate\Console\Command;

class UpdateTwitchStreams extends Command
{
    protected $signature = 'twitch:update-streams';

    public function handle(TwitchService $twitchService): int
    {
        $players = Player::whereNotNull('twitch')->get();

        if ($players->isEmpty()) {
            return self::SUCCESS;
        }

        $streams = $twitchService->getMultipleStreams(
            $players->pluck('twitch')->toArray()
        );

        foreach ($players as $player) {
            if (!isset($streams[$player->twitch])) {
                continue;
            }

            $player->update([
                'is_streaming'  => $streams[$player->twitch]['is_streaming'],
                'viewer_count'  => $streams[$player->twitch]['viewer_count'],
            ]);
        }
        return self::SUCCESS;
    }
}
