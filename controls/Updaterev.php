<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_POST) {
    $id = trim(filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS));
    $rev = trim(filter_var($_POST['rev'], FILTER_SANITIZE_SPECIAL_CHARS));
    if(isset($_POST['trust'])){
        $trust = trim(filter_var($_POST['trust'], FILTER_SANITIZE_SPECIAL_CHARS));
    }else {
        $trust = 0;
    }
    try {
        require '../models/database.php';
        
        // Подготовка SQL-запроса для удаления отзыва
        $sql = 'UPDATE review SET Review = ?, Trust = ? WHERE Id_review = ?';
        $query = $pdo->prepare($sql);
        $query->execute([$rev,$trust,$id]);
        
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
    // Если запрос не POST, перенаправляем на главную страницу или другую
    header('Location: /view/admin/admin.php');
    exit();
}
?>