<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_POST) {
    // Получаем идентификатор отзыва из URL
    $Id = $_POST['id'];
    $Id_name = $_POST['id_name'];
    $Base = $_POST['base'];
    // Проверяем, что пользователь авторизован и имеет соответствующие права
    if (isset($_SESSION['Id_user']) && $_SESSION['role'] == 'admin') {
        try {
            require '../models/database.php';
            
            // Подготовка SQL-запроса для удаления отзыва
            $sql = 'DELETE FROM '.$Base.' WHERE '.$Id_name.' = ?';
            $query = $pdo->prepare($sql);
            $query->execute([$Id]);
            
            // Перенаправление обратно на страницу
            if (isset($_SERVER['HTTP_REFERER'])) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                header('Location: /view/admin/admin.php');
                exit();
            }
        } catch (PDOException $e) {
            echo "Ошибка подключения: " . $e->getMessage();
            header('Location: /view/admin/admin.php');
            exit();
        }
    } else {
        // Если пользователь не авторизован или не имеет прав
        header('Location: /view/user');
        exit();
    }
} else {
    // Если запрос не POST, перенаправляем на главную страницу или другую
    header('Location: /view/admin/admin.php');
    exit();
}
?>
