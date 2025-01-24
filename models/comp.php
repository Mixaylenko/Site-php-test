<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $id = $_GET['id'];
    require 'database.php';
    if ($_SESSION['role'] == 'admin'){
        $sql ='SELECT * FROM companies Where Id_company = ?';
    } else {
        $sql='SELECT * FROM companies Where Id_company = ? AND Trust = 1';
    }
    $query = $pdo->prepare($sql);
    $query->execute([$id]);
    $companies = $query->fetchAll(PDO::FETCH_OBJ);
    $sql='SELECT * FROM review Where Id_company = ? AND Trust = 1 ORDER BY Id_review DESC';
    $query = $pdo->prepare($sql);
    $query->execute([$id]);
    $reviews = $query->fetchAll(PDO::FETCH_OBJ);
?>