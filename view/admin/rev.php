<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Комментарии</title>
    <link rel="stylesheet" href="/view/css/main.css">
</head>

<body>
    <?php require_once "../blocks/header2.php";?>
    <div class="wrapper">
        <div class="container trending">
            <div class="feedback">
                <div class="inline">
                    <form method="GET" action="">
                        <label>Поиск по имени</label>
                        <input type="text" class="one-line" name="search" value="<?php echo htmlspecialchars($search); ?>">
                        <label>Поиск по содержанию</label>
                        <input type="text" class="one-line" name="rev" value="<?php echo htmlspecialchars($rev); ?>">
                        <label>Проверено (1/0)</label>
                        <input type="text" class="one-line" name="trust" value="<?php echo htmlspecialchars($trust); ?>">
                        <button type="submit">Найти</button>
                    </form>
                </div>
                <h1>Список комментариев</h1>
                <?php require_once '../../models/rev.php';?>
                </div>
            </div>
        </div>
        <h2> <?php require_once '../../controls/page.php'; ?> </h2>
    </div>
    <?php require_once "../blocks/footer.php"; ?>
</body>

</html>