<?php

namespace Setup;
use PDO;

require_once __DIR__ . '/../../vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();

function GetENVSecrets(): array
{
    // De array wordt hier direct gevuld met de waarden uit $_ENV
    $secrets = [
        'host'    => $_ENV['MYSQL_HOST'],
        'db'      => $_ENV['MYSQL_DB'],
        'user'    => $_ENV['MYSQL_USER'],
        'pass'    => $_ENV['MYSQL_PASSWORD'],
        'charset' => $_ENV['MYSQL_CHARSET'] ?? 'utf8mb4',
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
    private $pdo;

    public function __construct()
    {
        $config = GetENVSecrets();
        $this->host = $config['host'];
        $this->db = $config['db'];
        $this->user = $config['user'];
        $this->pass = $config['pass'];
        $this->charset = $config['charset'];
        $this->dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        $this->pdo = new PDO($this->dsn, $this->user, $this->pass);
    }

    public function getPDO(): ?\PDO
    {
        // Add logic here to return the connected PDO object
        // For simplicity, we assume $this->pdo is initialized and holds it.
        return $this->pdo;
    }

    public function Test_Connection()
    {
        try {
            $pdo = new PDO($this->dsn, $this->user, $this->pass);
            // Voeg hier eventueel opties toe, zoals in het vorige antwoord
            echo "\nVerbinding succesvol gemaakt met de database: " . $this->db;
        } catch (\PDOException $e) {
            echo "\nFout bij verbinding: " . $e->getMessage();
            exit();
        }
    }
}