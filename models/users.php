<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    require 'database.php';
    if ($search) {
        $sql = 'SELECT * FROM users WHERE Name LIKE :search';
        $query = $pdo->prepare($sql);
        $query->execute(['search' => '%' . $search . '%']);
    } else {
        $sql = 'SELECT * FROM users';
        $query = $pdo->prepare($sql);
        $query->execute();
    }
    $arr = $query->fetchAll(PDO::FETCH_OBJ);
    $length = count($arr);

    // Определение переменных для пагинации
    $limit = 5; // Количество элементов на странице
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Текущая страница
    $totalPages = ceil($length / $limit); // Общее количество страниц

    // Вычисление смещения
    $offset = ($page - 1) * $limit;

    // Вывод элементов для текущей страницы
    for ($q = $offset; $q < $offset + $limit && $q < $length; $q++) {
        $el = $arr[$q]; // Получаем текущий элемент массива
        echo '<div class="rewblock">
                <h3>'.$el->Name.'</h3>
                <p>'.$el->Login.'</p>
                <p>'.$el->Email.'</p>
                <form method="post" action="/controls/Delete.php">
                    <input type="hidden" name="base" value="users">
                    <input type="hidden" name="id_name" value="Id_user">
                    <input type="hidden" name="id" value="'.$review->Id_user.'">
                    <button style="margin-top: -50px;" type="submit">Удалить</button>
                </form>
            </div>';
    }
?>
    