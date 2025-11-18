<?php

namespace Entities;

use Spaceship;

class Fleet
{
    public string $FleetName;
    public array $Ships;
    public array $LostShips;

    public function __construct(string $FleetName)
    {
        $this->FleetName = $FleetName;
        $this->Ships = [];
        $this->LostShips = [];
    }

    public function AddShip(Spaceship $spaceship ) : void
    {
        $this->Ships[] = $spaceship;
    }

    public function removeDeadShips(): void
    {
        $activeShips = [];
        foreach ($this->Ships as $key => $ship) {
            if ($ship->Hitpoints <= 0) {
                $this->LostShips[] = $ship;
            } else {
                $activeShips[] = $ship;
            }
        }
        $this->Ships = $activeShips;
    }

    public function getShips(): int
    {
        $active_ships = array_filter($this->Ships, function($ship) {
            return $ship->Hitpoints > 0;
        });
        return count($active_ships);
    }

    public function getAvailableShip(): Spaceship
    {
        $active_ships = array_filter($this->Ships, function($ship) {
            return $ship->Hitpoints > 0;
        });

        if (empty($active_ships)) {
            throw new \Exception("Geen beschikbaar schip gevonden in de vloot.");
        }

        $random_index = array_rand($active_ships);
        return $active_ships[$random_index];
    }

    public function getFleetName(): string
    {
        return $this->FleetName;
    }

    public function setFleetName(string $FleetName): void
    {
        $this->FleetName = $FleetName;
    }

    public function getLostShips(): array
    {
        return $this->LostShips;
    }
}