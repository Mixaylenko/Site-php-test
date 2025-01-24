<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $id =$_GET['id'];
    require 'database.php';
    $sql = 'SELECT * FROM review WHERE (Trust = 1) AND Id_company = ?';
        $query = $pdo->prepare($sql);
        $query->execute([$id]);
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
        $maxLength = 100; // Максимальное количество символов
        $rev = nl2br(htmlspecialchars($el->Review));
        $shortRev = mb_substr($rev, 0, $maxLength); // Обрезаем строку до 200 символов
        
        if (mb_strlen($rev) > $maxLength) {
            $shortRev .= '...'; // Добавляем многоточие, если строка была обрезана
        }
        echo '<div class="feedback">
                <div class="rewblock">
                    <h3>'.$el->Name.'</h3>
                    <p>'.$shortRev.' </p>
                </div>
            </div>';
    }
?>