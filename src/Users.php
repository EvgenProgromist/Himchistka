<?php

use JetBrains\PhpStorm\NoReturn;

readonly class Users
{
    private int $id;
    private string $fio;
    private string $name;
    private string $last_name;
    private string $number;


    // Конструктор
    public function __construct(int $id, string $fio, string $number)
    {
        $this->id = $id;
        $this->fio = $fio;
        $this->number = $number;
        /*$this->name = $name;
        $this->last_name = $last_name;*/

    }

    // Геттеры
    public function getId(): int
    {
        return $this->id;
    }

    public static function getById(int $id): ?Users
    {
        $pdo = Database::getInstance()->getPDO();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE cod_user = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if ($row) {
            return new self($row['cod_user'], $row['fio'], $row['number']);
        }

        return null;
    }

    #[NoReturn] public static function logout(): void
    {
        // Очистка сессии
        session_start();
        session_unset();    // Удаляет все переменные сессии
        session_destroy();  // Уничтожает сессию

        // Перенаправляем на главную страницу
        header("Location: /Himchistcka/");
        exit();
    }

    public static function isAuthenticated()
    {
        // Проверка, авторизован ли пользователь
        if (!isset($_SESSION['user_id'])) {
            // Если нет, перенаправляем на страницу входа
            header("Location: /Himchistcka/login");

            exit();
        }
    }

    public static function findUser($fio, $number): ?Users
    {
        $pdo = Database::getInstance()->getPDO();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE fio = :fio AND number = :number LIMIT 1");
        $stmt->bindParam(':fio', $fio);
        $stmt->bindParam(':number', $number);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new self($row['cod_user'], $row['fio'], $row['number']); // Возвращаем экземпляр Users
        }

        return null;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFIO(): string
    {
        return $this->fio;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    /*public function getPoem1(): string
    {
        return $this->poem1;
    }

    public function getImg()
    {
        return $this->img;
    }*/


    // Метод получения всех поэтов из базы данных
    public static function getAll(): array
    {
        $pdo = Database::getInstance()->getPDO();
        $stmt = $pdo->query("SELECT * FROM users");
        $users = [];

        while ($row = $stmt->fetch()) {
            $users[] = new self($row['cod_user'], $row['fio'], $row['number']);
        }

        return $users;
    }

    // Метод для добавления нового пользователя в базу данных
    public static function add_User(string $fio, string $number): int
    {
        $pdo = Database::getInstance()->getPDO();
        $stmt = $pdo->prepare("INSERT INTO users (fio, number) VALUES (:fio, :number)");
        $stmt->bindParam(':fio', $fio);
        $stmt->bindParam(':number', $number);
        $stmt->execute();

        return $pdo->lastInsertId(); // Возвращаем ID добавленного пользователя
    }


    public static function delete_User(int $userId): void
    {
        $pdo = Database::getInstance()->getPDO();

        // SQL-запрос на удаление пользователя
        $stmt = $pdo->prepare("DELETE FROM users WHERE cod_user = :id");
        $stmt->execute(['id' => $userId]);
    }

    public static function updateProfile(int $userId, string $fio, string $phone): bool
    {
        $pdo = Database::getInstance()->getPDO();
        $stmt = $pdo->prepare('UPDATE users SET fio = ?, number = ? WHERE cod_user = ?');
        return $stmt->execute([$fio, $phone, $userId]);
    }
}