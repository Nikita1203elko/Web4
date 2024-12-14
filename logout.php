<?php
// Инициализация сессии
session_start();
// Очистка всех значений сессий
session_unset();
// Уничтожение сессии
session_destroy();
// Перенаправление на главную страницу index.php
header("Location: http://localhost/web4/auth.php");
exit;
?>