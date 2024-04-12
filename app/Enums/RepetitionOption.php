<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Values;

enum RepetitionOption: string
{
    use Names, Values, InvokableCases;

    case ByDate = 'ByDate';
    case ByIteration = 'ByIteration';

    public function isByDate(): bool
    {
        return $this === self::ByDate;
    }

    public function isByIteration(): bool
    {
        return $this === self::ByIteration;
    }

    public function getText(): string
    {
        return match ($this) {
            self::ByDate => 'By date',
            self::ByIteration => 'By iteration',
        };
    }
}
