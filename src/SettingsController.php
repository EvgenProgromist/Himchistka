<?php
class SettingsController
{
    public function settings(): void
    {
        Session::start(); // Запуск сессии
        Users::isAuthenticated(); // Проверка авторизации

        $user_id = $_SESSION['user_id']; // Получаем ID текущего пользователя
        $user = Users::getById($user_id); // Получаем данные пользователя

        // Отображаем страницу
        require_once __DIR__ . '/../views/settings_profile.php';
    }

    public function updateSettings(): void
    {
        Session::start(); // Запуск сессии
        Users::isAuthenticated(); // Проверка авторизации

        $user_id = $_SESSION['user_id']; // ID пользователя
        $fio = $_POST['fio'] ?? '';
        $phone = $_POST['phone'] ?? '';

        // Простая валидация
        if (empty($fio) || empty($phone)) {
            $_SESSION['error'] = 'Все поля обязательны для заполнения.';
            header('Location: /Himchistcka/settings_profile');
            exit();
        }

        // Обновляем данные пользователя
        $success = Users::updateProfile($user_id, $fio, $phone);

        // Редирект с сообщением
        if ($success) {
            $_SESSION['success'] = 'Профиль успешно обновлён!';
        } else {
            $_SESSION['error'] = 'Произошла ошибка при обновлении профиля.';
        }
        header('Location: /Himchistcka/settings_profile');
        exit();
    }
}