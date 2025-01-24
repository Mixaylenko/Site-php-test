<?php
session_start();
if($_POST){
    $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
    $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));
    try {
        require '../models/database.php';
        $salt = "hertetrgrhtku";
        $password = md5($salt . $password);
        $sql = 'SELECT * FROM users WHERE Login = ? AND Password = ?';
        $query = $pdo->prepare($sql);
        $query->execute([$login, $password]);
        if ($query->rowCount() == 0) {
            echo "Введены неверные данные. Вернитесь на предыдущую страницу для повтора";
            header('Location: /view/user/reg.php');
        } else {
            $user = $query->fetch(PDO::FETCH_ASSOC);
            $_SESSION['name'] = $user['Name'];
            $_SESSION['login'] =  $user['Login'];
            $_SESSION['role'] = $user['Role'];
            $_SESSION['Id_user'] = $user['Id_user'];
            
            if ($_SESSION['role'] == 'admin') {
                header('Location: /view/admin/admin.php');
            } else {
                header('Location: /view/user');
            }
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        header('Location: /view/user/reg.php');
    }
    exit;
} 
include '/view/user/reg.php';
?>