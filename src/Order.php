<?php

class Order
{
    public static function getOrdersByUser(int $userId): array
    {
        $pdo = Database::getInstance()->getPDO();
        $stmt = $pdo->prepare("
                SELECT 
                o.cod_order AS order_id,
                u.fio AS user_name,
                o.date_admission AS date_received,
                o.date_end AS date_issued,
                COUNT(oi.cod_items) AS item_count,
                1000 * COUNT(oi.cod_items) AS total_cost -- Здесь стоимость для примера
                FROM `order` o
                LEFT JOIN `users` u ON o.cod_user = u.cod_user
                LEFT JOIN `order_items` oi ON o.cod_order = oi.cod_order
                WHERE o.cod_user = :userId
                GROUP BY o.cod_order
        ");
        $stmt->execute(['userId' => $userId]);

        return $stmt->fetchAll();
    }

    public static function create(int $cod_himchistka, string $date_admission, string $date_end, int $cod_user): int
    {
        $pdo = Database::getInstance()->getPDO();
        $stmt = $pdo->prepare('INSERT INTO `order` (cod_himchistka, cod_user, date_admission, date_end) VALUES (?, ?, ?, ?)');
        $stmt->execute([$cod_himchistka, $cod_user, $date_admission, $date_end]);
        return (int)$pdo->lastInsertId();
    }

    public static function addItems(int $cod_order, array $items): void
    {
        $pdo = Database::getInstance()->getPDO();
        $stmt = $pdo->prepare('INSERT INTO order_items (cod_order, cod_items) VALUES (?, ?)');
        foreach ($items as $item) {
            $stmt->execute([$cod_order, $item]);
        }
    }

    public static function getOrdersByStatus(int $userId, string $status): array
    {
        $pdo = Database::getInstance()->getPDO();
        $stmt = $pdo->prepare('
                SELECT 
                o.cod_order AS order_id,
                u.fio AS user_name,
                o.date_admission AS date_received,
                o.date_end AS date_issued,
                COUNT(oi.cod_items) AS item_count,
                SUM(i.cost) AS total_cost
                FROM `order` o JOIN `users` u ON u.cod_user = o.cod_user
                LEFT JOIN `order_items` oi ON oi.cod_order = o.cod_order
                LEFT JOIN `items` i ON i.cod_items = oi.cod_items
                WHERE o.cod_user = ? AND o.status = ? GROUP BY o.cod_order
                ORDER BY o.date_admission DESC;
    ');
        $stmt->execute([$userId, $status]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function updateOrderStatuses(): void
    {
        $pdo = Database::getInstance()->getPDO();
        $stmt = $pdo->prepare("
            UPDATE `order`
            SET `status` = 'completed'
            WHERE `status` = 'active' AND `date_end` <= CURDATE()
    ");
        $stmt->execute();
    }

}
