<?php

declare(strict_types=1);

namespace App\Model;

class Fleet
{
    private AbstractShip $ship;

    private int $numberOfShips;

    private int $damage;

    private bool $jediForceWasUsed;

    public function __construct(AbstractShip $ship, int $numberOfShips)
    {
        $this->ship = $ship;
        $this->numberOfShips = $numberOfShips;
        $this->damage = 0;
        $this->jediForceWasUsed = false;
    }

    public function getShip(): AbstractShip
    {
        return $this->ship;
    }

    public function getNumberOfShips(): int
    {
        return $this->numberOfShips;
    }

    public function getFleetHealth(): int
    {
        return $this->ship->getStrength() * $this->numberOfShips - $this->damage;
    }

    public function damage(Fleet $enemyFleet): void
    {
        $enemyFleet->damage += $this->ship->getWeaponPower() * $this->numberOfShips;
    }

    public function canFleetUseTheForce(): bool
    {
        $jediHeroProbability = $this->ship->getJediFactor() / 100;

        return random_int(1, 100) <= ($jediHeroProbability*100);
    }

    public function useJediForce(Fleet $enemyFleet): void
    {
        if (!$this->canFleetUseTheForce()) {
            return;
        }

        $enemyFleet->damage += $enemyFleet->ship->getStrength() * $enemyFleet->numberOfShips;
        $this->jediForceWasUsed = true;
    }

    public function wasJediForceUsed(): bool
    {
        return $this->jediForceWasUsed;
    }
}