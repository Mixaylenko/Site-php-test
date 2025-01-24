<?php require_once '../../models/comp.php'; 
require_once '../../models/I.php';?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php foreach ($companies as $company) 
    echo '<title> '.$company->Name.'</title>' ?>
    <link rel="stylesheet" href="/view/css/main.css">
</head>

<body>
    <?php require_once "../blocks/header2.php"; ?>
    <div class="wrapper">
        <div class="feedback">
            <div class="container">
                <?php foreach ($companies as $company)
                    echo '<div class="inline">
                            <form method="post" action="/controls/Updatecomp.php?id='.$company->Id_company.'">
                                <input type="text" class="one-line" name="Name" value="'.$company->Name.'"  required>
                                <h2><img src="/view/img/'.$company->Img_path.'" alt=""style="width: 300px; height: 300px;"></h2>
                                <input type="text" class="one-line" name="Img_path" value="'.$company->Img_path.'" required >
                                <textarea class="one-line" name="Info" style="height: 200px;" required>'.$company->Info.'</textarea>
                                <div class="inline">
                                    <label>Подтверждение:</label>
                                    <input type="checkbox" name="trust" value="1" ' . ($company->Trust ? 'checked' : '') . 'required>
                                    <button style="margin-left: 300px;" type="submit">Сохранить</button>
                                </div>
                            </form>
                            <form method="post" action="/controls/Delete.php">
                                <input type="hidden" name="base" value="companies">
                                <input type="hidden" name="id_name" value="Id_company">
                                <input type="hidden" name="id" value="'.$company->Id_company.'">
                                <button style="margin-left: 300px;" type="submit">Удалить</button>
                            </form>
                        </div>' ?>
            </div> 
            <div class="container" style="margin-top: 200px;">
                <h1>Отзовы</h1> 
                <?php 
                    if ($_SESSION['role'] != 'guest' && $_SESSION['role'] != null) { 
                        $foundReview = null; // Initialize variable to hold the found review
                        
                        // Loop through reviews to find the user's review
                        foreach ($rev as $review) {
                            if ($review->Id_user == $_SESSION["Id_user"]) {
                                $foundReview = $review; 
                                break; 
                            }
                        }
                        if ($foundReview != null) { ?>
                            <form method="post" action="/controls/Updaterev.php">
                                <label>Мой отзыв</label>
                                <?php echo'<input type="hidden" name="id" value="'.$foundReview->Id_review.'" required>
                                <textarea class="one-line" name="rev" style="height: 200px;"  required>'.$foundReview->Review.'</textarea>
                                <label>Добавить в общий доступ(1/0)</label>
                                <input type="text" name="trust" required> '?>
                                <button type="submit">Изменить</button>
                            </form>
                        <?php } else { ?>
                            <form method="post" action="/controls/Addcomment.php?id=<?php echo $id; ?>">
                                <label>Мой отзыв</label>
                                <textarea class="one-line" name="rev" style="height: 200px;" required></textarea>
                                <label>Добавить в общий доступ(1/0)</label>
                                <input type="text" name="trust" required>
                                <button type="submit">Отправить</button>
                            </form>
                        <?php } 
                    }
                    
                    // Loop through and display all reviews
                    foreach ($reviews as $review) { ?>
                        <div class="rewblock">
                            <?php 
                            $maxLength = 100; // Максимальное количество символов
                            $rev = nl2br(htmlspecialchars($review->Review));
                            $shortRev = mb_substr($rev, 0, $maxLength); // Обрезаем строку до 200 символов
                            
                            if (mb_strlen($rev) > $maxLength) {
                                $shortRev .= '...'; // Добавляем многоточие, если строка была обрезана
                            }
                            echo '<h3>' . htmlspecialchars($review->Name) . '</h3>
                                <p>' . $shortRev . '</p>
                                <div class="inline">
                                    <form method="post" action="/controls/Delete.php">
                                        <input type="hidden" name="base" value="review">
                                        <input type="hidden" name="id_name" value="Id_review">
                                        <input type="hidden" name="id" value="'.$review->Id_review.'">
                                        <button style="margin-top: -50px;" type="submit">Удалить</button>
                                    </form>
                                </div>'; 
                            ?>
                        </div> 
                    <?php } ?>
            </div>
        </div>
    </div>
    <?php require_once "../blocks/footer.php"; ?>

</body>

</html>