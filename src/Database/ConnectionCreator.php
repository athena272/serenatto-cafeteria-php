<?php

namespace Athena272\SerenattoCafeteria\Database;

use Dotenv\Dotenv;
use PDO;
use PDOException;

require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

class ConnectionCreator
{
    public static function createConnection(): PDO
    {
        $host = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_NAME'];
        $username = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASS'];

        $databasePath = "mysql:host=$host;dbname=$dbname";

        try {
            $pdo = new PDO($databasePath, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            //echo "✅ Successfully connected to the MySQL database." . PHP_EOL;
            return $pdo;
        } catch (PDOException $e) {
            echo "❌ Failed to connect to the MySQL database: " . $e->getMessage();
            exit();
        }
    }
}
