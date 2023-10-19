<?php
session_start();

// Проверка, что пользователь вошел в систему
if (isset($_SESSION['user_id'])) {
    // Разрушение сессии
    session_destroy();

    // Отправляем JSON-ответ об успешном выходе
    echo json_encode(['status' => 'success', 'message' => 'Вы успешно вышли из профиля.']);
    exit();
} else {
    // Отправляем JSON-ответ об ошибке, если пользователь не вошел в систему
    echo json_encode(['status' => 'error', 'message' => 'Ошибка: Пользователь не вошел в систему.']);
    exit();
}

