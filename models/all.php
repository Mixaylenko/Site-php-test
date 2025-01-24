<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require 'database.php';
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    if ($_SESSION['role'] == 'admin'){
        $trust = isset($_GET['trust']) ? $_GET['trust'] : '';
    } else {
        $trust = 1;
    }
    if ($search || $trust) {
        $sql = 'SELECT * FROM companies WHERE (Name LIKE :search) AND (Trust LIKE :trust) ORDER BY Name';
        $query = $pdo->prepare($sql);
        $query->execute(['search' => '%' . $search . '%','trust' => '%' . $trust . '%']);
    } else {
        $sql = 'SELECT * FROM companies WHERE Trust LIKE :trust ORDER BY Name';
        $query = $pdo->prepare($sql);
        $query->execute(['trust' => '%' . $trust . '%']);
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
        echo '<a href="company.php?id=' . $el->Id_company . '"> 
                <div class="block">
                    <img src="/view/img/' . $el->Img_path . '" alt="" style="width: 200px; height: 200px;">
                    <p>' . $el->Name . '</p>
                </div> 
            </a>';
    }
?>