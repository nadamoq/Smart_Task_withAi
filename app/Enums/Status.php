<?php

namespace App\Enums;

enum Status :string
{
    //
    case PENDING = 'pending';
    case COMPLETED = 'completed';   
    case IN_PROGRESS = 'in_progress';

    public function color(): string
    {
        return match ($this) {
             self::PENDING => 'bg-gray-100 text-gray-800',
            self::IN_PROGRESS => 'bg-blue-100 text-blue-800',
            self::COMPLETED => 'bg-emerald-100 text-emerald-800 ',
        };
    }
    public function icons(): string
    {
        return match ($this) {
            self::PENDING => 'sync',
            self::IN_PROGRESS => 'autorenew',
            self::COMPLETED => 'done_all',
        };
    }
}
