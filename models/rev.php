<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require 'database.php';
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $rev = isset($_GET['rev']) ? $_GET['rev'] : '';
    $trust = isset($_GET['trust']) ? $_GET['trust'] : '';
    if ($search || $rev || $trust) {
        $sql = 'SELECT * FROM review WHERE (Name LIKE :search) AND (Review LIKE :rev) AND (Trust LIKE :trust)';
        $query = $pdo->prepare($sql);
        $query->execute(['search' => '%' . $search . '%', 'rev' => '%' . $rev . '%', 'trust' => '%' . $trust . '%']);
    } else {
        $sql = 'SELECT * FROM review';
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
        echo '<div class="feedback">
                <div class="rewblock">
                    <h3>'.$el->Name.'</h3>
                    <form method="post" action="/controls/Updaterev.php">
                        <p><textarea class="one-line" name="rev" style="width: 800px;height: 100px;">'.$el->Review.'</textarea></p>
                        <p><input name="trust" value="'.$el->Trust.'"></p>
                        <input type="hidden" name="id" value="'.$el->Id_review.'" required>
                        <button style="margin-top: 10px; margin-right: 150px;" type="submit">Редактировать</button>
                    </form>
                    <form method="post" action="/controls/Delete.php">
                        <input type="hidden" name="base" value="review">
                        <input type="hidden" name="id_name" value="Id_review">
                        <input type="hidden" name="id" value="'.$el->Id_review.'">
                        <button style="margin-top: -50px;" type="submit">Удалить</button>
                    </form>
                </div>
            </div>';
    }
?>