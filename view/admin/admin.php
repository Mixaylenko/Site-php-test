<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Менеджмент компаний</title>
    <link rel="stylesheet" href="/view/css/main.css">
</head>
<body>
<?php require_once "../blocks/header2.php"; ?>
    <div class="wrapper">
        <div class="container trending">
            <h3>Список компаний</h3>
            <h3><?php echo $_SESSION['trust'] ?></h3>
            <div class="feedback">
                <div class="inline">
                    <form method="GET" action="">
                        <label>Поиск</label>
                        <input type="text" class="one-line" name="search" value="<?php echo htmlspecialchars($search); ?>">
                        <label>Проверено (1/0)</label>
                        <input type="text" class="one-line" name="trust" value="<?php echo htmlspecialchars($trust); ?>">
                        <button type="submit" style="margin-left: 300px;">Найти</button>
                    </form>
                </div>
                <div class="companies">
                    <?php require_once '../../models/all.php';?>
                </div>
            </div>
        </div>
        <h2> <?php require_once '../../controls/page.php'; ?> </h2>
    </div>

    <?php require_once "../blocks/footer.php"; ?>
</body>
</html>


