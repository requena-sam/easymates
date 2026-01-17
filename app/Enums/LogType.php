<?php

namespace App\Enums;

enum LogType: string
{
    case DELETION = 'deletion';
    case REPORT = 'report';
    case USER_ROLE = 'user_role';

    public function getMessage(array $data): string
    {
        return match ($this) {
            self::DELETION => "a supprimé {$data['item_type']} #{$data['item_id']}",
            self::REPORT => "a traité le signalement #{$data['report_id']}",
            self::USER_ROLE => "a mis à jour le rôle de {$data['target_name']} (#{$data['target_id']})",
        };
    }
}
