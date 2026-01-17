<?php

namespace App\Enums;

enum ReportReason: string
{
    case SPAM = 'spam';
    case INAPPROPRIATE = 'inappropriate';
    case HARASSMENT = 'harassment';
    case FAKE = 'fake';
    case OFFENSIVE = 'offensive';
    case COPYRIGHT = 'copyright';
    case OTHER = 'other';

    public function label(): string
    {
        return match($this) {
            self::SPAM => 'Spam ou publicité',
            self::INAPPROPRIATE => 'Contenu inapproprié',
            self::HARASSMENT => 'Harcèlement',
            self::FAKE => 'Fausse information',
            self::OFFENSIVE => 'Contenu offensant',
            self::COPYRIGHT => 'Violation de droits d\'auteur',
            self::OTHER => 'Autre',
        };
    }
}
