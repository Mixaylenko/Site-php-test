<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $id = $_GET['id'];
    require 'database.php';
    $sql ='SELECT * FROM review Where Id_review = ?';
    $query = $pdo->prepare($sql);
    $query->execute([$id]);
    $arr = $query->fetchAll(PDO::FETCH_OBJ);
?>