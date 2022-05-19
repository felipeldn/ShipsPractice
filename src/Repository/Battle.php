<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\BattleDecider;
use App\Model\Fleet;

class Battle
{
    private BattleDecider $battleOutcome;

    public function __construct(BattleDecider $battleOutcome)
    {
        $this->battleOutcome = $battleOutcome;
    }

    public function fight(Fleet $fleet1, Fleet $fleet2): Outcome
    {
        $fleet1Health = $fleet1->getFleetHealth();
        $fleet2Health = $fleet2->getFleetHealth();

        while ($fleet1Health > 0 && $fleet2Health > 0) {
            // first, see if we have a rare Jedi hero event!
            $fleet1->useJediForce($fleet2);
            $fleet2->useJediForce($fleet1);

            // now battle them normally
            $fleet1->damage($fleet2);
            $fleet2->damage($fleet1);

            $fleet1Health = $fleet1->getFleetHealth();
            $fleet2Health = $fleet2->getFleetHealth();
        }
        return $this->battleOutcome->outcome($fleet1, $fleet2);
    }
}