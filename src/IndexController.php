<?php

use JetBrains\PhpStorm\NoReturn;

class IndexController
{
    public function __construct()
    {
        session_start(); // Запускаем сессию в конструкторе, чтобы она была доступна во всех методах
    }

    public function home(): void
    {
        include_once __DIR__ . '/../views/home.php';
    }

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Получение данных из формы
            $fio = $_POST['username'];
            $number = $_POST['number'];

            // Инициализация переменной ошибки
            $errors = [];

            // Проверка ФИО: должно быть не короче 3 символов и содержать только буквы и пробелы
            if (empty($fio) || !preg_match("/^[А-Яа-яЁё\s]+$/u", $fio) || mb_strlen($fio) < 3) {
                $errors[] = "Введите корректное полное имя, состоящее из букв и пробелов (не менее 3 символов).";
            }

            // Проверка номера телефона: должен соответствовать формату +7XXXXXXXXXX
            if (empty($number) || !preg_match("/^\+7\d{10}$/", $number)) {
                $errors[] = "Введите номер телефона в формате +7XXXXXXXXXX.";
            }

            // Если есть ошибки, перенаправляем обратно на форму и показываем их
            if (!empty($errors)) {
                $error = implode("<br>", $errors);
                include __DIR__ . '/../views/register.php';
                return;
            }

            // Если валидация прошла, добавляем пользователя
            $userId = Users::add_User($fio, $number); // Предполагается, что метод возвращает ID нового пользователя

            // Сохраняем пользователя в сессии
            $_SESSION['user_id'] = $userId;

            // Перенаправляем в личный кабинет
            header("Location: /Himchistcka/user_office");
            exit();
        } else {
            // GET-запрос - просто показываем форму регистрации
            include __DIR__ . '/../views/register.php';
        }
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Получение данных из формы
            $fio = $_POST['username'];
            $number = $_POST['number'];

            // Проверка пользователя в базе данных
            $user = Users::findUser($fio, $number); // Предполагается, что метод возвращает пользователя или null

            if ($user) {
                // Сохраняем пользователя в сессии
                $_SESSION['user_id'] = $user->getId();

                // Перенаправляем в личный кабинет
                header("Location: /Himchistcka/user_office");
                exit();
            } else {
                // Показываем ошибку авторизации
                $error = "Неправильные данные для входа.";
                include_once __DIR__ . '/../views/login_office.php';
            }
        } else {
            // GET-запрос - просто показываем форму входа
            include_once __DIR__ . '/../views/login_office.php';
        }
    }

    public function user_office(): void
    {
        // Проверка, авторизован ли пользователь
        Users::isAuthenticated();
        $user_id = $_SESSION['user_id'];
        Order::updateOrderStatuses();

        // Получаем активные заказы
        $activeOrders = Order::getOrdersByStatus($user_id, 'active');

        // Получаем завершенные заказы
        $completedOrders = Order::getOrdersByStatus($user_id, 'completed');
        // Получаем данные пользователя для отображения в кабинете
        $user = Users::getById($_SESSION['user_id']); // Предполагается, что метод вернет объект пользователя
        include_once __DIR__ . '/../views/user_office.php';
    }

    public function logout(): void
    {
        // Завершение сессии
        session_unset(); // Удаляем все переменные сессии
        session_destroy(); // Завершаем сессию
        header("Location: /Himchistcka/");
        exit();
    }

    public function settings_profile()
    {

    }

    public function order_create()
    {
        // Проверка, авторизован ли пользователь
        if (!isset($_SESSION['user_id'])) {
            // Если нет, перенаправляем на страницу входа
            header("Location: /Himchistcka/login");

            exit();
        }

    }
}
