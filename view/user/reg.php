<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="/view/css/main.css">
</head>

<body>
    <?php require_once "../blocks/header.php"; ?>
    <div class="wrapper">

        <div class="feedback">
            <div class="container">
                <h2>Регистрация</h2>
                <?php echo "<script>дддддд</script>"; ?>
                <form action="" method="POST">

                    <label for="name">ФИО:</label>
                    <input type="text" class="one-line" id="name" name="name" required><br>

                    <label for="login">Логин:</label>
                    <input type="text" class="one-line" id="login" name="login" required><br>

                    <label for="email">Email:</label>
                    <input type="email" class="one-line" id="email" name="email" required><br>

                    <label for="password">Пароль:</label>
                    <input type="password" class="one-line" id="password" name="password" required><br>

                    <button type="submit">Создать аккаунт</button>
                </form>
            </div>
        </div>
    </div>
    <?php require_once "../blocks/footer.php"; ?>
    <?php
    // Обработка формы регистрации
    require '../controls/AuthController.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $authController = new AuthController($pdo);
        $authController->reg(); // Вызов метода регистрации
    }
    ?>
</body>

</html>