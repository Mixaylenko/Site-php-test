<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if($_POST){
    $Id_company = $_GET['id'];
    $Name = $_SESSION['name'];
    $Id_user = $_SESSION['Id_user'];
    $rev = trim(filter_var($_POST['rev'], FILTER_SANITIZE_SPECIAL_CHARS));
    $trust = 0;
    if ($_SESSION['role']=='admin')
        $trust = 1;
    try {
        require '../models/database.php';
        $sql = 'INSERT INTO review (Id_user, Name, Id_company, Review, Trust) VALUES(?, ?, ?, ?, ?)';
        $query = $pdo->prepare($sql);
        $query->execute([$Id_user, $Name, $Id_company, $rev, $trust]);
        if (isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            // Если нет реферера, можно перенаправить на главную страницу или другую
            header('Location: /view/user');
            exit();
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        header('Location: /view/user');
    }
    exit;
} 
include '/view/user';
?>
