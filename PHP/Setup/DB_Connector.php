<?php

namespace Setup;
use PDO;

require 'vendor/autoload.php';

function GetENVSecrets(): array
{
    // De array wordt hier direct gevuld met de waarden uit $_ENV
    $secrets = [
        'host'    => $_ENV['MYSQL_HOST'],
        'db'      => $_ENV['MYSQL_DB'],
        'user'    => $_ENV['MYSQL_USER'],
        'pass'    => $_ENV['MYSQL_PASSWORD'],
        'charset' => $_ENV['MYSQL_CHARSET']
    ];

    return $secrets;
}


class DB_Connector
{
    private $host;
    private $db;
    private $user;
    private $pass;
    private $charset;
    private $dsn;

    public function __construct()
    {
        $config = GetENVSecrets();
        $this->host = $config['host'];
        $this->db = $config['db'];
        $this->user = $config['user'];
        $this->pass = $config['pass'];
        $this->charset = $config['charset'];
        $this->dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
    }


    public function Test_Connection()
    {
        try {
            $pdo = new PDO($this->dsn, $this->user, $this->pass);
            // Voeg hier eventueel opties toe, zoals in het vorige antwoord
            echo "Verbinding succesvol gemaakt met de database: " . $this->db;
        } catch (\PDOException $e) {
            echo "Fout bij verbinding: " . $e->getMessage();
            exit();
        }
    }
}