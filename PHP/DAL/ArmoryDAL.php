<?php

namespace DAL;

use mysql_xdevapi\Exception;
use PDO;
use Setup\DB_Connector;
use Armory;

class ArmoryDAL
{
    private $DB_Connector;

    public function __construct()
    {
        $this->DB_Connector = new DB_Connector();
    }


}