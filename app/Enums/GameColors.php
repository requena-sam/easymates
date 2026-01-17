<?php

namespace App\Enums;

enum GameColors: string
{
    case VALORANT = 'from-red-500 to-pink-600';
    case ROCKET_LEAGUE = 'from-blue-500 to-cyan-600';
    case LEAGUE_OF_LEGENDS = 'from-purple-500 to-indigo-600';
    case FORTNITE = 'from-yellow-500 to-orange-600';
    case CALL_OF_DUTY = 'from-orange-500 to-red-600';
    case COUNTER_STRIKE = 'from-gray-700 to-gray-900';

    public static function getColor(string $gameName): string
    {
        return match (strtoupper(str_replace([' ', '-', '_'], '_', $gameName))) {
            'VALORANT' => self::VALORANT->value,
            'ROCKET_LEAGUE', 'ROCKET-LEAGUE' => self::ROCKET_LEAGUE->value,
            'LEAGUE_OF_LEGENDS', 'LOL', 'LEAGUE-OF-LEGENDS' => self::LEAGUE_OF_LEGENDS->value,
            'FORTNITE' => self::FORTNITE->value,
            'CALL_OF_DUTY', 'CALL-OF-DUTY' => self::CALL_OF_DUTY->value,
            'COUNTER_STRIKE_2', 'CS', 'CS2', 'COUNTER-STRIKE-2' => self::COUNTER_STRIKE->value,
            default => 'from-pink-500 to-pink-700',
        };
    }
}
