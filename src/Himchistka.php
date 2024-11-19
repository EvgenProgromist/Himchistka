<?php

require_once "./vendor/autoload.php";

class Himchistka
{
    public static function getAll(): array
    {
        $pdo = Database::getInstance()->getPDO();
        $stmt = $pdo->query('SELECT * FROM himchistka');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
