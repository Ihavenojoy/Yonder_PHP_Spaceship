<?php

class Room
{
    public string $Name;
    public int $Length;
    public int $With;

    public function __construct(string $Name, int $Length, int $With)
    {
        $this->Name = $Name;
        $this->Length = $Length;
        $this->With = $With;
    }

    //hallo

}