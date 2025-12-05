<?php

namespace Interfaces\Entities;

use Canon;
use Spaceship;

interface ISpaceship
{
    public function __construct(string $Name, int $Hitpoints, int $Fuel);

    public function getName(): string;

    public function setName(string $Name): void;

    public function getHitpoints(): int;

    public function setHitpoints(int $Hitpoints): void;

    public function getFuel(): int;

    public function setFuel(int $Fuel): void;

    public function AddCanon(Canon $Canon);

    public function RemoveCanon(Canon $CanonToRemove) : bool;

    public function Attack(Spaceship $Attacked_Spaceship): int;
}