<?php

namespace Interfaces\Entities;

use Spaceship;

interface IFleet
{
    public function __construct(string $FleetName);
    public function AddShip(Spaceship $spaceship ) : void;
    public function removeDeadShips(): void;
    public function removeShip(Spaceship $shipToRemove): void;
    public function getShips(): int;
    public function getRandomAliveShip(): Spaceship;
    public function hasAvailableShip(): bool;
    public function getFleetName(): string;
    public function setFleetName(string $FleetName): void;
    public function getLostShips(): array;
}