<?php

class Canon
{
    public string $Name;
    public int $MinimumDamage;
    public int $MaximumDamage;
    public int $RechargeTime;

    public function __construct(string $Name, int $MinimumDamage, int $MaximumDamage, int $RechargeTime)
    {
        $this->Name = $Name;
        $this->MinimumDamage = $MinimumDamage;
        $this->MaximumDamage = $MaximumDamage;
        $this->RechargeTime = $RechargeTime;
    }
}