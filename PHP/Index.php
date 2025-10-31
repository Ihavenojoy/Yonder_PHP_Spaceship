<?php

use DAL\WeaponDAL;
use Setup\DB_Connector;

require_once 'Entities/Room.php';
require_once 'Entities/Armory.php';
require_once 'Entities/Weapon.php';
require_once 'Interfaces/Entities/IArmory.php';
require_once 'Setup/DB_Connector.php';
require_once 'Dal/WeaponDAL.php';

$TestArmory = new Armory("Test Armory",25,25);
$TestWeapon = new Weapon("Handgun",1,4,12,3);
$TestArmory->AddWeapon($TestWeapon);

foreach ($TestArmory->Weapons as $weapon)
{
    echo("\nIn {$TestArmory->Name}: {$weapon}");
}
$TestConnection = new DB_Connector();
$TestConnection->Test_Connection();
$TestWeaponDAL = new WeaponDAL();
$TestWeapon = $TestWeaponDAL->GetWeapon(1);
if (!$TestWeapon == null)
{
    Echo("\n{$TestWeapon}");
}

?>