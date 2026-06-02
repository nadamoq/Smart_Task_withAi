<?php

namespace App\Enums;

enum Priority :string
{
    //
    case LOW = 'low';
    case MED = 'med';
    case HIGH = 'high';

    public function color(): string
    {
        return match ($this) {
            self::LOW => 'bg-primary-fixed-dim/20 text-primary',
            self::MED => 'bg-tertiary-fixed text-on-tertiary-fixed-variant ',
            self::HIGH => ' bg-secondary-fixed text-red-500',
        };
    }
    public function icons(): string
    {
        return match ($this) {
            self::LOW => 'keyboard_double_arrow_down',
            self::MED => 'remove',
            self::HIGH => 'keyboard_double_arrow_up',
        };
    }

}
