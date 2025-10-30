<?php

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

    public function AddCanon(Canon $canon)
    {
        $this->Cannons[] = $canon;
    }

    public function RemoveCanon(Canon $canonToRemove) : bool
    {
        foreach ($this->Cannons as $key => $existingCanon)
        {
            if ($existingCanon === $canonToRemove)
            {
                unset($this->Cannons[$key]);
                return true;
            }
        }
        return false;
    }

}