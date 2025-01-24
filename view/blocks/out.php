<?php
session_start();
$_SESSION['role'] = 'guest';
header('Location: /view/user');
exit;
?>