<?php


namespace App\Core\Database;


use PDO;
use PDOException;

final class Database extends PDO
{
    private static ?self $pdo = null;

    private function __construct() {
        try {
            parent::__construct('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
            ]);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getPDO(): self
    {
        return self::$pdo ?? new self();
    }
}