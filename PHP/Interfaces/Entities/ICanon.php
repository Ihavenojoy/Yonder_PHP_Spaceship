<?php

namespace Interfaces\Entities;

interface ICanon
{
    public function __construct(string $Name, int $MinimumDamage, int $MaximumDamage,int $Recharge, int $RechargeTime);
}