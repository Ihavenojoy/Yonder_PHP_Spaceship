<?php
namespace DAL;

use mysql_xdevapi\Exception;
use PDO;
use Setup\DB_Connector;
use Weapon;

class WeaponDAL
{
    private $DB_Connector;

    public function __construct()
    {
        $this->DB_Connector = new DB_Connector();
    }
    public function GetWeapon($weaponId): ?Weapon
    {
        $pdo = $this->DB_Connector->getPDO();

        $sql = "SELECT id, Name, MinimumDamage, MaximumDamage, MagazineSize, Ammo FROM weapons WHERE id = :id";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $weaponId, PDO::PARAM_INT);
            $stmt->execute();
            $weaponData = $stmt->fetch(\PDO::FETCH_ASSOC);

            try{
                $weaponObject = new Weapon(
                    $weaponData['Name'],
                    $weaponData['MinimumDamage'],
                    $weaponData['MaximumDamage'],
                    $weaponData['MagazineSize'],
                    $weaponData['Ammo']
                );
                return $weaponObject;
            } catch (Exception $e) {
                error_log("Probleem overzetten object database naar php: " . $e->getMessage());
                return null;
            }

        } catch (\PDOException $e) {
            error_log("Database fout bij ophalen wapen: " . $e->getMessage());
            return null;
        }
    }
}