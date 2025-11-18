<?php

use Entities\Fleet;

Require_once 'Canon.php';

class Spaceship
{
    public string $Name;
    public int $Hitpoints;
    public int $Fuel;
    public array $Cannons;

    public function __construct(string $Name, int $Hitpoints, int $Fuel)
    {
        $this->Name = $Name;
        $this->Hitpoints = $Hitpoints;
        $this->Fuel = $Fuel;
        $this->Cannons = [];
    }

    public function getName(): string
    {
        return $this->Name;
    }

    public function setName(string $Name): void
    {
        $this->Name = $Name;
    }

    public function getHitpoints(): int
    {
        return $this->Hitpoints;
    }

    public function setHitpoints(int $Hitpoints): void
    {
        $this->Hitpoints = $Hitpoints;
    }

    public function getFuel(): int
    {
        return $this->Fuel;
    }

    public function setFuel(int $Fuel): void
    {
        $this->Fuel = $Fuel;
    }

    public function AddCanon(Canon $Canon)
    {
        $this->Cannons[] = $Canon;
    }

    public function RemoveCanon(Canon $CanonToRemove) : bool
    {
        foreach ($this->Cannons as $key => $ExistingCanon)
        {
            if ($ExistingCanon === $CanonToRemove)
            {
                unset($this->Cannons[$key]);
                $this->Cannons = array_values($this->Cannons);
                return true;
            }
        }
        return false;
    }

    public function Attack(Spaceship $Attacked_Spaceship): int
    {
        $totalDamage = 0;
        foreach ($this->Cannons as $Live_Cannon)
        {
            if (!isset($Live_Cannon->MinimumDamage) || !isset($Live_Cannon->MaximumDamage) || !isset($Live_Cannon->RechargeTime)) {
                continue;
            }

            if (!isset($Live_Cannon->Recharge)) {
                $Live_Cannon->Recharge = 0;
            }

            if ($Live_Cannon->Recharge <= 0)
            {
                $min = max(0, (int)$Live_Cannon->MinimumDamage);
                $max = max($min, (int)$Live_Cannon->MaximumDamage);
                $DealtDamage = random_int($min, $max);
                $Attacked_Spaceship->Hitpoints = max(0, $Attacked_Spaceship->Hitpoints - $DealtDamage);
                $totalDamage += $DealtDamage;

                echo "\nSpaceship {$this->Name} viel spaceship {$Attacked_Spaceship->Name} en heeft {$DealtDamage} schade gedaan (HP doel: {$Attacked_Spaceship->Hitpoints})";

                $Live_Cannon->Recharge = (int)$Live_Cannon->RechargeTime;
            }
            else
            {
                $Live_Cannon->Recharge--;
                if ($Live_Cannon->Recharge < 0) $Live_Cannon->Recharge = 0;
            }
        }

        return $totalDamage;
    }
}
