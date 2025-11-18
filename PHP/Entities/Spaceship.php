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
                return true;
            }
        }
        return false;
    }

    public function Attack(Spaceship $Attacked_Spaceship)
    {
        foreach ($this->Cannons as $Live_Cannon)
        {
            if ($Live_Cannon->Recharge == 0)
            {
                $DealtDamage = random_int($Live_Cannon->MinimumDamage, $Live_Cannon->MaximumDamage);
                $Attacked_Spaceship->Hitpoints -= $DealtDamage;
                echo("\nSpaceship {$this->Name} viel spaceship {$Attacked_Spaceship->Name} en heeft {$DealtDamage} schade gedaan");
                $Live_Cannon->Recharge = $Live_Cannon->RechargeTime;
            }
            else
            {
                $Live_Cannon->Recharge--;
            }
        }
    }

    public function AttackFleet(Fleet $Target_Fleet): void
    {
        // Kies een willekeurig levend schip uit de doelwitvloot
        $attacked_spaceship = $Target_Fleet->getAvailableShip();

        // Voer dan de aanval uit zoals eerder gedefinieerd:
        $this->Attack($attacked_spaceship);
    }

}