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

                <form method="post" action="/controls/Reg.php">
                    <label>ФИО</label>
                    <input type="text" class="one-line" name="name" required>
                    <label>Логин</label>
                    <input type="text" class="one-line" name="login" required>
                    <label>Пароль</label>
                    <input type="password" class="one-line" name="password" required>
                    <label>Email</label>
                    <input type="text" class="one-line" name="email" required>

                    <button type="submit">Создать аккаунт</button>
                </form>
            </div>
        </div>
    </div>
    <?php require_once "../blocks/footer.php"; ?>
</body>

</html>