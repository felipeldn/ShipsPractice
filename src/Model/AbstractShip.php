<?php

declare(strict_types=1);

namespace App\Model;

abstract class AbstractShip
{
    private int $id;

    private string $name;

    private int $weaponPower = 0;

    private int $strength = 0;

    private string $team;

    abstract public function getJediFactor(): int;

    abstract public function isFunctional(): bool;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setStrength(int $number): void
    {
        $this->strength = $number;
    }

    public function getStrength(): int
    {
        return $this->strength;
    }

    public function getNameAndSpecs($useShortFormat = false): string
    {
        if ($useShortFormat) {
            return sprintf(
                '%s: %s/%s/%s',
                $this->name,
                $this->weaponPower,
                $this->getJediFactor(),
                $this->strength,
            );
        }

        return sprintf(
            '%s: w:%s, j:%s, s:%s',
            $this->name,
            $this->weaponPower,
            $this->getJediFactor(),
            $this->strength
        );

    }

    public function getWeaponPower(): int
    {
        return $this->weaponPower;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setWeaponPower(int $weaponPower): void
    {
        $this->weaponPower = $weaponPower;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTeam(): string
    {
        return $this->team;
    }

    public function setTeam(string $team): void
    {
        $this->team = $team;
    }
}