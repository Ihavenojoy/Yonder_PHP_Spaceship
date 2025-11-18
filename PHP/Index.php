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
$Challenger = new Spaceship("Challenger", 20, 8);
$ChallengerCanon = new Canon("ChallengerCanon", 1 , 3, 0, 2);
for ($i = 0; $i < 8; $i++)
{
    $Challenger->AddCanon($ChallengerCanon);
}

$DestroyerFleet = new Fleet ("DestroyerFleet");
$Destroyer = new Spaceship ("Destroyer", 10, 4);
$DestroyerCanon = new Canon("DestroyerCanon", 1 , 2, 0, 1);
for ($i = 0; $i < 2; $i++)
{
    $Destroyer->AddCanon($ChallengerCanon);
}

for ($i = 0; $i < 4; $i++)
{
    $ChallengerFleet->AddShip($Challenger);
}
for ($i = 0; $i < 8; $i++)
{
    $DestroyerFleet->AddShip($Destroyer);
}

$Battle = new Battle();
$Battle->AddFleet($DestroyerFleet);
$Battle->AddFleet($ChallengerFleet);
$Battle->Start();
?>