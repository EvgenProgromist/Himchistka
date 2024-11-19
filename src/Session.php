<?php
class Session
{
    public static function start()
    {
        session_start();
    }
    
    public static function destroy()
    {
        // Завершение сессии
        session_unset(); // Удаляем все переменные сессии
        session_destroy(); // Завершаем сессию
    }

}