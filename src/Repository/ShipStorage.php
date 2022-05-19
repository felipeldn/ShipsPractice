<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\AbstractShip;
use App\Model\Ships;

interface ShipStorage
{
    public function fetchAllShipsData(): Ships;

    public function fetchSingleShipData(int $id): ?AbstractShip;
}