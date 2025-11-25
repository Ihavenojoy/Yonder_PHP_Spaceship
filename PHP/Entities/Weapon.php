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

        public function GetName(): string
    {
        return $this->Name;
    }

    public function GetMinimumDamage(): int
    {
        return $this->MinimumDamage;
    }

    public function GetMaximumDamage(): int
    {
        return $this->MaximumDamage;
    }

    public function GetMagazineSize(): int
    {
        return $this->MagazineSize;
    }

    public function GetAmmo(): int
    {
        return $this->Ammo;
    }

    public function SetName(string $name): void
    {
        $this->Name = $name;
    }

    public function SetMinimumDamage(int $minimumDamage): void
    {
        $this->MinimumDamage = $minimumDamage;
    }

    public function SetMaximumDamage(int $maximumDamage): void
    {
        $this->MaximumDamage = $maximumDamage;
    }

    public function SetMagazineSize(int $magazineSize): void
    {
        $this->MagazineSize = $magazineSize;
    }

    public function SetAmmo(int $ammo): void
    {
        $this->Ammo = $ammo;
    }

    public function __toString()
    {
        return "Weapon: {$this->Name}, Damage: {$this->MinimumDamage}/{$this->MaximumDamage}, Ammo: {$this->Ammo}/{$this->MagazineSize}";
    }


}