<?php

class Weapon
{
    public string $Name;
    public int $MinimumDamage;
    public int $MaximumDamage;
    public int $MagazineSize;
    public int $Ammo;

    public function __construct(string $Name, int $MinimumDamage, int $MaximumDamage, int $MagazineSize, int $Ammo)
    {
        $this->Name = $Name;
        $this->MinimumDamage = $MinimumDamage;
        $this->MaximumDamage = $MaximumDamage;
        $this->MagazineSize = $MagazineSize;
        $this->Ammo = $Ammo;
    }

    public function __toString()
    {
        return "Weapon: {$this->Name}, Damage: {$this->MinimumDamage}/{$this->MaximumDamage}, Ammo: {$this->Ammo}/{$this->MagazineSize}";
    }


}