<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Fleet;
use App\Model\Ship;

class Outcome
{
    private Fleet $winner;
    private Fleet $loser;

    public function __construct(
        ?Fleet $winner = null,
        ?Fleet $loser = null
    ) {
        $this->winner = $winner;
        $this->loser = $loser;
    }

    public function getWinner(): Ship
    {
        return $this->winner->getShip();
    }

    public function getLoser(): Ship
    {
        return $this->loser->getShip();
    }

    public function wasForceUsed(): bool
    {
        return $this->winner->wasJediForceUsed();
    }
}