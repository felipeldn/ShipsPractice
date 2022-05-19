<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\AbstractShip;
use App\Model\Fleet;

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

    public function getWinner(): ?AbstractShip
    {
        return $this->winner->getShip();
    }

    public function getLoser(): ?AbstractShip
    {
        return $this->loser->getShip();
    }

    public function wasForceUsed(): bool
    {
        return $this->winner->wasJediForceUsed();
    }
}