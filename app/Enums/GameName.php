<?php

namespace App\Enums;

enum GameName: string
{
    case LEAGUE_OF_LEGENDS = 'League of Legends';
    case COUNTER_STRIKE_2 = 'Counter-Strike 2';
    case VALORANT = 'Valorant';
    case VALORANT_GAME_CHANGER = 'Valorant GC';
    case FORTNITE = 'Fortnite';
    case ROCKET_LEAGUE = 'Rocket League';
    case CALL_OF_DUTY = 'Call of Duty';
    case AGE_OF_EMPIRES = 'Age of Empires';
    case TEAM_FIGHT_TACTICS = 'Team Fight Tactics';
    case TWO_XKO = '2XKO';


    public static function random(): self
    {
        $cases = self::cases();
        return $cases[array_rand($cases)];
    }


    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
