<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\AbstractShip;
use App\Model\Ships;

class ShipLoader
{
    private ShipStorage $shipStorage;

    public function __construct(ShipStorage $shipStorage)
    {
        $this->shipStorage = $shipStorage;
    }

    public function load(): Ships
    {
        return $this->shipStorage->fetchAllShipsData();
    }

    public function findOneById(int $id): ?AbstractShip
    {
        return $this->shipStorage->fetchSingleShipData($id);
    }
}