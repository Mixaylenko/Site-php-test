<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авиоризация</title>
    <link rel="stylesheet" href="/view/css/main.css">
</head>

<body>
    <?php require_once "../blocks/header.php"; ?>
    <div class="wrapper">

        <div class="feedback">
            <div class="container">
                <h2>Аунтификация</h2>

                <form method="post" action="/controls/Auth.php">
                    <label>Логин</label>
                    <input type="text" class="one-line" name="login" required>
                    <label>Пароль</label>
                    <input type="password" class="one-line" name="password" required>
                    <div class="inline">
                        <button type="submit">Войти</button>
                        <a href="/view/user/reg.php"><button  type="button">Регистрация</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require_once "../blocks/footer.php"; ?>
</body>

</html>