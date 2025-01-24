<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Комментарий</title>
    <link rel="stylesheet" href="/view/css/main.css">
</head>

<body>
    <?php require_once "../blocks/header.php"; ?>
    <div class="feedback">
        <?php require_once '../../models/revus.php';
        foreach ($arr as $review){
            $rev = nl2br(htmlspecialchars($review->Review));
            echo '<h2>' . htmlspecialchars($review->Name) . '</h2>
                <p>' . $rev  . '</p>'; 
        }
        ?>

        </div>
    <?php require_once "../blocks/footer.php"; ?>
</body>

</html>