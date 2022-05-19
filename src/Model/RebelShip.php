<?php

declare(strict_types=1);

namespace App\Model;

class RebelShip extends AbstractShip
{
    public function isFunctional(): bool
    {
        return true;
    }

    public function getJediFactor(): int
    {
        return rand(10, 30);
    }
}