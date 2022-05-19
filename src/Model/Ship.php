<?php

declare(strict_types=1);

namespace App\Model;

class Ship extends AbstractShip
{
    private int $jediFactor = 0;

    private bool $underRepair;

    public function __construct(int $id, string $name)
    {
        parent::__construct($id, $name);

        $this->underRepair = mt_rand(1, 100) < 30;
    }

    public function setJediFactor(int $jediFactor): void
    {
        $this->jediFactor = $jediFactor;
    }

    public function getJediFactor(): int
    {
        return $this->jediFactor;
    }

    public function isFunctional(): bool
    {
        return !$this->underRepair;
    }
}
