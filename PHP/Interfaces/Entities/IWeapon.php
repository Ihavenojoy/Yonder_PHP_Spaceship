<?php

namespace Interfaces\Entities;

interface IWeapon
{
    public function __construct(string $Name, int $MinimumDamage, int $MaximumDamage, int $MagazineSize, int $Ammo);
    public function GetName(): string;
    public function GetMinimumDamage(): int;
    public function GetMaximumDamage(): int;
    public function GetMagazineSize(): int;
    public function GetAmmo(): int;
    public function SetName(string $name): void;
    public function SetMinimumDamage(int $minimumDamage): void;
    public function SetMaximumDamage(int $maximumDamage): void;
    public function SetMagazineSize(int $magazineSize): void;
    public function SetAmmo(int $ammo): void;
    public function __toString();
}