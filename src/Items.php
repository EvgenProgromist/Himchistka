<?php
require_once "./vendor/autoload.php";

class Items
{
    public static function getAll(): array
    {
        $pdo = Database::getInstance()->getPDO();
        $stmt = $pdo->query('SELECT * FROM items');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
