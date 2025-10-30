<?php

namespace Interfaces\Entities;

use Weapon;

Interface IArmory
{
public function __construct(string $Name, int $Length, int $Width);
public function AddWeapon(Weapon $weapon): bool;
}