<?php

declare(strict_types=1);

namespace App\Model;

class Ships
{
    private array $ships;

    public function __construct()
    {
        $this->ships = [];
    }

    public function add(AbstractShip $ship): void
    {
        if (in_array($ship, $this->ships)) {
            return;
        }

        $this->ships[] = $ship;
    }

    /**
     * @return array<Ship>
     */
    public function getShips(): array
    {
        return $this->ships;
    }
}