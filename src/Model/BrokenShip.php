<?php

declare(strict_types=1);

namespace App\Model;

class BrokenShip extends AbstractShip
{
    private int $jediFactor = 0;

    public function getJediFactor(): int
    {
        return $this->jediFactor;
    }

    public function isFunctional(): bool
    {
        return false;
    }

    public function getTeam(): string
    {
        return 'Broken';
    }
}