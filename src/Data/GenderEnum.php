<?php

declare (strict_types=1);

namespace Orm\Entity\Data;

enum GenderEnum: int
{
    case MALE = 1;
    case FEMALE = 2;

    public function text(): string
    {
        return match ($this) {
            self::MALE => 'Mr.',
            self::FEMALE => 'Ms.'
        };
    }
}
