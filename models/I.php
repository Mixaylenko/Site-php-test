<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$id = $_GET['id'];
$Id_user = $_SESSION['Id_user'];
require 'database.php';
$sql='SELECT * FROM review Where Id_company = ? AND Id_user = ?';
$query = $pdo->prepare($sql);
$query->execute([$id, $Id_user]);
$rev = $query->fetchAll(PDO::FETCH_OBJ);
?>