<?php

use DAL\WeaponDAL;
use Entities\Fleet;
use Scripts\Battle;
use Setup\DB_Connector;

require_once 'Entities/Room.php';
require_once 'Entities/Armory.php';
require_once 'Entities/Weapon.php';
require_once 'Entities/Fleet.php';
require_once 'Entities/Spaceship.php';
require_once 'Interfaces/Entities/IArmory.php';
require_once 'Setup/DB_Connector.php';
require_once 'Dal/WeaponDAL.php';
require_once 'Scripts/Battle.php';


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
$ChallengerFleet = new Fleet("ChallengerFleet");
for ($i = 0; $i < 4; $i++) {
    $ship = new Spaceship("Challenger", 20, 8);
    for ($c = 0; $c < 8; $c++) {
        $ship->AddCanon(new Canon("ChallengerCanon", 1, 3, 0, 2));
    }
    $ChallengerFleet->AddShip($ship);
}

$DestroyerFleet = new Fleet("DestroyerFleet");
for ($i = 0; $i < 8; $i++) {
    $ship = new Spaceship("Destroyer", 10, 4);
    for ($c = 0; $c < 2; $c++) {
        $ship->AddCanon(new Canon("DestroyerCanon", 1, 2, 0, 1));
    }
    $DestroyerFleet->AddShip($ship);
}
$FalconFleet = new Fleet("FalconFleet");
for ($i = 0; $i < 5; $i++) {
    $ship = new Spaceship("Falcon-$i", 15, 6);
    for ($c = 0; $c < 3; $c++) {
        $ship->AddCanon(new Canon("FalconCanon-$i-$c", 2, 4, 0, 3));
    }
    $FalconFleet->AddShip($ship);
}

$ViperFleet = new Fleet("ViperFleet");
for ($i = 0; $i < 6; $i++) {
    $ship = new Spaceship("Viper-$i", 12, 5);
    for ($c = 0; $c < 4; $c++) {
        $ship->AddCanon(new Canon("ViperCanon-$i-$c", 1, 3, 0, 2));
    }
    $ViperFleet->AddShip($ship);
}

$Battle = new Battle();
$Battle->AddFleet($DestroyerFleet);
$Battle->AddFleet($ChallengerFleet);
$Battle->AddFleet($FalconFleet);
$Battle->AddFleet($ViperFleet);
$Battle->Start();