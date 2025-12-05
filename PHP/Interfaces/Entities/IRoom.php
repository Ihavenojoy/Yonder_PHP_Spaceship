<?php

namespace Interfaces\Entities;

interface IRoom
{
    public function __construct(string $Name, int $Length, int $With);
    public function roomSize();
}