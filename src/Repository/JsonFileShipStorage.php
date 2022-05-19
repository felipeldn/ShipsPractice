<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\AbstractShip;
use App\Model\RebelShip;
use App\Model\Ship;
use App\Model\Ships;

class JsonFileShipStorage implements ShipStorage
{
    private string $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function fetchAllShipsData(): Ships
    {
        $jsonContents = file_get_contents($this->fileName);

        $shipsData = json_decode($jsonContents, true);

        $ships = new Ships();
        foreach ($shipsData as $shipData) {
            if ($shipData['team'] == 'Rebel') {
                $ship = new RebelShip((int) $shipData['id'], $shipData['name']);
            } else {
                $ship = new Ship((int) $shipData['id'], $shipData['name']);
                $ship->setJediFactor((int) $shipData['jedi_factor']);
            }

            $ship->setWeaponPower((int) $shipData['weapon_power']);
            $ship->setStrength((int) $shipData['strength']);
            $ship->setTeam((string) $shipData['team']);

            $ships->add($ship);
        }
        return $ships;
    }

    public function fetchSingleShipData(int $id): ?AbstractShip
    {
        $ships = $this->fetchAllShipsData();

        foreach ($ships as $ship) {
            if ((int) $ship['id'] === $id) {
                $constructedShip =  new Ship(
                    $ship['id'],
                    $ship['name'],
                );

                $constructedShip->setWeaponPower((int) $ship['weapon_power']);
                $constructedShip->setJediFactor((int) $ship['jedi_factor']);
                $constructedShip->setStrength((int) $ship['strength']);
                $constructedShip->setTeam((string) $ship['team']);

                return $constructedShip;
            }
        }

        return null;
    }
}
