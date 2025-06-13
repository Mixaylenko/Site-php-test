<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} 
require '../models/database.php';

class AuthController {
    private $salt = "hertetrgrhtku";
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function reg() {
        if ($_POST) {
            $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
            $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
            $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));
            $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));

            if (strlen($login) < 5) {
                echo "Логин < 5. Вернитесь на прошлую страничку и исправьте";
                exit;
            }
            if (strlen($name) < 5) {
                echo "ФИО < 5. Вернитесь на прошлую страничку и исправьте";
                exit;
            }
            if (strlen($email) < 5 || !str_contains($email, '@')) {
                echo "Email < 5 или отсутствует @. Вернитесь на прошлую страничку и исправьте";
                exit;
            }
            if (strlen($password) < 5) {
                echo "Password < 5. Вернитесь на прошлую страничку и исправьте";
                exit;
            }
            try {
                $password = md5($salt . $password);
                $sql = 'INSERT INTO users(Name, Login, Password, Email) VALUES(?, ?, ?, ?)';
                $query = $this->pdo->prepare($sql);
                $query->execute([$name, $login, $password, $email]);
                $sql = 'SELECT * FROM users WHERE Login = ?';
                $query = $this->pdo->prepare($sql);
                $query->execute([$login]);
                if ($query->rowCount() > 0) {
                    echo "Пользователь с таким логином уже существует.";
                    exit;
                }else{
                    // Получаем пользователя для установки сессии
                    $sql = 'SELECT * FROM users WHERE Login = ? AND Password = ?';
                    $query = $pdo->prepare($sql);
                    $query->execute([$login, $password]);
                    $user = $query->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['name'] = $user['Name'];
                    $_SESSION['login'] =  $user['Login'];
                    $_SESSION['role'] = $user['Role'];
                    $_SESSION['Id_user'] = $user['Id_user'];
                    header('Location: /view/user');
                }
            } catch (PDOException $e) {
                
                echo "Connection failed: " . $e->getMessage();
                header('Location: /view/user/reg.php');
            }
            exit;
        }
        include '../view/user/reg.php'; 
    }

    public function login() {
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
                    
                    if ($user['Role'] == 'admin') {
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
    }
}
?>
