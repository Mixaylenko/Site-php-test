<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_POST) {
    $Id = $_GET['id'];
    $Name = trim(filter_var($_POST['Name'], FILTER_SANITIZE_SPECIAL_CHARS));
    $Id_user = $_SESSION['Id_user'];
    $Img_path = trim(filter_var($_POST['Img_path'], FILTER_SANITIZE_SPECIAL_CHARS));
    $Info = trim(filter_var($_POST['Info'], FILTER_SANITIZE_SPECIAL_CHARS));
    if(isset($_POST['trust'])){
        $trust = 1;
    }else {
        $trust = 0;
    }
    
    if (isset($_SESSION['Id_user']) && $_SESSION['role'] == 'admin') {
        try {
            require '../models/database.php';
            
            // Подготовка SQL-запроса для удаления отзыва
            $sql = 'UPDATE companies SET Name = ?, Img_path = ?, Info = ?, Id_author = ?, Trust = ? WHERE Id_company = ?';
            $query = $pdo->prepare($sql);
            $query->execute([$Name, $Img_path, $Info, $Id_user, $trust, $Id]);
            
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