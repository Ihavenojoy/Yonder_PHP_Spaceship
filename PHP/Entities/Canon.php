<?php

use Interfaces\Entities\ICanon;

class Canon implements ICanon
{
    public string $Name;
    public int $MinimumDamage;
    public int $MaximumDamage;
    public int $Recharge;
    public int $RechargeTime;


    public function __construct(string $Name, int $MinimumDamage, int $MaximumDamage,int $Recharge, int $RechargeTime)
    {
        $this->Name = $Name;
        $this->MinimumDamage = $MinimumDamage;
        $this->MaximumDamage = $MaximumDamage;
        $this->Recharge = $Recharge;
        $this->RechargeTime = $RechargeTime;
    }
}