<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Менеджмент пользователей</title>
    <link rel="stylesheet" href="/view/css/main.css">
</head>
<body>
    <?php require_once "../blocks/header2.php";?>
    <div class="wrapper">
        <div class="container trending">
            <div class="feedback">
                <div class="inline">
                    <form method="GET" action="">
                        <label>Поиск</label>
                        <input type="text" class="one-line" name="search" value="<?php echo htmlspecialchars($search); ?>">
                        <button type="submit">Найти</button>
                    </form>
                </div>
                <h1>Список пользователей</h1>
                <?php require_once '../../models/users.php';?>
                </div>
            </div>
        </div>
        <h2> <?php require_once '../../controls/page.php'; ?> </h2>
    </div>
    <?php require_once "../blocks/footer.php"; ?>
</body>
</html>
