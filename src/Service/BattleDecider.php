<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Fleet;

class BattleDecider
{
    public function outcome(Fleet $fleet1, Fleet $fleet2): Outcome
    {
        $fleet1Health = $fleet1->getFleetHealth();
        $fleet2Health = $fleet2->getFleetHealth();

        if ($fleet1Health <= 0 && $fleet2Health <= 0) {
            // they destroyed each other
            return new Outcome();
        } elseif ($fleet1Health <= 0) {
            return new Outcome($fleet2, $fleet1);
        } else {
            return new Outcome($fleet1, $fleet2);
        }
    }
}