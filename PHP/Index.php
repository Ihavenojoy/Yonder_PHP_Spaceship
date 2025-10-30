<?php
require_once 'Entities/Room.php';
require_once 'Entities/Armory.php';
require_once 'Entities/Weapon.php';

$TestArmory = new Armory("Test Armory",25,25);
$TestWeapon = new Weapon("Handgun",1,4,12,3);
$TestArmory->AddWeapon($TestWeapon);

foreach ($TestArmory->Weapons as $weapon)
{
    echo("\nIn {$TestArmory->Name}: {$weapon}");
}
?>