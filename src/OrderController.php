<?php
require_once "./vendor/autoload.php";

class OrderController
{
    // Метод отображения формы создания заказа
    public function create(): void
    {
        Session::start(); // Старт сессии
        Users::isAuthenticated(); // Проверяем авторизацию

        Order::updateOrderStatuses();

        $user_id = $_SESSION['user_id']; // Берём ID текущего пользователя из сессии
        $user = Users::getById($user_id); // Получаем данные пользователя (для информации, если понадобится)

        // Получаем данные для выпадающих списков
        $himchistkas = Himchistka::getAll();
        $items = Items::getAll();

        // Отображаем представление
        require_once __DIR__ . '/../views/order_create.php';
    }

    // Метод обработки отправленной формы
    public function store(): void
    {
        Session::start(); // Старт сессии
        Users::isAuthenticated(); // Проверяем авторизацию

        // Получаем данные из формы
        $cod_himchistka = $_POST['cod_himchistka'] ?? null;
        $date_admission = $_POST['date_admission'] ?? null;
        $date_end = $_POST['date_end'] ?? null;
        $items = $_POST['items'] ?? [];
        $user_id = $_SESSION['user_id']; // Берём ID пользователя из сессии

        // Проверяем валидность данных
        if (!$cod_himchistka || !$date_admission || !$date_end || empty($items) || empty($user_id)) {
            die('Все поля формы обязательны для заполнения.');
        }

        // Создаем заказ
        $orderId = Order::create($cod_himchistka, $date_admission, $date_end, $user_id);

        // Связываем заказ с выбранными вещами
        Order::addItems($orderId, $items);

        // Перенаправляем на страницу успеха или список заказов
        header('Location: /Himchistcka/user_office');
        exit();
    }
}
