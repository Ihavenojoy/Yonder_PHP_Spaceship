<?php

use Interfaces\Entities\IArmory;

require_once 'Room.php';
require_once 'Weapon.php';
class Armory extends Room implements IArmory
{
    public array $Weapons;

    public function __construct(string $Name, int $Length, int $Width)
    {
        parent::__construct($Name, $Length, $Width);
        $this->Weapons = [];
    }
    public function AddWeapon(Weapon $weapon): bool
    {
        $this->Weapons[] = $weapon;
        echo ("{$this->Name} Added {$weapon}");
        return true;
    }

}